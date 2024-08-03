<?php
include 'includes/config.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Baguio General Hospital and Medical Center</title>
    <link rel="icon" type="logo.png" href="images/logo.png">
    <link rel="stylesheet" href="css/styles.css">
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
            background-image: url('images/b.jpg');
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
            position: relative;
            z-index: 1;
        }

        .sidebar nav a:hover {
            background-color: #fff;
        }

        main {
            margin-left: 250px; 
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

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: #fff; /* Make background white */
        }

        @keyframes slide {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }

        .gallery {
            overflow: hidden;
            padding: 10px 0;
            background: transparent;
            white-space: nowrap;
            position: relative;
            margin-top: 10px;
        }

        .gallery:before, .gallery:after {
            position: absolute;
            top: 0;
            width: 90px;
            height: 100%;
            content: "";
            z-index: 2;
        }

        .gallery:hover .gallery-slide {
            animation-play-state: paused;
        }

        .gallery-slide {
            display: inline-block;
            animation: slide 100s infinite linear;
        }

        .gallery-slide img {
            height: 500px;
            margin: 0 10px;
        }

        /*Table*/
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #053b00;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .table-container {
            overflow-x: auto;
        }

        .table-container table {
            min-width: 600px;
        }

        /*Search Bar */
        .search-bar {
            width: 90%;
            margin: 20px auto;
            display: flex;
            justify-content: flex-end;
        }

        .search-bar input {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        
    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="images/bg.png" alt="Hospital Logo" style="height: 60px; vertical-align: middle; margin-right: 20px;">
            <h1 style="display: inline; vertical-align: middle;">Baguio General Hospital and Medical Center</h1>
        </div>
    </header>

    <div class="sidebar">
        <nav>
            <a href="patients/list.php" class="back-button">Patient List</a>
            <a href="admissions/list.php" class="back-button">Admissions</a>
            <a href="logout.php" class="back-button">Logout</a>
        </nav>
    </div>

    <main>
        <div class="gallery">
            <div class="gallery-slide">
                <img src="images/image1.jpg"/>
                <img src="images/image2.jpg"/>
                <img src="images/image3.png"/>
                <img src="images/image4.jpg"/>
                <img src="images/image5.jpg"/>
                <img src="images/image6.jpg"/>
                <img src="images/image7.jpg"/>
                <img src="images/image8.jpg"/>
            </div>
            <div class="gallery-slide">
                <img src="images/image1.jpg"/>
                <img src="images/image2.jpg"/>
                <img src="images/image3.png"/>
                <img src="images/image4.jpg"/>
                <img src="images/image5.jpg"/>
                <img src="images/image6.jpg"/>
                <img src="images/image7.jpg"/>
                <img src="images/image8.jpg"/>
            </div>
        </div>
        <h2>Patient List</h2>
        <div class="search-bar">
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search Patient">
        </div>
        <div class="table-container">
            <table id="patientTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
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
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <div class="footer">
            <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("patientTable");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }
    </script>
</body>
</html>
