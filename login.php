<?php
include('config/db.php');
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: profile.php"); // Redirect to profile page
            exit();
        } else {
            $message = "<div class='message error'>Incorrect password.</div>";
        }
    } else {
        $message = "<div class='message error'>No user found with that email.</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #006937; /* FEU Green */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #e0f2ea;
            color: #006937;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #cce8db;
        }
        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
            position: relative;
        }
        .logo-image {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }
        h2 {
            color: #006937;
            margin-bottom: 20px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type="submit"] {
            background-color: #006937;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #004d29;
        }
        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<a href="index.php" class="back-btn">← Back</a>

<div class="login-container">
    <img src="feu_logo.png" alt="Logo" class="logo-image">

    <h2>Login</h2>

    <?php if (isset($message)) echo $message; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</div>

</body>
</html>
