<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\Admin\UserAuthService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Traits\HttpResponse;

class UserAuthController extends Controller
{
    use HttpResponse;

    protected $userAuthService;
    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function registerAction(UserRequest $request){
        $result = $this->userAuthService->registerAction($request);
        if(!$result){
            return $this->error('Đăng ký thất bại');
        }
        return $this->success('Đăng ký thành công', $result);
    }

    public function loginAction(LoginRequest $request){
        $result = $this->userAuthService->loginAction($request);
        if(!$result){
            return $this->error('Đăng nhập thất bại');
        }
        return $this->success('Đăng nhập thành công', $result);
    }

    public function logoutAction(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->success('Đăng xuất thành công');
    }
}
