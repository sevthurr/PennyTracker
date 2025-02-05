<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['category']) && !empty($_POST['amount'])) {
        $category = trim($_POST['category']);
        $amount = floatval($_POST['amount']);

        $stmt = $conn->prepare("INSERT INTO income (category, amount) VALUES (?, ?)");
        $stmt->bind_param("sd", $category, $amount);

        if ($stmt->execute()) {
            header("Location: income-main.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>