@extends('admin-dashboard.layouts')
@section('content')
<div class="container">
    <h1>Role Management</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.roles.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="text" name="name" placeholder="Enter role name" required>
        <button type="submit" class="btn btn-primary">Add Role</button>
    </form>

    @if ($roles->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ ucfirst($role->name) }}</td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.roles.delete', $role->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this role?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No roles found.</p>
    @endif
</div>
@endsection

