<?php
include '../includes/config.php';
include '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients List</title>
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

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 5px;
           
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
            <h1 style="display: inline-block; vertical-align: middle;"> Patients List</h1>
        </div>
    </header>

    <div class="sidebar">
        <nav>
            <a href="../index.php" class="back-button">Back to Dashboard</a>
            <a href="add.php" class="back-button">Create Patient</a>
        </nav>
    </div>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['patient_id']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['middle_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <a href="edit.php? id=<?php echo $row['patient_id']; ?>" class="back-button" >Update</a>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?php echo $row['patient_id']; ?>)" class="back-button">Delete</a>
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

    <script>
        function confirmDelete(patientId) {
            if (confirm("Are you sure you want to delete this patient?")) {
                window.location.href = 'delete.php?id=' + patientId;
            }
        }
    </script>
</body>
</html>
