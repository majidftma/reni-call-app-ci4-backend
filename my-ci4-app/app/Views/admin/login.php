<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?php echo session()->getFlashdata('error'); ?></p>
    <?php endif; ?>
    <form method="post" action="/admin/authenticate">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
