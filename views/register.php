<?php
// Start the session (if needed)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PennyTracker - Register</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">


    <style>
      /* Layout */
      .container-fluid {
        display: flex;
        height: 100vh;
      }

      /* Left Section */
      .hero-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #1e1e1e;
        width: 50%;
        text-align: center;
        padding: 20px;
      }

      .brand-title {
        font-size: 70px;
        font-weight: 700;
        font-family: "Poppins", sans-serif;
        color: #ffffff;
        line-height: 1.2;
      }

      .brand-name-primary { color: rgba(255, 253, 231, 1); }
      .brand-name-secondary { color: rgba(81, 210, 137, 1); }

      .content-section {
        font-size: 22px;
        font-weight: 600;
        font-family: "Poppins", sans-serif;
        color: #ffe600;
        margin-top: 10px;
      }

      .register-container {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #121212;
        padding: 40px;
      }

      .register-box {
        background: #1e1e1e;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
      }

      .form-control {
        background: #2a2a2a;
        border: none;
        color: white;
      }

      .form-control::placeholder {
        color: #bbb;
      }

      .btn-primary {
        margin-top: 10px; 
        width: 30px;
        background: #51d289;
        border: none;
      }

      .btn-primary:hover {
        background: #3cb978;
      }

      .login-link {
        text-align: center;
        margin-top: 15px;
      }

      .login-link a {
        color: #51d289;
        text-decoration: none;
      }

      .login-link a:hover {
        text-decoration: underline;
      }
    </style>
</head>
<body class="bg-dark text-white">

<div class="container-fluid">
  <div class="hero-container">
    <div class="brand-title">
      <span class="brand-name-primary">Penny</span>
      <span class="brand-name-secondary">Tracker</span>
    </div>
    <div class="content-section">Your go-to budget tracker</div>
  </div>

  <!--Register Form -->
  <div class="register-container">
    <div class="register-box">
      <h3 class="text-center mb-4">Create an Account</h3>
      <form action="register_process.php" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label"> <i class="fa-solid fa-user"></i> &nbsp;Full Name</label>
          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label"> <i class="fa-solid fa-envelope"></i> &nbsp;Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label"><i class="fa-solid fa-key"></i> &nbsp;Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label"><i class="fa-solid fa-key"></i> &nbsp;Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100"> <i class="fa-regular fa-address-card"></i> Register</button>
      </form>
      <div class="login-link">
        <p>Already have an account? <a href="index.php">Login here!</a></p>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

document.querySelector("form").addEventListener("submit", function(event) {
      let password = document.getElementById("password").value;
      let confirmPassword = document.getElementById("confirm_password").value;

      if (password !== confirmPassword) {
          alert("Passwords do not match!");
          event.preventDefault();
      }
  });
</script>
</body>
</html>
