<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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

Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $req) {

        // if ($req->apikey != 'helloatg') {

        //     return response()->json([
        //         'status' => '0',
        //         'message' =>  'Invalid api key',

        //     ]);
        // } else {
            return $req->user();
        // }
    });

    Route::get('/tasks/{id}', [TasksController::class, 'show']);

    Route::post('/todo/add', [TasksController::class, 'store']);

    Route::post('todo/status', [TasksController::class, 'update']);
});
