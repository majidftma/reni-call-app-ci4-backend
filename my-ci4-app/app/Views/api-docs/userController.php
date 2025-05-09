<?= $this->extend('api-docs/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
<h1>UserController API Documentation</h1>
        <p>This API provides endpoints for managing users, including creation, updating, and retrieval.</p>
<!-- 
        <h2>1. Create User</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /api/users</code><br>
            <strong>Description:</strong> Creates a new user along with a wallet.<br>
            <strong>Request Parameters:</strong>
            <pre>{
    "name": "John Doe",
    "mobile": "9876543210",
    "age": 1990-12-31,
    "preferred_language": 1
}</pre>
            <strong>Response:</strong>
            <pre>{
    "message": "User and wallet created successfully.",
    "user_id": 1
}</pre>
        </div>
 -->
        <h2>2. Create or Update User</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>POST /api/create-or-update-user</code><br>
            <strong>Description:</strong> Updates an existing user or creates a new one if the mobile number is not found.<br>
            <strong>Request Parameters:</strong>
            <pre>{
    "mobile": "9876543210",
    "name": "John Doe",
    "dob": "1993-05-10",
    "preferred_language": 1
}</pre>
            <strong>Response:</strong>
            <pre>{
    "message": "User and wallet created successfully.",
    "user_id": 1
}</pre>
        </div>

        <h2>3. Get All Users</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>GET /api/users</code><br>
            <strong>Description:</strong> Retrieves all users along with their preferred language.<br>
            <strong>Response:</strong>
            <pre>[{
    "id": 1,
    "name": "John Doe",
    "mobile": "9876543210",
    "dob": 1990-12-31,
    "preferred_language": 1,
    "language": "English"
}]</pre>
        </div>

        <h2>4. Get User by ID</h2>
        <div class="endpoint">
            <strong>Endpoint:</strong> <code>GET /api/users/{id}</code><br>
            <strong>Description:</strong> Retrieves a user by their ID, including their preferred language.<br>
            <strong>Response:</strong>
            <pre>{
    "id": 1,
    "name": "John Doe",
    "mobile": "9876543210",
    "dob": 1990-12-31,
    "preferred_language": 1,
    "language": "English"
}</pre>
        </div>

        
    <h2>5. JWT Authentication</h2>
        <div class="endpoint">
            <strong>Description:</strong> This API uses JWT for authentication. Each request must include a valid token in the Authorization header.<br>
            <strong>Authorization Header Format:</strong>
            <pre>Authorization: Bearer &lt;your_token_here&gt;</pre>
        </div>

        <h2>6. Protected Routes</h2>
        <div class="endpoint">
            <strong>How it Works:</strong> The system verifies the token using a secret key stored in the environment variable <code>JWT_SECRET</code>.<br>
            <strong>On Success:</strong> The decoded token's user information is accessible throughout the request lifecycle.<br>
            <strong>On Failure:</strong> The API returns an error if the token is missing or invalid.<br>
            <strong>Error Response:</strong>
            <pre>{
    "error": "Invalid token"
}</pre>
        </div>
        <h2>7. Get User Details</h2>
<div class="endpoint">
    <strong>Endpoint:</strong> <code>POST /api/users/get-user</code><br>
    <strong>Description:</strong> Retrieves user details based on the provided access token.<br>
    <strong>Headers:</strong><br>
    <code>Authorization: Bearer your_access_token</code><br>
    <strong>Response (Success):</strong>
    <pre>{
    "id": 1,
    "name": "John Doe",
    "email": "johndoe@example.com",
    "mobile": "1234567890",
    "preferred_language": 2,
    "language": "English",
    "balance": 100.50
}</pre>
    <strong>Response (Error - Missing Authorization Token):</strong>
    <pre>{
    "status": 401,
    "error": "Access token is required"
}</pre>
    <strong>Response (Error - Invalid Token):</strong>
    <pre>{
    "status": 401,
    "error": "Invalid or expired token"
}</pre>
    <strong>Response (Error - User Not Found):</strong>
    <pre>{
    "status": 404,
    "error": "User not found"
}</pre>
</div>


<h2>8. Update Online Status</h2>
<div class="endpoint">
    <strong>Endpoint:</strong> <code>POST /api/users/update-online-status</code><br>
    <strong>Description:</strong> Updates the online status of a user based on the provided token.<br>
    <strong>Headers:</strong><br>
    <code>Authorization: Bearer your_access_token</code><br>
    <strong>Request Parameters:</strong>
    <pre>{
    "status": 1  // Use 1 for online, 0 for offline
}</pre>
    <strong>Response (Success):</strong>
    <pre>{
    "message": "Online status updated successfully."
}</pre>
    <strong>Response (Error - Missing Authorization Token):</strong>
    <pre>{
    "status": 401,
    "error": "Authorization token is required"
}</pre>
    <strong>Response (Error - Invalid Token):</strong>
    <pre>{
    "status": 401,
    "error": "Invalid access token"
}</pre>
    <strong>Response (Error - Invalid Status Value):</strong>
    <pre>{
    "status": 400,
    "error": "Invalid status value. Use 1 for online and 0 for offline."
}</pre>
    <strong>Response (Error - Update Failed):</strong>
    <pre>{
    "status": 500,
    "error": "Failed to update online status"
}</pre>
</div>


    </div>

</div>
<?= $this->endSection() ?>
