<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?></title>
    <!-- Add CSS and JS for your dashboard -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.dashboard {
    display: flex;
    height: 100vh;
}

.sidebar {
    width: 250px;
    background-color: #333;
    color: #fff;
    padding: 20px;
}

.sidebar h3 {
    color: #fff;
    text-align: center;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 10px 0;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    display: block;
    padding: 10px;
    border-radius: 5px;
}

.sidebar ul li a:hover {
    background-color: #575757;
}

.content {
    flex-grow: 1;
    padding: 20px;
    background-color: #f4f4f4;
}

    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Left-Side Menu -->
        <aside class="sidebar">
            <h3>Admin Dashboard</h3>
            <ul>
                <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                <li><a href="<?= base_url('admin/users') ?>">Manage Users</a></li>
                <li><a href="<?= base_url('admin/plans') ?>">Plans</a></li>
                <li><a href="<?= base_url('admin/settings') ?>">Settings</a></li>
                <li><a href="<?= base_url('admin/logout') ?>">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</body>
</html>
