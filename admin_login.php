<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$adminEmail = "admin@feualabang.edu.ph";
$adminPassword = "admin123"; // Change as needed

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $message = "<div class='error'>Invalid credentials.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Montserrat', sans-serif; box-sizing: border-box; }
        body {
            background-color: #006937;
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }
        .login-box {
            background: white; padding: 30px; border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 300px; text-align: center;
        }
        h2 { color: #006937; margin-bottom: 20px; }
        input {
            width: 100%; padding: 10px; margin: 10px 0;
            border-radius: 6px; border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #006937; color: white; border: none; cursor: pointer; font-weight: bold;
        }
        input[type="submit"]:hover { background-color: #004d29; }
        .error {
            background-color: #f8d7da; color: #721c24;
            padding: 10px; border-radius: 6px; margin-bottom: 15px;
        }
        .back-btn {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #006937;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if (isset($message)) echo $message; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">
    </form>

    <a href="index.php" class="back-btn">← Back to Home</a>
</div>

</body>
</html>
