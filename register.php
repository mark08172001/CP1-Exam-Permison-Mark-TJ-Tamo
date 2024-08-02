<?php
include 'includes/config.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (register($username, $password)) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Registration failed. Username might be taken.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <header>
        <div class="container">
        <img src="bg.png" alt="Hospital Logo" style="height:  60px; vertical-align: middle; margin-right: 20px;">
        <h1 style="display: inline-block; vertical-align: middle;">Baguio General Hospital and Medical Center</h1>
        </div>
    </header>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <form method="POST" action="">
        <h2>Register</h2>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
        <p><a href="login.php">Login</a></p>
    </form>

    <footer>
        <div class="container">
            <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
