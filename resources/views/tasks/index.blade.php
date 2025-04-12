@extends('layouts.app')
<head>
    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

@section('content')
<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-xl">

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">Task Management</h2>
        <a href="{{ route('tasks.create') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition ease-in-out duration-300">
            + Add Task
        </a>
    </div>

    <!-- Filter Section -->
    <div class="mb-6 flex gap-4 items-center">
        <label for="status" class="text-gray-600 font-medium">Filter by Status:</label>
        <form method="GET" class="flex gap-4">
            <select name="status" onchange="this.form.submit()" id="status" class="px-4 py-2 bg-gray-100 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border-l-4 border-green-600 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Task Table -->
    <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
        <table class="min-w-full table-auto text-sm text-gray-600" style="width: 100%;">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">Title</th>
                    <th class="px-6 py-4 text-left">Description</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($tasks as $task)
                    <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
                        <td class="px-6 py-4 text-left">{{ $task->title }}</td>
                        <td class="px-6 py-4 text-left">{{ ucfirst($task->description) }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $task->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-3">
                            <!-- Edit Button with Padding, Box, and Hover Effect -->
                            <a href="{{ route('tasks.edit', $task) }}" class="inline-block p-2 bg-yellow-100 text-yellow-600 rounded-md hover:bg-yellow-200 hover:text-yellow-800 transition duration-300">
                                <i class="fas fa-pencil-alt"></i> <!-- Edit Icon -->
                            </a>

                            <!-- Delete Button with Padding, Box, and Hover Effect -->
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="inline-block p-2 bg-red-100 text-red-600 rounded-md hover:bg-red-200 hover:text-red-800 transition duration-300">
                                    <i class="fas fa-trash-alt"></i> <!-- Delete Icon -->
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div>
            {{ $tasks->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

