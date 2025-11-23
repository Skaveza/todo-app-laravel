<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">My Todos</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4">

        {{-- Success flash message --}}
        @if(session('success'))
            <div class="mb-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <p class="text-gray-600">Your tasks</p>
            <a href="{{ route('todos.create') }}" class="underline">+ New Todo</a>
        </div>

        <ul class="space-y-3">
            @forelse($todos as $todo)
                <li class="border p-3 rounded">
                    <div class="flex justify-between gap-4">

                        <div>
                            <h3 class="font-bold">
                                {{ $todo->title }}

                                @if($todo->is_completed)
                                    <span class="text-sm text-green-600">(completed)</span>
                                @endif
                            </h3>

                            @if($todo->description)
                                <p class="text-sm text-gray-700 mt-1">
                                    {{ $todo->description }}
                                </p>
                            @endif

                            <p class="text-sm mt-1">
                                Due: {{ $todo->due_date->format('Y-m-d') }}
                            </p>

                            @if($todo->completed_at)
                                <p class="text-sm text-gray-600">
                                    Completed at: {{ $todo->completed_at->format('Y-m-d H:i') }}
                                </p>
                            @endif
                        </div>

                        <div class="flex flex-col gap-2 text-sm">
                            <a href="{{ route('todos.edit', $todo) }}" class="underline">Edit</a>

                            <form action="{{ route('todos.destroy', $todo) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="underline text-red-600"
                                    onclick="return confirm('Delete this todo?')">
                                    Delete
                                </button>
                            </form>

                            @unless($todo->is_completed)
                                <form action="{{ route('todos.complete', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="underline text-green-700">
                                        Mark done
                                    </button>
                                </form>
                            @endunless
                        </div>

                    </div>
                </li>
            @empty
                <li class="text-gray-600">No todos yet.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
