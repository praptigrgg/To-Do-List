 <div class="container">
        <h2>Verify OTP</h2>

        <form action="{{ route('otp.verify') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="otp">Enter OTP:</label>
                <input type="text" name="otp" id="otp" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Verify</button>
        </form>
    </div>
