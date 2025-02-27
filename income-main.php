<?php
include 'db.php';

// Fetch all income records from the database
$result = $conn->query("SELECT * FROM income ORDER BY id DESC");

$totalIncome = 0;
$incomeCategories = []; // Initialize array for dropdown

while ($row = $result->fetch_assoc()) {
    $totalIncome += $row['amount']; // Calculate total income
    $incomeCategories[] = $row; // Store income categories for dropdown
}

$result->free(); // Free the result set to prevent conflicts
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PennyTracker - Income</title>
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <img src="logo-income.png" alt="PennyTracker Logo" class="img-fluid" style="max-width: 600px;">
        <div>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addIncomeModal"> <i class="fa-solid fa-plus"></i> &nbsp;New Income</button>
            <button class="btn btn-light" onclick="location.href='http://localhost/PennyTracker/expenses-main.php';"> <i class="fa-solid fa-dollar-sign"></i> &nbsp;
             View Expenses
            </button>
        </div>
    </div>

    <hr class="bg-light">

    <h1 class="text-center"> <i class="fa-solid fa-piggy-bank" style ="color: #FFC107"></i> Total <span style="color: #51D289;">Income</span></h1>
    <div class="bg-secondary text-white p-3 rounded text-center mb-4">
        <h2>₱<?php echo number_format($totalIncome, 2); ?></h2>
    </div>

    <div class="list-group">
        <?php foreach ($incomeCategories as $income): ?>
            <div class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                <div>
                    <strong><?php echo $income['category']; ?></strong>
                    <p class="mb-0 text-warning">₱<?php echo number_format($income['amount'], 2); ?></p>
                </div>
                <div>
                    <!-- Edit button -->
                    <button class="btn btn-sm btn-success edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editIncomeModal"
                        data-id="<?php echo $income['id']; ?>"
                        data-category="<?php echo $income['category']; ?>"
                        data-amount="<?php echo $income['amount']; ?>"> <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </button>

                    <!-- Delete button -->
                    <a href="delete_income.php?id=<?php echo $income['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this income?');"><i class="fa-solid fa-trash"></i>&nbsp;Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- add income -->
<div class="modal fade" id="addIncomeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Income</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="add_income.php" method="POST">
                    <h6 class="text-muted">Source of income</h6>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <h6 class="text-muted">Amount</h6>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Income</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- edit income -->
<div class="modal fade" id="editIncomeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Income</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="update_income.php" method="POST">
                    <input type="hidden" name="id" id="editIncomeId">
                    <h6 class="text-muted">Edit income category</h6>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" id="editCategory" required>
                    </div>
                    <h6 class="text-muted">Edit amount</h6>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="editAmount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var incomeId = this.getAttribute("data-id");
            var incomeCategory = this.getAttribute("data-category");
            var incomeAmount = this.getAttribute("data-amount");

            document.getElementById("editIncomeId").value = incomeId;
            document.getElementById("editCategory").value = incomeCategory;
            document.getElementById("editAmount").value = incomeAmount;
        });
    });
});
</script>

</body>
</html>