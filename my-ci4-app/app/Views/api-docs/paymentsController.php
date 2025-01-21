<?= $this->extend('api-docs/layouts/main') ?>
<?= $this->section('content') ?>
<h1>API Documentation: PaymentController</h1>
    <p>This API allows integration with Razorpay for creating orders and verifying payments. Below are the available endpoints:</p>

    <h2>Base URL</h2>
    <p><code>{your-domain}/api/payment</code></p>

    <div class="endpoint">
        <h2>1. Create a Payment Order</h2>
        <h3>Route:</h3>
        <p><code>POST /api/payment/create-order</code></p>
        <h3>Description:</h3>
        <p>Creates a new Razorpay order for payment.</p>
        
        <h3>Request Headers:</h3>
        <ul>
            <li><strong>Content-Type:</strong> <code>application/json</code></li>
        </ul>
        
        <h3>Request Body:</h3>
        <pre>
{
    "user_id": 123,        // User's ID (integer, required)
    "amount": 1000.50      // Payment amount in INR (numeric, required)
}
        </pre>
        <h3>Validation Rules:</h3>
        <ul>
            <li><code>user_id</code>: Required, must be an integer.</li>
            <li><code>amount</code>: Required, must be a numeric value, up to 10 digits, greater than 0.</li>
        </ul>
        
        <h3>Response:</h3>
        <h4>Success:</h4>
        <div class="response">
            <pre>
{
    "order_id": "order_ABC123",  // Razorpay order ID
    "amount": 1000.50,          // Payment amount
    "user_id": 123,             // User ID
    "status": "Order Created"   // Order status
}
            </pre>
        </div>
        <h4>Error Responses:</h4>
        <h5>Validation Errors (400 Bad Request):</h5>
        <div class="response">
            <pre>
{
    "status": "fail",
    "errors": {
        "user_id": "The user_id field is required.",
        "amount": "The amount field must be greater than 0."
    }
}
            </pre>
        </div>
        <h5>Server Errors (500 Internal Server Error):</h5>
        <div class="response">
            <pre>
{
    "status": "fail",
    "message": "Failed to create order."
}
            </pre>
        </div>
    </div>

    <div class="endpoint">
        <h2>2. Verify Payment</h2>
        <h3>Route:</h3>
        <p><code>POST /api/payment/verify</code></p>
        <h3>Description:</h3>
        <p>Verifies the Razorpay payment signature and stores transaction details in the database.</p>

        <h3>Request Headers:</h3>
        <ul>
            <li><strong>Content-Type:</strong> <code>application/json</code></li>
        </ul>

        <h3>Request Body:</h3>
        <pre>
{
    "razorpay_signature": "12345abcde", // Razorpay payment signature (required)
    "razorpay_payment_id": "pay_ABC123", // Razorpay payment ID (required)
    "razorpay_order_id": "order_ABC123", // Razorpay order ID (required)
    "user_id": 123, // User ID (integer, required)
    "amount": 1000.50 // Payment amount in INR (numeric, required)
}
        </pre>

        <h3>Response:</h3>
        <h4>Success:</h4>
        <div class="response">
            <pre>
{
    "status": "Payment Verified",
    "transaction_id": 101
}
            </pre>
        </div>
        <h4>Error Responses:</h4>
        <h5>Validation Errors (400 Bad Request):</h5>
        <div class="response">
            <pre>
{
    "status": "fail",
    "errors": {
        "razorpay_signature": "The razorpay_signature field is required."
    }
}
            </pre>
        </div>
        <h5>Server Errors (500 Internal Server Error):</h5>
        <div class="response">
            <pre>
{
    "status": "fail",
    "message": "Invalid payment signature."
}
            </pre>
        </div>
    </div>



<?= $this->endSection() ?>
