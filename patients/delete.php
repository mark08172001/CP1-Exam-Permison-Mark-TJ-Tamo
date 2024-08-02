<?php
include '../includes/config.php';
include '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit();
}

$patient_id = $_GET['id'];

$sql = "DELETE FROM patients WHERE patient_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);

if ($stmt->execute()) {
    header('Location: list.php');
    exit();
} else {
    echo "Failed to delete patient.";
}
?>
