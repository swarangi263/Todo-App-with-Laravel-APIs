<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        //Returns all tasks of the user with message
        $tasks = auth()->users()->tasks;

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }
    public function show($id)
    {
        //Returns particular task of the user with message

        $task = auth()->users()->tasks()->find($id);

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
        //Stores the new task and return with message

        $task = new Task;
        $task->task = $request->task;
        $task->status = 'pending';

        if (auth()->users()->tasks()->save($task))
            return response()->json([
                'status' => '1',
                'message' => 'Successfully created a task',
                'data' => $task->toArray()
            ]);
        else
            return response()->json([
                'status' => '0',
                'message' => 'Invalid API key'
            ], 500);
    }

    function update(Request $request)
    {
        //Updates the status of a particular task and returns with message

        $task = auth()->users()->tasks()->find($request->id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 400);
        }

        $updated = $task->fill($request->all())->save();

        if ($updated)
            return response()->json([
                'status' => '1',
                'message' =>  'Marked task as ' . $task->status,
                'data' => $task->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Task can not be updated'

            ], 500);
    }
}
