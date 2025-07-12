@extends('main')

@section('title', ' | Register')

@section('styles')
<style>
    .form-container {
        max-width: 450px;
        margin: 3rem auto;
        background-color: #fffaf8;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(180, 150, 160, 0.2);
    }

    h2 {
        color: #b07c8c;
        text-align: center;
        margin-bottom: 1.5rem;
    }

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
<div class="form-container">
    <h2>Create Your Account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-pink w-100">Register</button>
    </form>
    <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>

</div>
@endsection
