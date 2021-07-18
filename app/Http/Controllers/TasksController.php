<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class TasksController extends Controller
{
    function store(Request $req)
    {
        $task= Task::create([
            'user_id' => $req->id,
            'task' => $req->task,
        ]);

        $task = Task::find($task->id);

        return redirect(route('dashboard'))->with('1', 'Successfully created a task');
    }

    function update(Request $req)
    {
        $task_id = $req->id;
        $status = $req->status;

        Task::where('id', '=', $task_id)
        ->update(['status' => $status]);

        $task = Task::find($task_id);

        Log::info($task);

        return redirect(route('dashboard'))->with('1', 'Marked task as '.$status);
    }
}
