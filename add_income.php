<?php
session_start(); 
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User session not found. Please log in again.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = intval($_SESSION['user_id']);
    $category = trim($_POST['category']);
    $amount = floatval($_POST['amount']); 
    if ($user_id === 0) {
        die("Error: Invalid User ID (0). Please log in again.");
    }

    if (!empty($category) && $amount > 0) {
        $stmt = $conn->prepare("INSERT INTO income (user_id, category, amount) VALUES (?, ?, ?)");
        $stmt->bind_param("isd", $user_id, $category, $amount); // ✅ Bind user_id correctly

        if ($stmt->execute()) {
            header("Location: income-main.php");
            exit();
        } else {
            die("Database error: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("Error: All fields are required and amount must be greater than zero.");
    }
}

$conn->close();
?>
