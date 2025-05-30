<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $tasks = Task::when($filter !== null, function ($query) use ($filter) {
            $query->where('completed', $filter);
        })->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'nullable|boolean', // optional
        ]);

        Task::create([
            'title' => $request->title,
            'completed' => $request->has('completed') ? (bool)$request->completed : false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugasan berjaya ditambah!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
            'completed' => $request->has('completed'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugasan dikemaskini!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tugasan berjaya dipadam!');
    }
}
