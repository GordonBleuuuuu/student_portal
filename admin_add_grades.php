<?php
include('config/db.php');
session_start();

// Optional: Add your admin-only check here if needed

// Fetch all registered users for dropdown
$users = $conn->query("SELECT id, fullname FROM users");

if (isset($_POST['add_grade'])) {
    $user_id = $_POST['user_id'];
    $subject = $_POST['subject'];
    $final_grade = $_POST['final_grade'];
    $status = $_POST['status'];

    $sql = "INSERT INTO grades (user_id, subject, final_grade, status)
            VALUES ('$user_id', '$subject', '$final_grade', '$status')";

    if ($conn->query($sql)) {
        $message = "<div class='success'>Grade added successfully!</div>";
    } else {
        $message = "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Add Grades</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Montserrat', sans-serif; box-sizing: border-box; }
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .grade-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 {
            color: #006937;
            text-align: center;
            margin-bottom: 20px;
        }
        select, input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
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
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="grade-form">
    <h2>Add Student Grade</h2>

    <?php if (isset($message)) echo $message; ?>

    <form method="POST">
        <label>Student:</label>
        <select name="user_id" required>
            <option value="">Select Student</option>
            <?php
            while ($row = $users->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['fullname']}</option>";
            }
            ?>
        </select>

        <label>Subject:</label>
        <input type="text" name="subject" placeholder="e.g., Web Development" required>

        <label>Final Grade:</label>
        <input type="number" name="final_grade" min="0" max="100" step="0.01" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="Passed">Passed</option>
            <option value="Failed">Failed</option>
            <option value="Incomplete">Incomplete</option>
        </select>

        <input type="submit" name="add_grade" value="Add Grade">
    </form>
</div>

</body>
</html>
