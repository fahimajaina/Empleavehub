<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EMPLEAVEHUB | Password Recovery</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts & Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e6fafa, #ffffff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }

    .card {
      width: 100%;
      max-width: 450px;
      padding: 40px 30px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.95);
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
      border: none;
    }

    .card h5 {
      text-align: center;
      font-weight: 600;
      color: #48A6A7;
      margin-bottom: 30px;
      font-size: 24px;
    }

    .input-group-text {
      background: transparent;
      border-right: none;
    }

    .form-control {
      border-left: none;
      border-color: #ced4da;
      border-radius: 10px;
    }

    .form-control:focus {
      border-color: #48A6A7;
      box-shadow: 0 0 0 0.15rem rgba(72, 166, 167, 0.25);
    }

    .btn-custom {
      background-color: #48A6A7;
      color: white;
      padding: 12px;
      font-weight: 500;
      border-radius: 10px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-custom:hover {
      background-color: #3a8d8d;
      transform: translateY(-1px);
    }

    .nav-links {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 30px;
      font-size: 14px;
    }

    .nav-links a {
      display: inline-flex;
      align-items: center;
      color: #555;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .nav-links a:hover {
      color: #48A6A7;
    }

    .nav-links span {
      color: #aaa;
    }

    .material-icons {
      font-size: 18px;
      margin-right: 6px;
      vertical-align: middle;
    }

    @media (max-width: 480px) {
      .card {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="card">
    <h5><span class="material-icons">lock_reset</span> Password Recovery</h5>
    <form method="post" action="password-reset.php" name="forgot">
      <div class="mb-3 input-group">
        <span class="input-group-text border-end-0">
          <span class="material-icons text-muted">badge</span>
        </span>
        <input type="text" class="form-control border-start-0" name="empid" placeholder="Employee ID" required autocomplete="off">
      </div>
      <div class="mb-4 input-group">
        <span class="input-group-text border-end-0">
          <span class="material-icons text-muted">email</span>
        </span>
        <input type="email" class="form-control border-start-0" name="emailid" placeholder="Email ID" required autocomplete="off">
      </div>
      <div class="d-grid">
        <button type="submit" name="send" class="btn btn-custom">Reset Password</button>
      </div>
    </form>

    <!-- Navigation Links -->
    <div class="nav-links">
      <a href="index.php"><span class="material-icons">account_box</span>Employee Login</a>
      <span>|</span>
      <a href="admin/"><span class="material-icons">admin_panel_settings</span>Admin Login</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
