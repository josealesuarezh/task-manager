<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::query()->orderBy('priority')->get();
        return view('dashboard')->with(['tasks'=> $tasks]);
    }

    public function store(TaskRequest $request)
    {
        $newTask = $request->validated();
        Task::create($newTask);

        return redirect('/tasks');
    }

    public function reorder(Task $task, TaskRequest $request){
        $task->update($request->validated());
        return response()->json($request);
    }

    public function update(Task $task, TaskRequest $request)
    {
        $task->update($request->validated());

        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
}
