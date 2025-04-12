@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-1/2 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800 text-center">Create Task</h2>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 rounded-md">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none text-sm" required>
                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition ease-in-out duration-300">Create</button>
                <a href="{{ route('tasks.index') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition ease-in-out duration-300">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
