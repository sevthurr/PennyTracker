<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("User session not found! Please log in again.");
}

$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'User';
$user_id = $_SESSION['user_id']; 

$sql = "SELECT * FROM income WHERE user_id = ? ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$totalIncome = 0;
$incomeCategories = []; 

while ($row = $result->fetch_assoc()) {
    $totalIncome += $row['amount']; 
    $incomeCategories[] = $row;
}

$stmt->close();
$conn->close();
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


        .total-income-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .total-income-text {
            text-align: center;
            flex-grow: 1; 
        }

        .btn-container {
            position: absolute;
            right: 0;
            top: 20px;
            display: flex;
            gap: 10px;
        }

        .new-income-btn {
            margin-top: 30px; 
            margin-left: 1000px;
        }

        .text-logo {
            font-family: "Poppins", sans-serif;
            font-size: 50px;
            font-weight: 700;
            display: flex;
            align-items: center;
            
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

    <div class="d-flex justify-content-between align-items-center mb-4">
        
    </div>

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


<div class="total-income-container">
    <div class="btn-container">
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addIncomeModal">
            <i class="fa-solid fa-plus"></i> &nbsp;New Income
        </button>
        <button class="btn btn-light" onclick="location.href='expenses-main.php';">
            <i class="fa-solid fa-dollar-sign"></i> &nbsp;View Expenses
        </button>
    </div>

</div>



    <h1 class="text-center"> Total <span style="color: #51D289;">Income</span></h1>
    <div class="bg-secondary text-white p-3 rounded text-center mb-4">
        <h2>₱<?php echo number_format($totalIncome, 2); ?></h2>
    </div>

    <div class="list-group">
        <?php foreach ($incomeCategories as $income): ?>
            <div class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                <div>
                    <strong><?php echo htmlspecialchars($income['category']); ?></strong>
                    <p class="mb-0 text-warning">₱<?php echo number_format($income['amount'], 2); ?></p>
                </div>
                <div>
                    <!-- Edit button -->
                    <button class="btn btn-sm btn-success edit-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#editIncomeModal"
                        data-id="<?php echo $income['id']; ?>"
                        data-category="<?php echo htmlspecialchars($income['category']); ?>"
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

<!-- Add Income Modal -->
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

<!-- Edit Income Modal -->
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
    const addIncomeForm = document.querySelector("#addIncomeModal form");
    addIncomeForm.addEventListener("submit", function () {
        setTimeout(() => {
            location.reload();
        }, 500); 
    });
});


function confirmLogout() {
    return confirm("Are you sure you want to log out?");
}

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

function fetchIncome() {
    fetch("fetch_income.php")
        .then(response => response.json())
        .then(data => {
            let incomeList = document.querySelector(".list-group");
            incomeList.innerHTML = ""; 
            
            let totalIncome = 0;
            data.forEach(income => {
                totalIncome += parseFloat(income.amount);

                let listItem = `
                    <div class="list-group-item d-flex justify-content-between align-items-center bg-dark text-white">
                        <div>
                            <strong>${income.category}</strong>
                            <p class="mb-0 text-warning">₱${parseFloat(income.amount).toFixed(2)}</p>
                        </div>
                    </div>
                `;
                incomeList.innerHTML += listItem;
            });

            document.querySelector(".bg-secondary h2").innerText = `₱${totalIncome.toFixed(2)}`;
        });
}

document.addEventListener("DOMContentLoaded", function () {
    fetchIncome(); // Load latest income on page load

    const addIncomeForm = document.querySelector("#addIncomeModal form");
    addIncomeForm.addEventListener("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(addIncomeForm);

        fetch("add_income.php", { method: "POST", body: formData })
            .then(response => response.text())
            .then(() => {
                fetchIncome(); // Reload income after adding
                document.querySelector("#addIncomeModal .btn-close").click(); // Close modal
            });
    });
});

</script>

</body>
</html>
