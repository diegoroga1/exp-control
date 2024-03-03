<?php

namespace  Modules\Api\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
    private $status;
    private $errors=[];

    public function __construct($message = "",int $status=400, array $errors=[], $code = 0, Throwable $previous = null)
    {
        $this->status = $status;
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    public function getStatus(){
        return $this->status;
    }

    public function getErrors(){
        return $this->errors;
    }

}
