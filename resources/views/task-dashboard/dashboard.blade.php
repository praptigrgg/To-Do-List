@extends('main')
@section('content')
<div class="container py-5">
    <h1 class="mb-4">Hello, {{ Auth::user()->name }} 👋</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Add Task Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Add New Task</h5>
            <form action="{{ route('tasks.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-10">
                    <input type="text" name="task" class="form-control" placeholder="What do you need to do?" required>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">Add Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Task List -->
    <h4 class="mb-3">Your Tasks</h4>

    @if($tasks->count())
        <ul class="list-group shadow-sm">
            @foreach($tasks as $index => $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <strong>{{ $index + 1 }}.</strong>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-flex align-items-center gap-2 flex-grow-1">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                            <span class="flex-grow-1 {{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $task->description }}
                            </span>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                        </form>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                        <small class="text-muted">{{ $task->created_at->diffForHumans() }}</small>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">You have no tasks yet. Add one above!</div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection

