<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if ID, category, and amount exist
    if (isset($_POST['id']) && isset($_POST['category']) && isset($_POST['amount'])) {
        $id = intval($_POST['id']); // Ensure it's an integer
        $category = trim($_POST['category']);
        $amount = floatval($_POST['amount']); // Ensure it's a valid number

        // Check if values are not empty
        if (!empty($category) && $amount > 0) {
            // Prepare and execute the update query
            $stmt = $conn->prepare("UPDATE expenses SET category = ?, amount = ? WHERE id = ?");
            $stmt->bind_param("sdi", $category, $amount, $id);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: expenses-main.php"); 
                exit();
            } else {
                echo "Error updating expense: " . $conn->error;
            }
        } else {
            echo "Invalid input: Category cannot be empty and amount must be greater than zero.";
        }
    } else {
        echo "Missing required data.";
    }
} else {
    echo "Invalid request.";
}
?>
