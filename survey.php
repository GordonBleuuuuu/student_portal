<?php
include('config/db.php');
session_start();

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];

    if ($user_id) {
        $sql = "INSERT INTO survey_responses (user_id, q1, q2, q3)
                VALUES ('$user_id', '$q1', '$q2', '$q3')";
        if ($conn->query($sql)) {
            $message = "<div class='message success'>Survey submitted successfully!</div>";
        } else {
            $message = "<div class='message error'>Error: " . $conn->error . "</div>";
        }
    } else {
        $message = "<div class='message error'>You must be logged in to answer the survey.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Survey</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
            box-sizing: border-box;
        }
        body {
            background-color: #006937;
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
        .survey-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        h2 {
            color: #006937;
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            display: block;
            margin: 8px 0 5px 0;
        }
        textarea, select, input[type="radio"] {
            margin: 5px 0 15px 0;
        }
        textarea, select {
            width: 100%;
            padding: 8px;
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

<div class="survey-container">
    <h2>Student Survey</h2>

    <?php if (isset($message)) echo $message; ?>

    <form method="POST">
        <label>1. How satisfied are you with the courses?</label>
        <input type="radio" name="q1" value="Very Satisfied" required> Very Satisfied<br>
        <input type="radio" name="q1" value="Satisfied"> Satisfied<br>
        <input type="radio" name="q1" value="Neutral"> Neutral<br>
        <input type="radio" name="q1" value="Dissatisfied"> Dissatisfied<br><br>

        <label>2. How would you rate the facilities?</label>
        <select name="q2" required>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Fair">Fair</option>
            <option value="Poor">Poor</option>
        </select><br><br>

        <label>3. Additional comments:</label>
        <textarea name="q3" rows="4"></textarea><br><br>

        <input type="submit" name="submit" value="Submit Survey">
    </form>
</div>

</body>
</html>
