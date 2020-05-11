<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }
    public function details(Request $request) 
    { 
        $user = Auth::user(); 
        
       //  'headers' => [
       //  'Accept' => 'application/json',
       //  'Authorization' => 'Bearer '.$accessToken,
       // ],
        $token=$request->post('/oauth/token', [
            'content-type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.'mahgf1234567890',
        ]);
        //$token=$request->header('Authorization');


        return response()->json(['success' => $user,'token' => $token], $this-> successStatus); 
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
}