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
    <strong>Endpoint:</strong> <code>POST /verify-otp</code><br>
    <strong>Description:</strong> Verifies the OTP sent to the user and authenticates them. If the OTP is valid, the system will either log in an existing user or create a new user.<br>
    <strong>Request Parameters:</strong>
    <pre>{
    "session_id": "your_session_id",
    "otp": "123456",
    "mobile": "9876543210"
}</pre>
    <strong>Response (Success - User Verified):</strong>
    <pre>{
    "message": "OTP verified",
    "tokens": {
        "access_token": "your_access_token",
        "refresh_token": "your_refresh_token"
    },
    "user": {
        "id": 1,
        "mobile": "9876543210",
        "created_at": "2024-03-16 12:00:00"
    }
}</pre>
    <strong>Response (Error - Missing Required Fields):</strong>
    <pre>{
    "status": 400,
    "error": "Session ID and OTP are required"
}</pre>
    <strong>Response (Error - OTP Verification Failed):</strong>
    <pre>{
    "status": 401,
    "error": "Failed to verify OTP"
}</pre>
</div>



        <h2>3. Refresh Access Token</h2>
<div class="endpoint">
    <strong>Endpoint:</strong> <code>POST /auth/refresh-tokens</code><br>
    <strong>Description:</strong> Refreshes the access token using a valid refresh token.<br>
    <strong>Request Parameters:</strong>
    <pre>{
    "refresh_token": "your_refresh_token"
}</pre>
    <strong>Response (Success):</strong>
    <pre>{
    "access_token": "new_access_token",
    "refresh_token": "new_refresh_token"
}</pre>
    <strong>Response (Error - Missing Refresh Token):</strong>
    <pre>{
    "status": 400,
    "error": "Refresh token is required"
}</pre>
    <strong>Response (Error - Invalid or Expired Refresh Token):</strong>
    <pre>{
    "status": 401,
    "error": "Invalid or expired refresh token"
}</pre>
    <strong>Response (Error - User Not Found):</strong>
    <pre>{
    "status": 404,
    "error": "User not found"
}</pre>
</div>



    </div>
</div>


<?= $this->endSection() ?>

