@include('home')
@section('content')
<form method="POST" action="{{ route('reset.otp.verify') }}">
    @csrf
    <input name="otp" type="text" placeholder="Enter OTP" required>
    <button type="submit">Verify OTP</button>
</form>
@endsection
