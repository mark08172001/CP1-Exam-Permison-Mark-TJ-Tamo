<?php
include '../includes/config.php';
include '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$patient_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($patient_id > 0) {
    $sql = "SELECT * FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
} else {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];

    $sql = "UPDATE patients SET last_name = ?, first_name = ?, middle_name = ?, gender = ?, date_of_birth = ?, address = ? WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $last_name, $first_name, $middle_name, $gender, $date_of_birth, $address, $patient_id);

    if ($stmt->execute()) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Error updating patient.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Patient</title>
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
            <img src="../images/bg.png" alt="Hospital Logo" style="height:  60px; vertical-align: middle; margin-right: 20px;">
            <h1 style="display: inline-block; vertical-align: middle;">Update Patient</h1>
        </div>
    </header>

    <div class="sidebar">
        <nav>
            <a href="list.php" class="back-button">Back to Patients List</a>
        </nav>
    </div>

    <main>
        <form method="POST" action="">
            <?php if (isset($error)) echo "<p>$error</p>"; ?>
            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($patient['last_name']); ?>" required>
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($patient['first_name']); ?>" required>
            <label>Middle Name:</label>
            <input type="text" name="middle_name" value="<?php echo htmlspecialchars($patient['middle_name']); ?>">
            <label>Gender:</label>
            <select name="gender" required>
                <option value="Male" <?php echo ($patient['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($patient['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($patient['date_of_birth']); ?>" required>
            <label>Address:</label>
            <textarea name="address" required><?php echo htmlspecialchars($patient['address']); ?></textarea>
            <button type="submit">Update Patient</button>
        </form>
    </main>

    <footer>
        <div class="container">
        <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
