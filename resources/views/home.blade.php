@extends('welcome')
@section('content')
    <h1>Welcome, {{ Auth::user()->name }}</h1>

    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Add a New Task</h5>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="task" class="form-control" placeholder="Enter a task..." required>
                    </div>
                    <button class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>

        <h5>Your Tasks</h5>
        <ul class="list-group">
            @php $sn = 1; @endphp

            @forelse($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div style="display: flex; align-items: center; gap: 8px; flex: 1;">
                <span style="font-weight: bold;">{{ $sn++ }}.</span>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <span style="{{ $task->completed ? 'text-decoration: line-through;' : '' }}">
                                {{ $task->description }}

                            </span>
                               <input type="checkbox" name="completed" onchange="this.form.submit()"
                                {{ $task->completed ? 'checked' : '' }}> (Tick the box if the task is completed.)
                        </form>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            style="display: inline-block; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                        <span class="text-muted">{{ $task->created_at->diffForHumans() }}</span>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No tasks yet.</li>
            @endforelse


        </ul>
    </div>
    <br>
@endsection
