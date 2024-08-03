<?php
include '../includes/config.php';
include '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$patient_id = isset($_GET['patient_id']) ? intval($_GET['patient_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ward = $_POST['ward'];
    $datetime_of_admission = $_POST['datetime_of_admission'];
    $sql = "INSERT INTO admissions (patient_id, ward, datetime_of_admission) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $patient_id, $ward, $datetime_of_admission);
    if ($stmt->execute()) {
        header('Location: list.php');
        exit();
    } else {
        $error = "Error admitting patient.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admit Patient</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" type="logo.png" href="../images/logo.png">
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
            width: 90%;
            margin: 0 auto;
        }

        .sidebar {
            width: 230px;
            background-color: #f4f4f4;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 80px; 
            left: 0;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../images/b.jpg');
            background-size: cover;
            opacity: 0.2;
            z-index: -1;
        }

        .sidebar nav a {
            display: block;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .sidebar nav a:hover {
            background-color: #ddd;
        }

        main {
            margin-left: 220px;
            padding: 100px 20px 20px; 
            flex-grow: 1;
        }

        form {
            margin-top: 20px;
            width: 90%;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
        }

        label, input, select, textarea, button {
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
    </style>
</head>
<body>
    <header>
        <div class="container">
        <img src="../images/bg.png" alt="Hospital Logo" style="height:  60px; vertical-align: middle; margin-right: 20px;">
        <h1 style="display: inline-block; vertical-align: middle;">Baguio General Hospital and Medical Center</h1>
        </div>
    </header>

    <div class="sidebar">
        <nav>
            <a href="list.php" class="back-button">Back to Admissions</a>
        </nav>
    </div>

    <main>
        <form method="POST" action="">
            <h2>Admit Patient</h2>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
            <label>Ward:</label>
            <select name="ward" required>
                <option value="General Ward">General Ward</option>
                <option value="Pediatric Ward">Pediatric Ward</option>
                <option value="OB Ward">OB Ward</option>
                <option value="Surgical Ward">Surgery Ward</option>
                <option value="ICU">ICU</option>
                <option value="Emergency Ward">Emergency Ward</option>
                <option value="Psychiatric Ward">Psychiatric Ward</option>
                <option value="Private Suite">Private Suite</option>
                <option value="Semi-Private Suite">Semi-Private Suite</option>
                <option value="Orthopedic Ward">Orthopedic Ward</option>
            </select>
            <label>Admission Date and Time:</label>
            <input type="datetime-local" name="datetime_of_admission" required>
            <button type="submit">Admit</button>
        </form>
    </main>

    <footer>
        <div class="container">
        <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
