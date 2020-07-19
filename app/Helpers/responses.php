<?php

namespace App\Helpers;
use Response; // Import library response laravel
use Session;

class Responses {

    public static function res($code,$message,$result)
    {
        $response = [
			'code' => $code,
			'message' => $message,
			'result' => $result,
        ];

        return Response::json($response);
    }
  
    
}
