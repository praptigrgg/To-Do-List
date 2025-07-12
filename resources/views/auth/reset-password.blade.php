<form method="POST" action="{{ route('reset.password') }}">
    @csrf
    <input name="password" type="password" placeholder="New password" required>
    <input name="password_confirmation" type="password" placeholder="Confirm password" required>
    <button type="submit">Reset Password</button>
</form>
