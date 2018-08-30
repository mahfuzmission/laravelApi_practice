<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


trait ExceptionTrait{

    public function apiException($request,$e)
    {
        if ($this->isModel($e)) {
            return $this->ModelResponse($e);
        }
        if ($this->isHTTP($e)) {
            return $this->HTTPResponse($e);
        }
        return parent::render($request, $e);
    }

    protected function isModel($e){
     return $e instanceof ModelNotFoundException;
    }

    protected function isHTTP($e){
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e)
    {
       return response()->json([
            'error' => 'Product Model not found'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function HTTPResponse($e)
    {
        return response()->json([
            'error' => 'Incorrect route'
        ], Response::HTTP_NOT_FOUND);
    }
}



