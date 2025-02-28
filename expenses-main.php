<?php
session_start();
include 'db.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'User';
$user_id = $_SESSION['user_id'];

// Fetch expenses for the logged-in user
$sql = "SELECT * FROM expenses WHERE user_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$totalExpenses = 0;
$expenses = [];

while ($row = $result->fetch_assoc()) {
    $totalExpenses += $row['amount'];
    $expenses[] = $row;
}

$stmt->close();

// Fetch income categories for the logged-in user
$sql = "SELECT * FROM income WHERE user_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$incomeResult = $stmt->get_result();

$incomeCategories = [];

while ($incomeRow = $incomeResult->fetch_assoc()) {
    $incomeCategories[] = $incomeRow;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PennyTracker - Expenses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .text-logo {
            font-family: "Poppins", sans-serif;
            font-size: 50px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-name { color: #ffffff; }
        .brand-highlight { color: #51D289; }

        .profile-container {
            display: flex;
            font-size: 18px;
            align-items: center;
            gap: 10px;
        }

        .profile-container i {
            font-size: 60px;
            color: #51D289;
        }

        .logout-link {
            font-size: 15px;
            color: #FFC107;
            text-decoration: none;
        }

        .logout-link:hover { text-decoration: underline; }

        .total-expenses-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            position: relative;
        }

        .btn-container {
            position: absolute;
            right: 0;
            top: 20px;
            display: flex;
            gap: 10px;
        }
        .brand-name {
            font-family: "Poppins", sans-serif;
            font-size: 50px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
        }
        .brand-highlight {
            color: #51D289; 
        }
        
    </style>

</head>
<body class="bg-dark text-white">

<div class="container mt-5">
<div class="header-container">
    <span class="brand-name">
    <i class="fa-solid fa-piggy-bank" style="color: #FFC107"> &nbsp;</i> 
    <span style="color: white;"> Penny</span><span class="brand-highlight">Tracker</span>
    </span>

    <div class="profile-container">
        <i class="fa-solid fa-user-circle"></i>
        <div>
            <strong><?php echo htmlspecialchars($fullname); ?></strong><br>
            <a href="logout.php" class="logout-link" onclick="return confirmLogout();"> Log Out </a>
        </div>
    </div>
</div>

    <hr class="bg-light">

    <div class="total-expenses-container">
        <div class="btn-container">
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                <i class="fa-solid fa-plus"></i> &nbsp;New Expense
            </button>
            <button class="btn btn-light" onclick="location.href='income-main.php';">
                <i class="fa-solid fa-piggy-bank"></i> &nbsp;My Penny
            </button>
        </div>
    </div>

    <h1 class="text-center">Total <span style="color: #51D289;">Expenses</span></h1>
    <div class="bg-secondary text-white p-3 rounded text-center mb-4">
        <h2>₱<?php echo number_format($totalExpenses, 2); ?></h2>
    </div>

<!-- add expense modal-->
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

<!-- edit expense modal -->
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

    <div class="list-group">
        <?php foreach ($expenses as $expense): ?>
            <div class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                <div>
                    <strong><?php echo htmlspecialchars($expense['category']); ?></strong>
                    <p class="mb-0 text-warning">₱<?php echo number_format($expense['amount'], 2); ?></p>
                </div>
                <div>
                    <button class="btn btn-sm btn-success edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editExpenseModal"
                        data-id="<?php echo $expense['id']; ?>"
                        data-category="<?php echo htmlspecialchars($expense['category']); ?>"
                        data-amount="<?php echo $expense['amount']; ?>">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <a href="delete_expense.php?id=<?php echo $expense['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">
                        <i class="fa-solid fa-trash"></i>&nbsp;Delete
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>

function confirmLogout() {
    return confirm("Are you sure you want to log out?");
}

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