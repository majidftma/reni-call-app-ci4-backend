<?= $this->extend('api-docs/layouts/main') ?>


<?= $this->section('content') ?>


<div class="container">
<div class="container">
        <h1>OTPController API Documentation</h1>
        <p>This API provides endpoints for sending and verifying OTPs using 2Factor API.</p>

        <h2>1. Send OTP</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /sendOtp</code><br>
            <strong>Description:</strong> Sends an OTP to the provided phone number.<br>
            <strong>Request Parameters:</strong>
            <pre>{
    "phone": "9876543210"
}</pre>
            <strong>Response:</strong>
            <pre>{
    "message": "OTP sent successfully.",
    "details": {"Status": "Success", "Details": "session_id"}
}</pre>
        </div>

        <h2>2. Verify OTP</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /verifyOtp</code><br>
            <strong>Description:</strong> Verifies the OTP and returns a JWT token on success.<br>
            <strong>Request Parameters:</strong>
            <pre>{
    "session_id": "abcd1234",
    "otp": "123456",
    "mobile": "9876543210"
}</pre>
            <strong>Success Response:</strong>
            <pre>{
    "message": "OTP verified",
    "token": "jwt_token_here",
    "user": {
        "id": 1,
        "mobile": "9876543210",
        "created_at": "2024-03-16 10:00:00"
    }
}</pre>
            <strong>Error Response:</strong>
            <pre>{
    "error": "Failed to verify OTP"
}</pre>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

