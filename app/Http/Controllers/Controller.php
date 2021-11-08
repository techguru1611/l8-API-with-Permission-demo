<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        # code...
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $headers = [])
    {
    	$response = [
            'success' => true,
            'status_code'  => 200,
            'message' => $message,
            'data'    => $result
        ];

        return response()->json($response, 200, $headers);
    }

    
    public function sendErrorResponse($exception, $errors= [])
    {
        
        $response = [
            'message' => $exception->getMessage(),
            'status_code' => $exception->getCode(),
            // 'file' => $exception->getFile(),
            // 'line' => $exception->getLine(),
            // 'trace' => $exception->getTrace(),
        ];
        if(!empty($errors)) {
            $response['errors'] = $errors;
        }
        return response($response, 404);
    }
}
