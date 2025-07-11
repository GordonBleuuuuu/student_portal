<?php
include('config/db.php');

if (isset($_POST['delete'])) {
    $email = $_POST['email'];

    $sql = "DELETE FROM users WHERE email = '$email'";

    if ($conn->query($sql)) {
        if ($conn->affected_rows > 0) {
            echo "<p>User deleted successfully.</p>";
        } else {
            echo "<p>No user found with that email.</p>";
        }
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
</head>
<body>
<h2>Delete User by Email</h2>
<form method="POST">
    Email: <input type="email" name="email" required>
    <input type="submit" name="delete" value="Delete">
</form>
</body>
</html>