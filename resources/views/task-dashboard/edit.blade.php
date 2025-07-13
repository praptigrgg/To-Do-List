@extends('main')
@section('content')
<div class="container mt-5">
    <h2>Edit Task</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="description" class="form-label">Task Description</label>
            <input type="text" class="form-control" id="description" name="description"
                   value="{{ old('description', $task->description) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('tasks.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
