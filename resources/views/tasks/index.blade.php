<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>ToDo List</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-xl bg-white rounded-xl shadow-lg p-6 space-y-6">
        <h1 class="text-3xl font-bold text-blue-600">ToDo List Design By Tailwindcss</h1>

        {{-- Form Tambah --}}
        <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-2">
            @csrf
            <input type="text" name="title" placeholder="Tambah tugas..." required
                class="flex-grow border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
        </form>

        {{-- Filter --}}
        <div class="flex gap-4 text-sm">
            <a href="{{ route('tasks.index') }}"
                class="{{ $filter == 'all' ? 'font-bold text-blue-600 underline' : 'text-gray-600' }}">
                Semua
            </a>
            <a href="{{ route('tasks.index', ['filter' => 'undone']) }}"
                class="{{ $filter == 'undone' ? 'font-bold text-blue-600 underline' : 'text-gray-600' }}">
                Belum Selesai
            </a>
            <a href="{{ route('tasks.index', ['filter' => 'done']) }}"
                class="{{ $filter == 'done' ? 'font-bold text-blue-600 underline' : 'text-gray-600' }}">
                Selesai
            </a>
        </div>

        {{-- List Tugas --}}
        <ul class="space-y-3">
            @forelse ($tasks as $task)
            <li class="flex items-center justify-between bg-gray-50 p-4 rounded border">
                <div class="{{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-800' }}">
                    {{ $task->title }}
                </div>
                <div class="flex gap-2">
                    @if (!$task->is_done)
                    <form method="POST" action="{{ route('tasks.done', $task) }}">
                        @csrf
                        <button class="text-green-600 hover:underline">Selesai</button>
                    </form>
                    @endif
                    <form method="GET" action="{{ route('tasks.edit', $task) }}">
                        <button class="text-blue-500 hover:underline">Edit</button>
                    </form>
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </li>
            @empty
            <li class="text-center text-gray-500">Belum ada tugas</li>
            @endforelse
        </ul>
    </div>
</body>

</html>