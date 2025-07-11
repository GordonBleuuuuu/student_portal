<?php
include('config/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM users WHERE id = $user_id");

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Appointment</title>
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
        form {
            background: white; padding: 25px; border-radius: 8px; max-width: 500px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border-radius: 6px; border: 1px solid #ccc; }
        input[type="submit"] {
            background-color: #006937; color: white; border: none; cursor: pointer; font-weight: bold;
        }
        input[type="submit"]:hover { background-color: #004d29; }
    </style>
</head>
<body>

<div class="sidebar">
    <img src="feu_logo.png" alt="Logo">
    <h3><?php echo strtoupper($user['fullname']); ?></h3>
    <a href="profile.php">User Profile</a>
    <a href="survey.php">Survey</a>
    <a href="appointment.php">Appointments</a>
    <a href="grades.php">Grade Report</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Set an Appointment</h2>
    <form method="POST">
        <label>Select Date:</label>
        <input type="date" name="appointment_date" required>

        <label>Reason for Appointment:</label>
        <select name="reason" required>
            <option value="Advising">Academic Advising</option>
            <option value="Documents">Document Request</option>
            <option value="Concerns">Other Concerns</option>
        </select>

        <input type="submit" name="book" value="Book Appointment">
    </form>

    <?php
    if (isset($_POST['book'])) {
        $date = $_POST['appointment_date'];
        $reason = $_POST['reason'];

        $sql = "INSERT INTO appointments (user_id, appointment_date, reason)
                VALUES ('$user_id', '$date', '$reason')";
                
        if ($conn->query($sql)) {
            echo "<p style='color:green; margin-top:15px;'>Appointment booked successfully!</p>";
        } else {
            echo "<p style='color:red; margin-top:15px;'>Error: " . $conn->error . "</p>";
        }
    }
    ?>
</div>

</body>
</html>
