<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function home()
    {

        $tasks = Task::with('user')->where('user_id', Auth::id())->latest()->get();
        return view('home', compact('tasks'));
    }

    public function dashboard()
    {
        if (!Auth::check() || !Auth::user()->role || Auth::user()->role->name !== 'User') {
            abort(403, 'Users only');
        }

        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('task-dashboard.dashboard', compact('tasks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|string|max:255',
        ]);

        Task::create([
            'description' => $request->task,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
        ]);


        return redirect()->back()->with('success', 'Task added!');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        return view('task-dashboard.edit', compact('task'));
    }



    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'description' => 'sometimes|required|string|max:255',
        ]);

        $task->update([
            'description' => $request->description ?? $task->description,
            'completed' => $request->has('completed') ? true : false,
        ]);

        return redirect()->route('tasks.dashboard')->with('success', 'Task updated!');
    }


    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->back()->with('success', 'Task deleted!');
    }
}
