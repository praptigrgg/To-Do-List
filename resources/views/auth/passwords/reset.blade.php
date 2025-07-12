@extends('welcome')
@section('content')
<div class="container">
    <h2>Reset Password</h2>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required autofocus>
        </div>

        <div class="form-group mt-3">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Reset Password</button>
    </form>
</div>
@endsection
