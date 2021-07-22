
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);

Route::get('test', function(){

    return response()->json([
        'status' => '1',
        'message' =>  'This is test'
    ]);
});


Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $req) {

            return $req->user();
    });

    Route::get('demo', function(){
        return response()->json([
        'status' => '1',
        'message' =>  'This is demo'
    ]);
    });

    Route::get('/tasks/{id}', [TaskController::class, 'show']);

    Route::get('/task', [TaskController::class, 'index']);

    Route::post('/todo/add', [TaskController::class, 'store']);

    Route::post('/todo/status', [TaskController::class, 'update']);
});

