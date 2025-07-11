<?php
include('config/db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['upload']) && isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $allowed_types = ['image/jpeg', 'image/png'];
    $file_type = $_FILES["profile_pic"]["type"];

    if (in_array($file_type, $allowed_types)) {
        $target_dir = "uploads/";
        $filename = basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . time() . "_" . $filename;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            resizeImage($target_file, 150, 150);
            $conn->query("UPDATE users SET profile_pic = '$target_file' WHERE id = $user_id");
            $message = "<div class='success'>Profile picture updated successfully!</div>";
        } else {
            $message = "<div class='error'>Failed to upload image.</div>";
        }
    } else {
        $message = "<div class='error'>Only JPG and PNG files are allowed.</div>";
    }
}



$result = $conn->query("SELECT * FROM users WHERE id = $user_id");

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

// Resize Image
function resizeImage($file, $w, $h) {
    list($width, $height, $type) = getimagesize($file);

    $src = ($type == IMAGETYPE_PNG) ? imagecreatefrompng($file) : imagecreatefromjpeg($file);

    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

    if ($type == IMAGETYPE_PNG) {
        imagepng($dst, $file);
    } else {
        imagejpeg($dst, $file, 90);
    }
    imagedestroy($src);
    imagedestroy($dst);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <style>
    * {
        font-family: 'Montserrat', sans-serif;
        box-sizing: border-box;
    }
    body {
        margin: 0;
        background-color: #f4f4f4;
        display: flex;
        height: 100vh;
        overflow: hidden;
    }
    .sidebar {
        width: 230px;
        background-color: #006937;
        color: white;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: fixed;
        height: 100%;
    }
    .sidebar h3 {
        margin: 10px 0 20px 0;
        text-align: center;
    }
    .sidebar img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 15px;
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        margin: 10px 0;
        display: block;
        font-weight: bold;
        width: 100%;
        text-align: center;
        padding: 8px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }
    .sidebar a:hover {
        background-color: #004d29;
    }
    .content {
        margin-left: 230px;
        flex-grow: 1;
        padding: 40px;
    }
    .content h2 {
        color: #006937;
        margin-bottom: 20px;
    }
    .profile-info {
        background: white;
        padding: 25px;
        border-radius: 8px;
        max-width: 600px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .profile-info p {
        margin: 12px 0;
        font-size: 16px;
    }

    .upload-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        margin-top: 15px;
    }
    .upload-form input[type="file"] {
        margin-bottom: 10px;
        text-align: center;
    }
    .upload-form input[type="submit"] {
        background-color: #ffc107;
        color: #1b3a1b;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        width: 120px;
        text-align: center;
        transition: background-color 0.3s ease;
        margin-top: 5px;
    }
    .upload-form input[type="submit"]:hover {
        background-color:rgb(224, 168, 0);
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 10px;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 10px;
    }
</style>

</head>
<body>

<div class="sidebar">
    <?php if ($user['profile_pic']) { ?>
        <img src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture">
    <?php } else { ?>
        <img src="images/default_user.png" alt="Profile Picture">
    <?php } ?>

    <h3><?php echo strtoupper($user['fullname']); ?></h3>

    <form method="POST" enctype="multipart/form-data" class="upload-form">
        <input type="file" name="profile_pic" required>
        <input type="submit" name="upload" value="Upload">
    </form>

    <a href="profile.php">User Profile</a>
    <a href="survey.php">Survey</a>
    <a href="appointment.php">Appointments</a>
    <a href="grades.php">Grade Report</a>
    <a href="logout.php">Logout</a>

</div>

<div class="content">
    <h2>User Profile</h2>
    
    <?php if (isset($message)) echo $message; ?>

    <div class="profile-info">
        <p><strong>Full Name:</strong> <?php echo $user['fullname']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Contact:</strong> <?php echo $user['contact']; ?></p>
        <p><strong>Course:</strong> <?php echo $user['course']; ?></p>
    </div>
</div>

</body>
</html>
