<form method="POST" action="{{ route('forgot.send') }}">
    @csrf
    <input name="email" type="email" placeholder="Enter your email" required>
    <button type="submit">Send OTP</button>
</form>
