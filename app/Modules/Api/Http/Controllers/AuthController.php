<?php

namespace Modules\Api\Http\Controllers;

use App\Facades\ModuleServiceFacade;
use App\Models\User;
use App\Services\CacheService;
use App\Services\ModuleService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Modules\Admin\Services\PermissionService;
use Modules\Admin\Services\UserService;
use Modules\Api\Exceptions\ApiException;
use Modules\Redis\Services\RedisService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Tests\Feature\ModuleTestCase;

class AuthController extends Controller {
    public function getToken()
    {
        $auth = request()->header('Authorization');
        if (!$auth) throw new ApiException('authorization not found', 400);
        $encrypt = explode(' ', $auth);
        $decrypt = explode(':', base64_decode($encrypt[1]));
        $email = $decrypt[0];
        $pass = $decrypt[1];
        $user = Auth::attempt(['email' => $email, 'password' => $pass]);
        if (!$user) throw new AuthenticationException();

        $user = auth()->user();
        $user->tokens()->where('name','api_token')->delete();
        $token = $user->createToken('api_token');

		if(ModuleService::isEnabled('Redis')) RedisService::set('token:'.$token->plainTextToken,json_encode([
			'user_id' => $user->id,
			'user_permissions' => UserService::getAllPermissions($user)
		]));

        return response()->json($token->plainTextToken);
    }
}
