<?php
include '../includes/config.php';
include '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$admission_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datetime_of_discharge = $_POST['datetime_of_discharge'];
    $sql = "UPDATE admissions SET datetime_of_discharge = ? WHERE admission_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $datetime_of_discharge, $admission_id);
    if ($stmt->execute()) {
        header('Location: list.php');
        exit();
    } else {
        $error = "Error discharging patient.";
    }
}

$sql = "SELECT a.*, p.last_name, p.first_name FROM admissions a JOIN patients p ON a.patient_id = p.patient_id WHERE a.admission_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admission_id);
$stmt->execute();
$result = $stmt->get_result();
$admission = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discharge Patient</title>
    <link rel="stylesheet" href="../css/styles.css">
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
            background-image: url('https://bghmc.doh.gov.ph/wp-content/uploads/2016/10/payward-500x356.jpg'); 
            background-size: cover;
            padding: 15px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 80px; 
            left: 0;
        }

        .sidebar nav a {
            display: block;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
        }

        .sidebar nav a:hover {
            background-color: #fff;
        }

        main {
            margin-left: 220px; 
            padding: 100px 20px 20px; 
            flex-grow: 1;
        }

        form {
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
            <img src="../bg.png" alt="Hospital Logo" style="height:  60px; vertical-align: middle; margin-right: 20px;">
            <h1 style="display: inline-block; vertical-align: middle;"> Discharge Patient</h1>
        </div>
    </header>

    <div class="sidebar">
        <nav>
            <a href="list.php" class="back-button">Back to Admissions</a>
        </nav>
    </div>

    <main>
        <form method="POST" action="">
            <h2>Discharge Patient</h2>
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
            <label>Patient:</label>
            <input type="text" value="<?php echo htmlspecialchars($admission['last_name'] . ', ' . $admission['first_name']); ?>" disabled>
            <label>Admission Date:</label>
            <input type="text" value="<?php echo htmlspecialchars($admission['datetime_of_admission']); ?>" disabled>
            <label>Ward:</label>
            <input type="text" value="<?php echo htmlspecialchars($admission['ward']); ?>" disabled>
            <label>Discharge Date and Time:</label>
            <input type="datetime-local" name="datetime_of_discharge" required>
            <button type="submit">Discharge</button>
        </form>
    </main>

    <footer>
        <div class="container">
        <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
