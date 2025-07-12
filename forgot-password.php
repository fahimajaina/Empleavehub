<?php
// Start session to store status messages
session_start();
// Include database configuration
require_once('include/config.php');

// Check if form is submitted
if(isset($_POST['send'])) {
  $email = trim($_POST['emailid']);
  
  // Validate email format
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
  } else {
    // Check if the email exists in the database
    $sql = "SELECT EmpId, FirstName, LastName, EmailId FROM tblemployees WHERE EmailId = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    
    if($query->rowCount() > 0) {
      // Email exists, get employee data
      $result = $query->fetch(PDO::FETCH_OBJ);
      $empId = $result->EmpId;
      $firstName = $result->FirstName;
      $lastName = $result->LastName;
      
      // Generate a unique reset token
      $token = bin2hex(random_bytes(32));
      $expiry = date('Y-m-d H:i:s', strtotime('+2 hours'));
      
      // Store the token in database (first check if a reset entry already exists)
      $checkSql = "SELECT * FROM tblreset_tokens WHERE emp_id = :empid";
      $checkQuery = $dbh->prepare($checkSql);
      $checkQuery->bindParam(':empid', $empId, PDO::PARAM_STR);
      $checkQuery->execute();
      
      if($checkQuery->rowCount() > 0) {
        // Update existing token
        $updateSql = "UPDATE tblreset_tokens SET token = :token, expires_at = :expiry WHERE emp_id = :empid";
        $updateQuery = $dbh->prepare($updateSql);
        $updateQuery->bindParam(':token', $token, PDO::PARAM_STR);
        $updateQuery->bindParam(':expiry', $expiry, PDO::PARAM_STR);
        $updateQuery->bindParam(':empid', $empId, PDO::PARAM_STR);
        $updateQuery->execute();
      } else {
        // Insert new token
        $insertSql = "INSERT INTO tblreset_tokens (emp_id, token, expires_at) VALUES (:empid, :token, :expiry)";
        $insertQuery = $dbh->prepare($insertSql);
        $insertQuery->bindParam(':empid', $empId, PDO::PARAM_STR);
        $insertQuery->bindParam(':token', $token, PDO::PARAM_STR);
        $insertQuery->bindParam(':expiry', $expiry, PDO::PARAM_STR);
        $insertQuery->execute();
      }
      
      // Generate reset URL
      $resetUrl = "http://" . $_SERVER['HTTP_HOST'] . "/EmpLeaveHub/password-reset.php?token=" . $token . "&email=" . urlencode($email);
      
      // Send email with the reset link
      require_once 'PHPMailer-master/src/PHPMailer.php';
      require_once 'PHPMailer-master/src/SMTP.php';
      require_once 'PHPMailer-master/src/Exception.php';
      
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->IsSMTP();
      $mail->Host = 'smtp.gmail.com'; // Use your SMTP server
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->Username = 'knotx765@gmail.com'; // Your email
      $mail->Password = 'scls kvdl qndn ddco'; // Your email password or app password
      $mail->SMTPSecure = 'tls';
      $mail->setFrom('knotx765@gmail.com', 'EmpLeaveHub');
      $mail->addAddress($email, $firstName . ' ' . $lastName);
      $mail->Subject = 'Password Reset for EmpLeaveHub';
      
      $emailBody = "
      <html>
      <head>
        <style>
          body { font-family: Arial, sans-serif; line-height: 1.6; }
          .container { max-width: 600px; margin: 0 auto; padding: 20px; }
          .header { background-color: #48A6A7; padding: 15px; color: white; text-align: center; border-radius: 5px 5px 0 0; }
          .content { padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px; }
          .button { display: inline-block; padding: 12px 20px; background-color: #48A6A7; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        </style>
      </head>
      <body>
        <div class='container'>
          <div class='header'>
            <h2>Password Reset Request</h2>
          </div>
          <div class='content'>
            <p>Hello $firstName $lastName,</p>
            <p>You recently requested to reset your password for your EmpLeaveHub account. Click the button below to reset it.</p>
            <p style='text-align: center;'>
              <a href='$resetUrl' class='button'>Reset Your Password</a>
            </p>
            <p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>
            <p>This link is valid for 2 hours.</p>
            <p>Best regards,<br>EmpLeaveHub Team</p>
          </div>
        </div>
      </body>
      </html>
      ";
      
      $mail->Body = $emailBody;
      $mail->IsHTML(true);
      
      if($mail->Send()) {
        $_SESSION['success'] = "Password reset instructions have been sent to your email.";
      } else {
        $_SESSION['error'] = "Email could not be sent. " . $mail->ErrorInfo;
      }
    } else {
      $_SESSION['error'] = "No account found with that email address.";
    }
  }
}
?>
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
    
    .alert {
      border-radius: 10px;
      margin-bottom: 20px;
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
    
    <form method="post">
      <div class="mb-4 input-group">
        <span class="input-group-text border-end-0">
          <span class="material-icons text-muted">email</span>
        </span>
        <input type="email" class="form-control border-start-0" name="emailid" placeholder="Enter your registered Email ID" required autocomplete="off">
      </div>
      <div class="d-grid">
        <button type="submit" name="send" class="btn btn-custom">Send Reset Link</button>
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
