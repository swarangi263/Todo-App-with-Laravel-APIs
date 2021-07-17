<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TasksController extends Controller
{
    public function show(Request $req)
    {
        $tasks = Task::select('*')
            ->where('user_id', '=', $req->id)
            ->get();

        return response()->json($tasks);
    }

    function store(Request $req)
    {
        $task= Task::create([
            'user_id' => $req->id,
            'task' => $req->task,
        ]);

        $task = Task::find($task->id);
        return response()->json([
            'task' => $task,
            'status' => '1',
            'message' =>  'Successfully created a task',

        ]);
    }

    function update(Request $req)
    {
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
    }
}
