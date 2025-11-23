<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Todo</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4">
        <form action="{{ route('todos.store') }}" method="POST">
            @include('todos._form', ['submitLabel' => 'Create'])
        </form>
    </div>
</x-layouts.app>
