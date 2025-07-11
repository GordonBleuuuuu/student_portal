<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
            box-sizing: border-box;
        }
        body {
            background-color: #006937; /* FEU Green */
            margin: 0;
            padding: 0;
            height: 100vh;
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
        .registration-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            color: #006937;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
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

<div class="registration-container">
    <h2>Student Registration</h2>
    
    <form method="POST" action="">
        Full Name: <input type="text" name="fullname" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        Contact: <input type="text" name="contact"><br>
        Course: <input type="text" name="course"><br>
        <input type="submit" name="register" value="Register">
    </form>

    <?php
    if (isset($_POST['register'])) {
        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $contact = $_POST['contact'];
        $course = $_POST['course'];

        $sql = "INSERT INTO users (fullname, email, password, contact, course)
                VALUES ('$name', '$email', '$pass', '$contact', '$course')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='message success'>Registration successful!</div>";
        } else {
            echo "<div class='message error'>Error: " . $conn->error . "</div>";
        }
    }
    ?>
</div>

</body>
</html>
