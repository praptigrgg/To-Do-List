@extends('welcome')
@section('content')
    <div class="container">
        <h2>Forgot Password</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Enter your email to receive an OTP:</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Send OTP</button>
        </form>
    </div>
@endsection

