<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function sendResponse($result, $message)
    {

        $response = [
            'statusCode'    => 200,
            'success'       => true,
            'message'       => $message,
            'data'          => $result,
        ];
        return response()->json($response, 200);
    }



    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'statusCode' => $code,
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, 200);
    }
}
