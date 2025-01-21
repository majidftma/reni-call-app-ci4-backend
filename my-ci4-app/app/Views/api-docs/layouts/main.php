
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
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            background-color: #ecf0f1;
            min-height: 100vh;
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
    <div class="sidebar">
        <!-- Sidebar content -->
        <ul>
            <li><a href="<?php echo base_url('api/docs/otp'); ?>">OTP Documentation</a></li>
            <li><a href="<?php echo base_url('api/docs/user'); ?>">User Documentation</a></li>
            <li><a href="<?php echo base_url('api/docs/plan'); ?>">Plan Documentation</a></li>
            <li><a href="<?php echo base_url('api/docs/payment'); ?>">Payment Documentation</a></li>


            <!-- Add more links as needed -->
        </ul>
    </div>
    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>
    <footer>
    <p>© 2025 OTP API Documentation</p>
</footer>
</body>
</html>
