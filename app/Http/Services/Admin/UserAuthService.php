<?php

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Traits\HttpResponse;

class UserAuthService{

    use HttpResponse;

    public function loginAction($request){
        try{
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return false;
            }
            /* Tạo và lưu token vào bảng personal_access_tokens, để có thể có nhiều user đăng nhập 
            khác nhau */
            // $token = $user->createToken('admin-token', ['user-list', 'user-create', 'user-update'])->plainTextToken;   
            $token = $user->createToken('admin-token')->plainTextToken;   
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return $response;        
        }catch(\Exception $err){
            throw new \Exception($err->getMessage());
        }
    }

    public function registerAction($request){
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            return $user;
        } catch (\Exception $err) {
            throw new \Exception($err->getMessage());
        }
    }
    


}