<?php
include '../includes/config.php';
include '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$sql = "SELECT a.*, p.last_name, p.first_name FROM admissions a JOIN patients p ON a.patient_id = p.patient_id";
$result = $conn->query($sql);

// Fetch all patients
$patients_sql = "SELECT * FROM patients";
$patients_result = $conn->query($patients_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admissions</title>
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
            background-color: #ddd;
        }

        main {
            margin-left: 220px; 
            padding: 100px 20px 20px; 
            flex-grow: 1;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
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
            <h1 style="display: inline-block; vertical-align: middle;"> Admissions</h1>
        </div>
    </header>

    <div class="sidebar">
        <nav>
            <a href="../index.php" class="back-button">Back to Dashboard</a>
        </nav>
    </div>

    <main>
        <h2 class="admissionlist"></h2>
        <form method="GET" action="add.php">
            <label>Select Patient:</label>
            <select name="patient_id" required>
                <?php while($patient = $patients_result->fetch_assoc()): ?>
                <option value="<?php echo $patient['patient_id']; ?>">
                    <?php echo $patient['last_name'] . ', ' . $patient['first_name']; ?>
                </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Admit</button>
        </form>

        <h2 class="admissionlist">Admission List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Ward</th>
                    <th>Admission Date</th>
                    <th>Discharge Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['admission_id']; ?></td>
                    <td><?php echo $row['last_name'] . ', ' . $row['first_name']; ?></td>
                    <td><?php echo $row['ward']; ?></td>
                    <td><?php echo $row['datetime_of_admission']; ?></td>
                    <td><?php echo $row['datetime_of_discharge']; ?></td>
                    <td>
                        <a href="discharge.php?id=<?php echo $row['admission_id']; ?>" class="back-button">Discharge</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <div class="container">
        <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
