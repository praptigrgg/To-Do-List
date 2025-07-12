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
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'completed' => $request->has('completed')
        ]);

        return redirect()->back()->with('success', 'Task updated!');
    }
    public function destroy(Task $task)
{
    // Optional: check if authenticated user owns the task
    if ($task->user_id !== Auth::id()) {
        abort(403);
    }

    $task->delete();

    return redirect()->back()->with('success', 'Task deleted!');
}

}
