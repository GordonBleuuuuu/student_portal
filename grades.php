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
    <title>Grade Report</title>
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
        table {
            width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px; border: 1px solid #ddd; text-align: center;
        }
        th {
            background-color: #006937; color: white;
        }
        .no-data {
            margin-top: 20px;
            color: #555;
        }
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
    <h2>Grade Report</h2>

    <table>
        <tr>
            <th>Subject</th>
            <th>Final Grade</th>
            <th>Status</th>
        </tr>

        <?php
        $grades = $conn->query("SELECT * FROM grades WHERE user_id = $user_id");

        if ($grades->num_rows > 0) {
            while ($row = $grades->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['subject']}</td>
                        <td>{$row['final_grade']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No grades available.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
