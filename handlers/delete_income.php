<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM income WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: income-main.php"); 
        exit();
    } else {
        echo "Error deleting income: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
