<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Montserrat', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #006937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            color: white;
            padding: 20px;
        }
        h1 {
            margin-top: 40px;
            margin-bottom: 20px;
            text-align: center;
        }
        nav {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav li {
            margin: 10px 0;
        }
        nav a {
            display: block;
            background-color: #006937;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }
        nav a:hover { background-color: #004d29; }
        .admin-section {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
            margin-bottom: 30px;
        }
        .admin-section h3 { color: #006937; margin-bottom: 15px; }
        .admin-section a {
            display: block;
            background-color: #004d29;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .admin-section a:hover { background-color: #00301b; }
        footer {
            margin-top: auto;
            padding: 15px;
            text-align: center;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>

<h1>Student Portal</h1>

<nav>
    <ul>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="profile.php">Edit Profile</a></li>
        <li><a href="view.php">View Info</a></li>
        <li><a href="appointment.php">Set Appointment</a></li>
    </ul>
</nav>

<div class="admin-section">
    <h3>Admin Access</h3>
    <a href="admin_login.php">Go to Admin Panel</a>
</div>

<footer>
    &copy; All rights reserved Bianca Andrea Muncal 2025
</footer>

</body>
</html>
