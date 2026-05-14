<?php
require_once __DIR__ . '/config/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Web Project - Spring 25-26 G8</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/views/layouts/navbar.php'; ?>
    <main class="container">
        <h1>Web Project - Spring 25-26 G8</h1>
        <p>Starter MVC structure is ready.</p>
        <h3>Task Ownership</h3>
        <ul>
            <li>Task 1: Auth & Workspace</li>
            <li>Task 2: Project Management</li>
            <li>Task 3: Task Board & Status Management</li>
            <li>Task 4: Comments & Activity Log</li>
        </ul>
    </main>
    <?php include __DIR__ . '/views/layouts/footer.php'; ?>
</body>
</html>
