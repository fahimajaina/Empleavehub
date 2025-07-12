<?php
// Start session to store status messages
session_start();
// Include database configuration
require_once('include/config.php');

// Get token from URL
$token = isset($_GET['token']) ? $_GET['token'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$validToken = false;
$empId = '';

// Check if token exists and is valid
if(!empty($token)) {
    $sql = "SELECT r.*, e.EmailId FROM tblreset_tokens r 
            INNER JOIN tblemployees e ON e.EmpId = r.emp_id
            WHERE r.token = :token AND r.expires_at > NOW()";
    $query = $dbh->prepare($sql);
    $query->bindParam(':token', $token, PDO::PARAM_STR);
    $query->execute();
    
    if($query->rowCount() > 0) {
        $result = $query->fetch(PDO::FETCH_OBJ);
        $validToken = true;
        $empId = $result->emp_id;
        // If email not in URL, get from database
        if(empty($email)) {
            $email = $result->EmailId;
        }
    }
}

// Handle password reset form submission
if(isset($_POST['change'])) {
    $password = $_POST['newpassword'];
    $confirmPassword = $_POST['confirmpassword'];
    $token = $_POST['token'];
    
    // Validate password
    if(strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
    } elseif(!preg_match('/[A-Z]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one uppercase letter.";
    } elseif(!preg_match('/[a-z]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one lowercase letter.";
    } elseif(!preg_match('/[0-9]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one number.";
    } elseif($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
    } else {
        // Validate token again
        $sql = "SELECT * FROM tblreset_tokens WHERE token = :token AND expires_at > NOW()";
        $query = $dbh->prepare($sql);
        $query->bindParam(':token', $token, PDO::PARAM_STR);
        $query->execute();
        
        if($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            $empId = $result->emp_id;
            
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Update the password in the database
            $sql = "UPDATE tblemployees SET Password = :password WHERE EmpId = :empid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $query->bindParam(':empid', $empId, PDO::PARAM_STR);
            $query->execute();
            
            if($query->rowCount() > 0) {
                // Delete the token after successful password reset
                $deleteSql = "DELETE FROM tblreset_tokens WHERE token = :token";
                $deleteQuery = $dbh->prepare($deleteSql);
                $deleteQuery->bindParam(':token', $token, PDO::PARAM_STR);
                $deleteQuery->execute();
                
                $_SESSION['success'] = "Password has been reset successfully. You can now login with your new password.";
                // Redirect to login page after 3 seconds
                header("Refresh: 3; URL=index.php");
            } else {
                $_SESSION['error'] = "Something went wrong. Please try again.";
            }
        } else {
            $_SESSION['error'] = "Invalid or expired token. Please request a new reset link.";
        }
    }
}
?>

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

    .text-heading {
      color: #48A6A7;
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
      font-size: 24px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
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

    .email-display {
      background-color: #f0f8f8;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      color: #666;
      font-size: 0.9rem;
    }
    
    .email-display strong {
      color: #48A6A7;
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
      background-color: #48A6A7;
      border: none;
      border-radius: 10px;
      font-weight: 500;
      color: #fff;
      padding: 12px 0;
      width: 100%;
      transition: background-color 0.3s ease, transform 0.2s ease;
      font-size: 16px;
    }

    .custom-btn:hover {
      background-color: #3a8d8d;
      transform: translateY(-1px);
    }

       .back-link {
      margin-top: 20px;
      display: inline-flex;
      align-items: center;
      color: #555;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .back-link:hover {
      color: #48A6A7;
    }
    
    .alert {
      border-radius: 10px;
      margin-bottom: 20px;
    }
    
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 15px;
        color: #888;
        cursor: pointer;
    }
    
    .invalid-token {
        text-align: center;
        padding: 20px;
    }
      .invalid-token .material-icons {
        font-size: 60px;
        color: #dc3545;
        margin-bottom: 20px;
    }
    
    .password-requirements {
        font-size: 12px;
        color: #666;
        padding-left: 10px;
    }
    
    .password-requirements small {
        margin-bottom: 2px;
    }
    
    .text-success {
        color: #28a745 !important;
    }
    
    .text-danger {
        color: #dc3545 !important;
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

  <div class="card">
    <?php if(isset($_SESSION['success'])): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if(isset($_SESSION['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['error']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if(!$validToken): ?>
      <div class="invalid-token">
        <div class="material-icons">error_outline</div>
        <h4>Invalid or Expired Link</h4>
        <p>The password reset link is invalid or has expired. Please request a new password reset link.</p>
        <a href="forgot-password.php" class="btn custom-btn mt-3">Request New Link</a>
      </div>
    <?php else: ?>
      <h3 class="text-heading"><span class="material-icons">lock_reset</span> Reset Password</h3>
      
      <div class="email-display">
        <span class="material-icons">email</span> 
        <strong>Email:</strong> <?php echo htmlspecialchars($email); ?>
      </div>

      <form method="post" onsubmit="return validatePassword()">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
          <div class="form-group position-relative">
          <input type="password" class="form-control" id="newpassword" name="newpassword" 
                 placeholder=" " required 
                 pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                 title="Must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number">
          <label for="newpassword">New Password</label>
          <span class="material-icons password-toggle" onclick="togglePassword('newpassword')">visibility_off</span>
          <small class="form-text text-danger mt-2">
            Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.
          </small>
        </div>

        <div class="form-group position-relative">
          <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder=" " required>
          <label for="confirmpassword">Confirm Password</label>
          <span class="material-icons password-toggle" onclick="togglePassword('confirmpassword')">visibility_off</span>
        </div>

        <div class="form-group mt-4">
          <button type="submit" name="change" class="custom-btn">
            Change Password
          </button>
        </div>
      </form>

      <div class="d-flex justify-content-center mt-3">
        <a href="index.php" class="back-link">
          <span class="material-icons">arrow_back</span> Back to Login
        </a>
      </div>
    <?php endif; ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  <script>
    function validatePassword() {
      const newPassword = document.getElementById('newpassword').value;
      const confirmPassword = document.getElementById('confirmpassword').value;
      
      // Check if passwords are empty
      if (!newPassword || !confirmPassword) {
        alert("All password fields are required");
        return false;
      }
      
      // Check password requirements
      if (newPassword.length < 8) {
        alert("Password must be at least 8 characters long");
        return false;
      }
      
      // Check for uppercase letter
      if (!/[A-Z]/.test(newPassword)) {
        alert("Password must contain at least one uppercase letter");
        return false;
      }
      
      // Check for lowercase letter
      if (!/[a-z]/.test(newPassword)) {
        alert("Password must contain at least one lowercase letter");
        return false;
      }
      
      // Check for number
      if (!/[0-9]/.test(newPassword)) {
        alert("Password must contain at least one number");
        return false;
      }

      // Check if passwords match
      if (newPassword !== confirmPassword) {
        alert("New Password and Confirm Password do not match");
        return false;
      }
      return true;
    }
    
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const icon = input.nextElementSibling.nextElementSibling;
      
      if (input.type === "password") {
        input.type = "text";
        icon.textContent = "visibility";
      } else {
        input.type = "password";
        icon.textContent = "visibility_off";
      }
    }
  </script>
</body>
</html>
