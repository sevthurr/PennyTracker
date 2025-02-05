<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $incomeId = $_POST['income_category'];
    $expenseCategory = trim($_POST['expense_category']);
    $expenseAmount = floatval($_POST['amount']);

    $stmt = $conn->prepare("SELECT amount FROM income WHERE id = ?");
    $stmt->bind_param("i", $incomeId);
    $stmt->execute();
    $stmt->bind_result($incomeAmount);
    $stmt->fetch();
    $stmt->close();

    // error handling in the income is less than the expense
    if ($incomeAmount < $expenseAmount) {
        echo "<script>alert('Error: Insufficient balance in the selected income category.'); window.location.href='expenses-main.php';</script>";
        exit();
    }

    // minus the amount of the category depending on the expense amount
    $newIncomeAmount = $incomeAmount - $expenseAmount;
    $stmt = $conn->prepare("UPDATE income SET amount = ? WHERE id = ?");
    $stmt->bind_param("di", $newIncomeAmount, $incomeId);
    $stmt->execute();
    $stmt->close();

    // adds the expense to the table
    $stmt = $conn->prepare("INSERT INTO expenses (category, amount) VALUES (?, ?)");
    $stmt->bind_param("sd", $expenseCategory, $expenseAmount);
    
    if ($stmt->execute()) {
        header("Location: expenses-main.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
