<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container mt-4">
                    <h2 class="mb-4">Tasks</h2>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
                
                    <form method="GET" class="mb-3">
                        <select name="status" onchange="this.form.submit()" class="form-select w-auto d-inline-block">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ ucfirst($task->description) }}</td>
                                    <td>{{ ucfirst($task->status) }}</td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">No tasks found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                
                    {{ $tasks->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
