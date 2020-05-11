<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;


        return $this->sendResponse($success, 'User register successfully.');
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
}