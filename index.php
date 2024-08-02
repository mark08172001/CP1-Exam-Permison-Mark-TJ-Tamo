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
            background: transparent;
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
            height: 500px; /* Adjusted the height to make the images smaller */
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <img src="bg.png" alt="Hospital Logo" style="height: 60px; vertical-align: middle; margin-right: 20px;">
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
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/01/BGHMC-Website-Banner-2.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Sight-Saving-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/National-Lung-Month-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Adolescent-Immunization-Month-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/National-Breastfeeding-Awareness-Month-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Family-Planning-Month-Web-Banner.png"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Linggo-ng-Kabataan-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/National-TB-Day-Website-Banner.jpg"/>
            </div>
            <div class="gallery-slide">
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/01/BGHMC-Website-Banner-2.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Sight-Saving-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/National-Lung-Month-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Adolescent-Immunization-Month-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/National-Breastfeeding-Awareness-Month-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Family-Planning-Month-Web-Banner.png"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/Linggo-ng-Kabataan-Website-Banner.jpg"/>
                <img src="https://bghmc.doh.gov.ph/wp-content/uploads/2024/08/National-TB-Day-Website-Banner.jpg"/>
            </div>
        </div>
        <h2>Patient List</h2>
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
    </main>

    <footer>
        <div class="footer">
            <p>&copy; 2024 Baguio General Hospital and Medical Center. All rights reserved.</p>
        </div>
    </footer>

    <script>
        let currentIndex = 0;
        const images = document.querySelectorAll('.carousel img');

        function showNextImage() {
            images[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].classList.add('active');
        }

        setInterval(showNextImage, 3000);
    </script>
</body>
</html>
