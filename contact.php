<?php
include('config/db.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql)) {
        echo "<p>Message sent successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>
<body>
<h2>Contact Us</h2>
<form method="POST">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Message:<br><textarea name="message" rows="5" cols="30" required></textarea><br>
    <input type="submit" name="submit" value="Send Message">
</form>
</body>
</html>