<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait ExceptionHandlerTrait
{

    /**
     * Create a new JSON response based on the type of the exception
     *
     * @param Request $request
     * @param Exception $error
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $error)
    {
        switch(true)
        {
            case ($error instanceof ModelNotFoundException):
                $response = $this->makeResponse("A model with this ID does not exist.", 404);
                break;
            case ($error instanceof QueryException):
                $response = $this->makeResponse("Cannot remove item as it is still being used.", 409);
                break;
            default:
                if(env('APP_ENV') === "testing")
                {
                    $response = $this->makeResponse("An uncaught exception has occured! message is: " .
                        $error->getMessage(), $error->getCode());
                }
                else
                {
                    $response = $this->makeResponse("An uncaught exception has occured", 400);
                }
        }

        return $response;
    }

    /**
     * Turn a given message and response code in a complete JSON response
     *
     * @param $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    private function makeResponse($message, $statusCode = 500)
    {
        $payload = ['error' => $message];
        return response()->json($payload, $statusCode);
    }

}