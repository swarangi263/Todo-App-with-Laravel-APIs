<?php

use Illuminate\Http\Request;
use App\Models\Task;
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
        return $req->user();
    });

    // Route::get('/tasks/{id}', [TasksController::class, 'show']);
    // Route::post('/todo/add', [TasksController::class, 'store']);
    // Route::post('todo/status', [TasksController::class, 'update']);

    Route::get('/tasks/{id}', function (Request $req) {

        $tasks = Task::select('*')
            ->where('user_id', '=', $req->id)
            ->get();

        return response()->json($tasks);
    });

    Route::post('/todo/add', function (Request $req) {
        $task = Task::create([
            'user_id' => $req->id,
            'task' => $req->task,
        ]);

        $task = Task::find($task->id);
        return response()->json([
            'task' => $task,
            'status' => '1',
            'message' =>  'Successfully created a task',

        ]);
    });

    Route::post('todo/status', function (Request $req) {

        $task_id = $req->id;
        $status = $req->status;

        Task::where('id', '=', $task_id)
        ->update(['status' => $status]);

        $task = Task::find($task_id);

        Log::info($task);

        return response()->json([
            'task' => $task,
            'status' => '1',
            'message' =>  'Marked task as '.$task->status,
        ]);
    });
});

Route::get('/test', function (Request $req) {
    return 'Tested';
});
