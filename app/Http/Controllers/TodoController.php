<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // only logged-in users
    }

    // GET /todos
    public function index()
    {
        // only fetch the logged-in user's todos
        $todos = Todo::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('todos.index', compact('todos'));
    }

    // GET /todos/create
    public function create()
    {
        return view('todos.create');
    }

    // POST /todos
    public function store(StoreTodoRequest $request)
    {
        // create todo for THIS user only
        auth()->user()->todos()->create($request->validated());

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo created.');
    }

    // GET /todos/{todo}/edit
    public function edit(Todo $todo)
    {
        $this->authorize('update', $todo); // policy check

        return view('todos.edit', compact('todo'));
    }

    // PUT /todos/{todo}
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $this->authorize('update', $todo);

        $todo->update($request->validated());

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo updated.');
    }

    // DELETE /todos/{todo}
    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);

        $todo->delete();

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo deleted.');
    }

    // PATCH /todos/{todo}/complete
    public function complete(Todo $todo)
    {
        $this->authorize('update', $todo);

        if (! $todo->is_completed) {
            $todo->update([
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        return redirect()
            ->route('todos.index')
            ->with('success', 'Todo marked completed.');
    }
}
