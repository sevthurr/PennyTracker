<?php
// Start the session (if needed)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PennyTracker</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
      /* Hero Section */
      .hero-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #1e1e1e;
        height: 100vh;
        text-align: center;
        padding: 20px;
      }

      /* PennyTracker Title */
      .brand-title {
        font-size: 80px;
        font-weight: 700;
        font-family: "Poppins", sans-serif;
        color: #ffffff;
        line-height: 1.2;
      }

      .brand-name-primary {
        color: rgba(255, 253, 231, 1);
      }

      .brand-name-secondary {
        color: rgba(81, 210, 137, 1);
      }

      /* Tagline */
      .content-section {
        font-size: 21px;
        font-weight: 600;
        font-family: "Poppins", sans-serif;
        margin-top: 20px; 
        color: #ffe600;
        margin-bottom: 30px;
      }

      /* Buttons */
      .button-group {
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
        width: 100%;
      }

      .primary-button, .secondary-button {
        border-radius: 4px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.04);
        text-align: center;
        padding: 15px 40px;
        font-size: 18px;
        font-weight: bold;
        width: 100%;
        max-width: 300px;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
      }

      .primary-button {
        background: #51d289;
        color: #000;
      }

      .primary-button:hover {
        background: #3cb978;
      }

      .secondary-button {
        background: #fc0;
        color: #000;
      }

      .secondary-button:hover {
        background: #e6b800;
      }

      @media (max-width: 991px) {
        .brand-title {
          font-size: 60px;
        }

        .button-group {
          width: 80%;
        }

        .primary-button, .secondary-button {
          width: 100%;
        }
      }
    </style>

    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="hero-container">
  <div class="brand-title">
    <span class="brand-name-primary">Penny</span>
    <span class="brand-name-secondary">Tracker</span>
  </div>
  <div class="content-section">Your go-to budget tracker</div>

  <div class="button-group">
    <a href="income-main.php" class="btn primary-button">Track Your Penny</a>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
