<?php
include 'db.php';

$result = $conn->query("SELECT * FROM expenses ORDER BY id DESC");

// calculate total expenses
$totalExpenses = 0;
while ($row = $result->fetch_assoc()) {
    $totalExpenses += $row['amount'];
}

$result->data_seek(0);
?>

<?php
include 'db.php';

// gets all income categories from the database
$incomeResult = $conn->query("SELECT * FROM income ORDER BY id DESC");
$incomeCategories = []; 

while ($incomeRow = $incomeResult->fetch_assoc()) {
    $incomeCategories[] = $incomeRow;
}

$incomeResult->free(); 
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PennyTracker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <img src="logo-expenses.png" alt="PennyTracker Logo" class="img-fluid" style="max-width: 315px;">
        <div>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addExpenseModal"> <i class="fa-solid fa-dollar-sign"></i> &nbsp; New Expense</button>
            <button class="btn btn-light" onclick="location.href='http://localhost/PennyTracker/income-main.php';"> <i class="fa-solid fa-piggy-bank"></i> &nbsp;
             My Penny
            </button>
        </div>
    </div>

    <hr class="bg-light">

    <h1 class="text-center"> <i class="fa-solid fa-dollar-sign" style ="color: #FFC107"></i> Total <span style="color: #51D289;">Expenses</span></h1>
    <div class="bg-secondary text-white p-3 rounded text-center mb-4">
        <h2>₱<?php echo number_format($totalExpenses, 2); ?></h2>
    </div>

    <div class="list-group">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                <div>
                    <strong><?php echo $row['category']; ?></strong>
                    <p class="mb-0 text-warning">₱<?php echo number_format($row['amount'], 2); ?></p>
                </div>
                <div>
                    <!-- Edit button triggers modal -->
                    <button class="btn btn-sm btn-success edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editExpenseModal"
                        data-id="<?php echo $row['id']; ?>"
                        data-category="<?php echo $row['category']; ?>"
                        data-amount="<?php echo $row['amount']; ?>"> <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </button>

                    <a href="delete_expense.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');"><i class="fa-solid fa-trash"></i>&nbsp;Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- add expense -->
<div class="modal fade" id="addExpenseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="add_expense.php" method="POST">
                <h6 class="text-muted">Select Income Category</h6>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="income_category" required>
                            <option value="">-- Select Income Category --</option>
                            <?php foreach ($incomeCategories as $income) : ?>
                                <option value="<?php echo $income['id']; ?>">
                                    <?php echo $income['category']; ?> (₱<?php echo number_format($income['amount'], 2); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <h6 class="text-muted">Expense Name</h6>
                    <div class="mb-3">
                        <label class="form-label">Expense Name</label>
                        <input type="text" class="form-control" name="expense_category" required>
                    </div>
                    <h6 class="text-muted">Amount</h6>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Expense Modal -->
<div class="modal fade" id="editExpenseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="update_expense.php" method="POST">
                    <input type="hidden" name="id" id="editExpenseId">
                    
                    <h6 class="text-muted">Edit Expense Name</h6>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" id="editCategory" required>
                    </div>
                    <h6 class="text-muted">Edit Amount</h6>
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

<!--FontAwesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

document.addEventListener("DOMContentLoaded", function () {
    var editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            var expenseId = this.getAttribute("data-id");
            var expenseCategory = this.getAttribute("data-category");
            var expenseAmount = this.getAttribute("data-amount");

            document.getElementById("editExpenseId").value = expenseId;
            document.getElementById("editCategory").value = expenseCategory;
            document.getElementById("editAmount").value = expenseAmount;
        });
    });
});
</script>

</body>
</html>
