@extends('main')

@section('title', ' | Login')

@section('styles')
<style>
    .btn-pink {
    background-color: #d8a7b1;
    color: white;
    font-weight: bold;
    border: none;
}
.btn-pink:hover {
    background-color: #c48a9e;
}

</style>
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm p-4" style="max-width: 400px; margin: auto;">
    <h2 class="text-center text-muted mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-pink w-100">Login</button>
           <p>
        <a href="{{route('password.request')}}">Forgot Password?</a>  Click Here !!
    </p>
    </form>
    <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>

</div>
@endsection
