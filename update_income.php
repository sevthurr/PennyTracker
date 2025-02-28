<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];

    $stmt = $conn->prepare("UPDATE income SET category = ?, amount = ? WHERE id = ?");
    $stmt->bind_param("sdi", $category, $amount, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: income-main.php");
    exit();
}
?>
