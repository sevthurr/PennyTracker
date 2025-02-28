<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Error: User session not found. Please log in again.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_SESSION['user_id']); 
    $incomeId = intval($_POST['income_category']); 
    $expenseCategory = trim($_POST['expense_category']);
    $expenseAmount = floatval($_POST['amount']); 

    if ($user_id === 0) {
        die("Error: Invalid User ID (0). Please log in again.");
    }

    $stmt = $conn->prepare("SELECT amount FROM income WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $incomeId, $user_id);
    $stmt->execute();
    $stmt->bind_result($incomeAmount);
    $stmt->fetch();
    $stmt->close();

    if ($incomeAmount < $expenseAmount) {
        echo "<script>alert('Error: Insufficient balance in the selected income category.'); window.location.href='expenses-main.php';</script>";
        exit();
    }

    $newIncomeAmount = $incomeAmount - $expenseAmount;
    $stmt = $conn->prepare("UPDATE income SET amount = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("dii", $newIncomeAmount, $incomeId, $user_id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO expenses (user_id, category, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("isd", $user_id, $expenseCategory, $expenseAmount);
    
    if ($stmt->execute()) {
        header("Location: expenses-main.php");
        exit();
    } else {
        die("Database error: " . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
?>
