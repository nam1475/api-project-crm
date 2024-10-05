<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use App\Traits\HttpResponse;

class UserController extends Controller
{
    use HttpResponse;

    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function index(Request $request){
        $result = $this->userService->list($request);
        if($result == null){
            return $this->error('Danh sách user rỗng', null, 404);
        }
        return $this->success('Danh sách user', $result);   
    }

    public function store(UserRequest $request){
        $result = $this->userService->store($request);
        if(!$result){
            return $this->error('Tạo user thất bại');
        }
        return $this->success('Tạo user thành công', $result);
    }

    public function show($id){
        $user = User::find($id);
        if($user == null){
            return $this->error('Không tìm thấy user', null, 404);
        }
        return $this->success('Thông tin user', $user);
    }

    public function update(Request $request, $id){
        $result = $this->userService->update($id, $request);
        if(!$result){
            return $this->error('Cập nhật user thất bại');
        }
        return $this->success('Cập nhật user thành công');
    }

    public function destroy($id){
        $result = $this->userService->destroy($id);
        if(!$result){
            return $this->error('Xóa user thất bại');
        }
        return $this->success('Xóa user thành công');
    }
}
