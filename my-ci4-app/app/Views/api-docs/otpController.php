
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP API Documentation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1, h2, h3 {
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007bff;
            color: #fff;
        }
        pre {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }
        .code {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            color: #c7254e;
            font-family: Consolas, "Courier New", monospace;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>

<header>
    <h1>OTP API Documentation</h1>
</header>

<div class="container">
    <h2>Base URL</h2>
    <p><code class="code">http://your-backend-domain</code></p>

    <h2>1. Send OTP</h2>
    <h3>Endpoint</h3>
    <p><code class="code">POST /send-otp</code></p>

    <h3>Request Headers</h3>
    <table>
        <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Content-Type</td>
                <td>application/json</td>
            </tr>
        </tbody>
    </table>

    <h3>Request Body</h3>
    <pre>{
    "phone": "+919999999999"
}</pre>

    <h3>Response</h3>
    <h4>Success (HTTP 200)</h4>
    <pre>{
    "message": "OTP sent successfully.",
    "details": {
        "Status": "Success",
        "Details": "SESSION_ID"
    }
}</pre>

    <h4>Error (HTTP 400)</h4>
    <pre>{
    "status": 400,
    "error": 400,
    "messages": {
        "error": "Phone number is required"
    }
}</pre>

    <h4>Error (HTTP 500)</h4>
    <pre>{
    "status": 500,
    "error": 500,
    "messages": {
        "error": "Failed to send OTP"
    }
}</pre>

    <h2>2. Verify OTP</h2>
    <h3>Endpoint</h3>
    <p><code class="code">POST /verify-otp</code></p>

    <h3>Request Headers</h3>
    <table>
        <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Content-Type</td>
                <td>application/json</td>
            </tr>
        </tbody>
    </table>

    <h3>Request Body</h3>
    <pre>{
    "session_id": "SESSION_ID_FROM_SEND_OTP_RESPONSE",
    "otp": "123456"
}</pre>

    <h3>Response</h3>
    <h4>Success (HTTP 200)</h4>
    <pre>{
    "message": "OTP verified successfully.",
    "details": {
        "Status": "Success",
        "Details": "OTP Matched"
    }
}</pre>

    <h4>Error (HTTP 400)</h4>
    <pre>{
    "status": 400,
    "error": 400,
    "messages": {
        "error": "Session ID and OTP are required"
    }
}</pre>

    <h4>Error (HTTP 401)</h4>
    <pre>{
    "status": 401,
    "error": 401,
    "messages": {
        "error": "Failed to verify OTP"
    }
}</pre>

    <h2>Error Codes</h2>
    <table>
        <thead>
            <tr>
                <th>HTTP Status Code</th>
                <th>Error Message</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>400</td>
                <td>Phone number is required</td>
                <td>The <code>phone</code> parameter was not provided.</td>
            </tr>
            <tr>
                <td>400</td>
                <td>Session ID and OTP are required</td>
                <td>The <code>session_id</code> or <code>otp</code> parameter was missing.</td>
            </tr>
            <tr>
                <td>500</td>
                <td>Failed to send OTP</td>
                <td>An error occurred while communicating with the OTP service.</td>
            </tr>
            <tr>
                <td>401</td>
                <td>Failed to verify OTP</td>
                <td>The OTP entered is incorrect or expired.</td>
            </tr>
        </tbody>
    </table>
</div>

<footer>
    <p>© 2025 OTP API Documentation</p>
</footer>

</body>
</html>

