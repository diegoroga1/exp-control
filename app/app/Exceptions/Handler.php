<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Modules\Api\Exceptions\ApiException;
use Throwable;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
           self::checkDbException($e);
			$apiResponse = self::checkApiException($e, $request);
			if ($apiResponse) return $apiResponse;
        });
    }

    public static function checkDbException($e){
        if (strpos($e->getMessage(), 'QLSTATE')) throw new \Exception(__('errors.db.integrity_error'),0,$e);
    }

    public static function checkApiException($e,$request){
		if ($request->is('api/v*') || $request->is('api-admin/*')) {
			$status = 400;
			$error = [
				'status' => 'error',
				'message' => $e->getMessage(),
			];

			if ($e instanceof ApiException) {
				$status = $e->getStatus();
				$error['errors'] = $e->getErrors();

			}

			if ($e instanceof ValidationException) {
				$status = $e->status;
				$error['errors'] = $e->errors();
			}

			Log::error('API-' . $e->getMessage(), [
				'file' => $e->getFile(),
				'line' => $e->getLine(),
				'code' => $e->getCode(),
				'exception' => $e->getTraceAsString()
			]);

			return response()->json($error, $status);
		}

		return null;
    }
}
