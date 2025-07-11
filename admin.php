<?php
include('config/db.php');
session_start();
// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin_login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Montserrat', sans-serif; box-sizing: border-box; }
        body { margin: 0; background-color: #f4f4f4; display: flex; height: 100vh; }
        .sidebar {
            width: 230px; background-color: #006937; color: white; padding: 20px;
            display: flex; flex-direction: column; align-items: center; position: fixed; height: 100%;
        }
        .sidebar h3 { margin: 10px 0 20px 0; text-align: center; }
        .sidebar img { width: 100px; margin-bottom: 15px; }
        .sidebar a {
            color: white; text-decoration: none; margin: 10px 0; display: block; font-weight: bold;
            width: 100%; text-align: center; padding: 8px; border-radius: 6px; transition: background-color 0.3s ease;
        }
        .sidebar a:hover { background-color: #004d29; }
        .content { margin-left: 230px; flex-grow: 1; padding: 40px; }
        .content h2 { color: #006937; margin-bottom: 20px; }
        .card {
            background: white; padding: 20px; border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 20px;
            max-width: 400px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="feu_logo.png" alt="Logo">
    <h3>ADMIN PANEL</h3>
    <a href="admin.php">Dashboard</a>
    <a href="admin_add_grades.php">Add Grades</a>
    <a href="admin_view_grades.php">View All Grades</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Welcome, Admin!</h2>

    <div class="card">
        <h3>Quick Actions</h3>
        <ul>
            <li><a href="admin_add_grades.php">➤ Add Student Grades</a></li>
            <li><a href="admin_view_grades.php">➤ View All Grades</a></li>
            <li><a href="delete.php">➤ Delete User</a></li>
        </ul>
    </div>
</div>

</body>
</html>
