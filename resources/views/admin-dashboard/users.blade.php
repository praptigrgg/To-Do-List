<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
</head>
<body>

<div class="container">
    <h1>User Dashboard</h1>

    {{-- Stats --}}
    <div class="stats">
        <div class="card">
            <h5>Total Users</h5>
            <h2>{{ $totalUsers }}</h2>
        </div>

    </div>



    {{-- Recent Signups --}}
    <div class="section">
        <h3>Recent Signups</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentUsers as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{$user->role}}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-muted text-center">No recent signups found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
