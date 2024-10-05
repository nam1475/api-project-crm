<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserAuthController;
use App\Http\Controllers\Admin\UploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserAuthController::class)->group(function () {
    Route::post('/register', 'registerAction')->name('register');
    Route::post('/login', 'loginAction')->name('login');
    Route::post('/logout', 'logoutAction')->name('logout')->middleware('auth:sanctum');
});

/*
- Middleware auth:sanctum thực chất là EnsureFrontendRequestsAreStateful được định nghĩa trong middleware 
group 'api'.
- Middleware auth:sanctum kiểm tra xem yêu cầu có đi kèm với một token hợp lệ hay không. Nếu token hợp lệ, 
người dùng tương ứng sẽ được xác thực. Nếu không, yêu cầu sẽ bị từ chối. 
*/
Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/list', 'list')->name('user.list')->middleware('abilities:user-list');
    // Route::post('/create', 'create')->name('user.create');
    // Route::get('/show/{id}', 'show')->name('user.show');
    // Route::put('/update/{id}', 'update')->name('user.update');
    // Route::delete('/delete/{id}', 'delete')->name('user.delete');
    
    
    Route::post('/upload', [UploadController::class, 'upload']);
}); 

Route::apiResource('user', UserController::class);
