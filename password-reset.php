<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Password Reset | EmpleaveHub</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts & Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f7f7, #ffffff);
      margin: 0;
      padding-top: 60px;
    }

    .main-content {
      padding: 80px 20px;
    }

    .card {
      border: none;
      border-radius: 15px;
      padding: 40px 30px;
      background: #ffffff;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .text-heading {
      color: #48A6A7;
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
      font-size: 24px;
    }

    .form-group {
      position: relative;
    }

    .form-group input.form-control {
      border: 1px solid #ccc;
      border-radius: 10px;
      height: 50px;
      padding: 1.25rem 1rem 0.5rem 1rem;
      background: #f9f9f9;
      transition: all 0.3s ease;
    }

    .form-group input:focus {
      border-color: #48A6A7;
      box-shadow: 0 0 0 0.2rem rgba(72, 166, 167, 0.25);
      background: #fff;
    }

    .form-group label {
      position: absolute;
      top: 12px;
      left: 16px;
      color: #888;
      font-size: 14px;
      transition: all 0.2s ease;
      pointer-events: none;
      background-color: transparent;
    }

    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: 6px;
      font-size: 11px;
      color: #48A6A7;
    }

    .custom-btn {
      background-color: #3b8d8e;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      color: #fff;
      padding: 12px 0;
      width: 100%;
      transition: background-color 0.3s ease;
      font-size: 16px;
    }

    .custom-btn:hover {
      background-color: #327979;
    }

   

    .back-link {
      margin-top: 20px;
      display: inline-flex;
      align-items: center;
    }

    .back-link a {
      text-decoration: none;
      color: #48A6A7;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      font-size: 15px;
    }

    .back-link .material-icons {
      margin-right: 5px;
      font-size: 20px;
    }

    @media (max-width: 576px) {
      .card {
        padding: 30px 20px;
      }

      .text-heading {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>

<!-- Main Content -->
<div class="main-content">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <h3 class="text-heading">Change Password</h3>

         

          <form>
            <div class="form-group mb-4 position-relative">
              <input type="password" class="form-control" id="newpassword" placeholder=" " required>
              <label for="newpassword">New Password</label>
            </div>

            <div class="form-group mb-4 position-relative">
              <input type="password" class="form-control" id="confirmpassword" placeholder=" " required>
              <label for="confirmpassword">Confirm New Password</label>
            </div>

            <div class="form-group mb-3">
              <button type="submit" name="change" class="custom-btn" onclick="return valid();">
                Change Password
              </button>
            </div>
          </form>

        
          <div class="d-flex justify-content-center mt-3">
            <div class="back-link">
              <a href="forgot-password.php">
                <span class="material-icons">arrow_back</span> Back
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function valid() {
    const newPassword = document.getElementById('newpassword').value;
    const confirmPassword = document.getElementById('confirmpassword').value;

    if (newPassword !== confirmPassword) {
      alert("New Password and Confirm Password do not match.");
      return false;
    }
    return true;
  }
</script>
</body>
</html>
