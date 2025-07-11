<?php
include('config/db.php');

$user = null;
if (isset($_POST['search'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<p>No user found with that email.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User</title>
</head>
<body>
<h2>Search User by Email</h2>
<form method="POST">
    Email: <input type="email" name="email" required>
    <input type="submit" name="search" value="Search">
</form>

<?php if ($user): ?>
<h3>User Details</h3>
<ul>
    <li><strong>Name:</strong> <?php echo $user['fullname']; ?></li>
    <li><strong>Email:</strong> <?php echo $user['email']; ?></li>
    <li><strong>Contact:</strong> <?php echo $user['contact']; ?></li>
    <li><strong>Course:</strong> <?php echo $user['course']; ?></li>
</ul>
<?php endif; ?>
</body>
</html>
