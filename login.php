<?php
include 'includes/config.php';
include 'includes/functions.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (login($username, $password)) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="logo.png" href="images/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        header {
            background-color: #053b00;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        form {
            width: 90%;
            margin: 200px auto 20px auto;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f4f4f4;
        }

        h2 {
            margin-bottom: 20px;
        }

        label, input, button {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
        }

        button {
            background-color: #053b00;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #045000;
        }

        footer {
            background-color: #053b00;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        p.error {
            color: red;
        }

        p a {
            color: #053b00;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="images/bg.png" alt="Hospital Logo" style="height: 60px; vertical-align: middle; margin-right: 20px;">
            <h1 style="display: inline-block; vertical-align: middle;">Baguio General Hospital and Medical Center</h1>
        </div>
    </header>

    <form method="POST" action="">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
        <p><a href="register.php">Register</a></p>
    </form>

    <footer>
        <div class="container">
            <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
