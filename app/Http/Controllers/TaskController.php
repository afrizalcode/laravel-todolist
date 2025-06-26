<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    // public function index()
    // {
    //     $tasks = Task::orderByDesc('created_at')->get();
    //     return view('tasks.index', compact('tasks'));
    // }

    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $tasks = match ($filter) {
            'done' => Task::where('is_done', true)->orderByDesc('created_at')->get(),
            'undone' => Task::where('is_done', false)->orderByDesc('created_at')->get(),
            default => Task::orderByDesc('created_at')->get(),
        };

        return view('tasks.index', compact('tasks', 'filter'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Task::create(['title' => $request->title]);
        return redirect()->route('tasks.index');
    }

    public function markAsDone(Task $task)
    {
        $task->update(['is_done' => true]);
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }
}
