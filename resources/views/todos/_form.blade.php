@csrf

<div class="space-y-4">

    {{-- Title --}}
    <div>
        <label class="block font-medium">Title *</label>
        <input
            type="text"
            name="title"
            class="border rounded w-full p-2"
            value="{{ old('title', $todo->title ?? '') }}"
        >
        @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label class="block font-medium">Description</label>
        <textarea
            name="description"
            rows="3"
            class="border rounded w-full p-2"
        >{{ old('description', $todo->description ?? '') }}</textarea>
        @error('description')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Due Date --}}
    <div>
        <label class="block font-medium">Due Date *</label>
        <input
            type="date"
            name="due_date"
            class="border rounded p-2"
            value="{{ old('due_date', isset($todo) ? $todo->due_date->format('Y-m-d') : '') }}"
        >
        @error('due_date')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">
        {{ $submitLabel ?? 'Save' }}
    </button>

</div>
