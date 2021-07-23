
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('test', function(){

    return response()->json([
        'status' => '1',
        'message' =>  'This is test'
    ]);
});

//Middleware is added to the APIs for Authentication
Route::middleware('auth:api')->group(function () {

    Route::get('/user', function (Request $req) {

            return $req->user();
    });

    //API to get the list of all tasks of the user
    Route::get('/task', [TaskController::class, 'index']);

    //API to get the particular tasks of the id passed
    Route::get('/tasks/{id}', [TaskController::class, 'show']);

    //API to add a new task
    Route::post('/todo/add', [TaskController::class, 'store']);

    //API to update the status of particular task
    Route::post('/todo/status', [TaskController::class, 'update']);
});

// Route::post('register', [UserAuthController::class, 'register']);
// Route::post('login', [UserAuthController::class, 'login']);
