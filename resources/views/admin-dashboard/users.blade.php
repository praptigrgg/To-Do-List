@extends('admin-dashboard.layouts')
@section('content')

    <title>User Dashboard</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f6f8;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        .stats {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 200px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: center;
        }

        .card h5 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #666;
        }

        .card h2 {
            margin: 0;
            font-size: 28px;
            color: #222;
        }

        .section {
            margin-bottom: 40px;
        }

        .list-group {
            list-style: none;
            padding: 0;
            margin: 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .list-group li {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }

        .list-group li:last-child {
            border-bottom: none;
        }

        .badge {
            background: #ddd;
            border-radius: 20px;
            padding: 5px 10px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .text-muted {
            color: #999;
        }
    </style>


<div class="container">
    <h1>All Users</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create New User</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? 'N/A' }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.users.delete', $user) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
