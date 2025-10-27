<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Student Portal</a>
            <?php if (isLoggedIn()): ?>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="create_student.php">Create Student</a>
                <a class="nav-link" href="view_students.php">View Students</a>
                <a class="nav-link" href="logout.php">Logout (<?php echo $_SESSION['admin_username']; ?>)</a>
            </div>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-4">