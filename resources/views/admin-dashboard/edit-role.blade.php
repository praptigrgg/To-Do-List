@extends('admin-dashboard.layouts')
@section('content')
<div class="container">
    <h2>Edit Role: {{ $role->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
        </div><br>
<div>
<button type="submit" class="btn btn-primary">Update Role</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
</div>

    </form>
</div>
@endsection
