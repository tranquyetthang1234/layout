<?php
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request)
    {
        // lấy thông tin từ các request gửi lên
        $credentials = $request->only('email', 'password');

        try {
            // xác nhận thông tin người dùng gửi lên có hợp lệ hay không
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // Xử lý ngoại lệ
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // xác nhận thành công thì trả về 1 token hợp lệ
        return response()->json(compact('token'));
    }
}
