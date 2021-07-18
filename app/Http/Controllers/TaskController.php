<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }
    public function show($id)
    {
        $task = auth()->user()->tasks()->find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found '
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $task->toArray()
        ], 400);
    }

    function store(Request $request)
    {
        $task = new Task;
        $task->task = $request->task;
        $task->status = 'pending';

        if (auth()->user()->tasks()->save($task))
            return response()->json([
                'status' => '1',
                'message' => 'Successfully created a task',
                'data' => $task->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Task not added'
            ], 500);
    }

    function update(Request $request)
    {
        $task = tasks()->find($request->id);


        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 400);
        }

        $task->status = $request->status;
        $updated = tasks()->save($task);


        if ($updated)
            return response()->json([
                'success' => true,
                'status' => '1',
            'message' =>  'Marked task as '.$task->status
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Task can not be updated'

            ], 500);
    }
}
