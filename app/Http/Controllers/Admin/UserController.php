<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(Request $request){
        $user = $this->user->create([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password'))
        ]);

        return response()->json([
            'status'=> 200,
            'message'=> 'User created successfully',
            'data'=>$user
        ]);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $user = JWTAuth::toUser($token);
        $user['_token'] = $token;
        return $this->api_res($user,'success');

    }

    public function getUserInfo(Request $request){

        $headers = apache_request_headers();
        $token = isset($headers['token']) ? $headers['token']  : '';
        $user = JWTAuth::toUser($token);
        return $this->api_res($user,'success');
    }

     public function logout(Request $request) {

       $headers = apache_request_headers();
        $token = isset($headers['token']) ? $headers['token']  : '';
        $user = JWTAuth::toUser($token);
        if(!$user){
            return response()->json(['message' => 'error']);
        }
        try {
            JWTAuth::invalidate($token);
            return $this->api_res('','You have successfully logged out');
        } catch (JWTException $e) {
            return response()->json('Failed to logout, please try again.', 404);
        }
    }
    protected function api_res($data = [], $message = "", $status = true, $code = 200)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header("X-Robots-Tag: noindex, nofollow", true);
        switch ($code) {
            case 404:
                header("HTTP/1.1 404 NOT FOUND");
                break;
            case 400:
                header('HTTP/1.1 400 BAD REQUEST');
                break;
            case 401:
                header("HTTP/1.1 401 UNAUTHORIZED");
                break;
            default:
                header("HTTP/1.1 200 OK");
                break;
        }

        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_HEX_QUOT | JSON_HEX_TAG);
        die();
    }
}
