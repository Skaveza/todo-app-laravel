<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Todo</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4">
        <form action="{{ route('todos.update', $todo) }}" method="POST">
            @csrf
            @method('PUT')

            @include('todos._form', [
                'todo' => $todo,
                'submitLabel' => 'Update'
            ])
        </form>
    </div>
</x-layouts.app>
