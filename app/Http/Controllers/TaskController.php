<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');
        $query = Task::query();
        if ($status && in_array($status, ['Pending', 'Completed'])) {
            $query->where('status', $status);
        }
        $tasks = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('tasks.index', compact('tasks', 'status'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:Pending,Completed',
        ]);

        Task::create($validated);
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required|in:Pending,Completed',
        ]);

        $task->update($validated);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
