<?php

namespace App\Http\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use App\Traits\HttpResponse;

class UserService{
    use HttpResponse;

    public function list($request){
        $users = UserResource::collection(User::all());
        if($search = $request->search){
            $users = User::where('name', 'like', '%' . $search . '%')->get();
        }
        return $users;
    }

    public function store($request){
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return new UserResource($user);
        }catch(\Exception $err){
            throw new \Exception($err->getMessage());
            return false;
        }
    }

    public function update($id, $request){
        try {
            $user = User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return $user;
        } catch (\Exception $err) {
            throw new \Exception($err->getMessage());
            return false;
        }
    }

    public function destroy($id){
        try {
            User::find($id)->delete();
        } catch (\Exception $err) {
            throw new \Exception($err->getMessage());
            return false;
        }
        return true;
    }


}