<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Update Employee Profile</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts & Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f5fafa;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #48A6A7;
      height: 64px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar .navbar-brand {
      font-size: 22px;
      color: #fff;
      font-weight: 600;
    }

    .hamburger {
      border: none;
      background: none;
      font-size: 28px;
      color: white;
    }

    #sidebar {
      position: fixed;
      top: 64px;
      left: 0;
      width: 240px;
      height: calc(100% - 64px);
      background: #ffffff;
      border-right: 1px solid #e0e0e0;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    #sidebar.collapsed {
      transform: translateX(-100%);
    }

    .sidebar-content {
      overflow-y: auto;
      flex-grow: 1;
      padding-top: 10px;
    }

    #sidebar a,
    #sidebar button.sidebar-btn {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: #333;
      text-decoration: none;
      font-weight: 500;
      border: none;
      background: none;
      transition: background 0.3s ease;
    }

    #sidebar a:hover,
    #sidebar button.sidebar-btn:hover {
      background-color: #e6fafa;
      color: #000;
    }

    #sidebar .material-icons {
      margin-right: 10px;
      font-size: 20px;
    }

    .main-content {
      margin-left: 240px;
      padding: 80px 30px 30px;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
      margin-left: 0;
    }

    @media (max-width: 768px) {
      #sidebar {
        transform: translateX(-100%);
      }

      #sidebar.collapsed {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0 !important;
      }
    }

    .form-section {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .form-label {
      font-weight: 500;
      margin-bottom: 6px;
    }

    .form-control,
    .form-select {
      border-radius: 12px;
      border: 1px solid #d9d9d9;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #48A6A7;
      box-shadow: 0 0 0 0.2rem rgba(72, 166, 167, 0.25);
    }

    .btn-custom {
      background-color: #48A6A7;
      color: white;
      border-radius: 12px;
      font-weight: 500;
      padding: 10px;
      transition: 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #3c8e8f;
    }

  

    /* ✅ Custom Heading Color */
    .heading-colored {
      color: #2c7a7b;
    }
  </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <button class="hamburger" id="menu-toggle"><span class="material-icons">menu</span></button>
    <a class="navbar-brand ms-2" href="#">EMPLEAVEHUB</a>
  </div>
</nav>

<!-- Sidebar -->
<div id="sidebar">
  <div class="sidebar-content">
    <div class="text-center py-4">
      <img src="assets/images/profile-image.png" class="rounded-circle mb-2" width="80" alt="Profile Image">
      <h6 class="mb-0 fw-semibold">John Doe</h6>
      <small class="text-muted">EMP12345</small>
    </div>
    <hr class="mx-3">

    <a href="dashboard.php"><span class="material-icons">dashboard</span> Dashboard</a>
    <a href="myprofile.php"><span class="material-icons">account_circle</span> My Profile</a>
    <a href="emp-changepassword.php"><span class="material-icons">lock</span> Change Password</a>

    <button class="sidebar-btn" type="button" data-bs-toggle="collapse" data-bs-target="#leaveMenu">
      <span class="material-icons">event_note</span> Leaves
      <span class="material-icons float-end">expand_more</span>
    </button>
    <div class="collapse ps-4" id="leaveMenu">
      <a href="apply-leave.php" class="d-block py-2">Apply Leave</a>
      <a href="leavehistory.php" class="d-block py-2">Leave History</a>
    </div>

    <a href="logout.php"><span class="material-icons">logout</span> Sign Out</a>
  </div>
</div>

<!-- Main Content -->
<div class="main-content" id="main-content">
  <h4 class="mb-4 heading-colored"><span class="material-icons me-2">edit</span> Update Employee Info</h4>

  <form class="form-section">
    <div class="row g-4">
      <div class="col-md-6">
        <label for="empcode" class="form-label">Employee Code</label>
        <input type="text" class="form-control" name="empcode" id="empcode" value="EMP12345" autocomplete="off" readonly required>
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="employee@example.com" readonly autocomplete="off" required>
      </div>
      <div class="col-md-6">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName" name="firstName" value="John" required>
      </div>
      <div class="col-md-6">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="Doe" autocomplete="off" required>
      </div>
      <div class="col-md-6">
        <label for="phone" class="form-label">Mobile Number</label>
        <input type="tel" class="form-control" id="phone" name="mobileno" value="01700000000" maxlength="11" autocomplete="off" required>
      </div>
      <div class="col-md-6">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" id="gender" name="gender" required>
          <option selected>Male</option>
          <option>Female</option>
          <option>Other</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="birthdate" name="dob" value="1990-01-01" required>
      </div>
      <div class="col-md-6">
        <label for="department" class="form-label">Department</label>
        <select class="form-select" id="department" name="department" required>
          <option selected>IT</option>
          <option>HR</option>
          <option>Finance</option>
          <option>Marketing</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="123, Main Street" autocomplete="off" required>
      </div>
      <div class="col-md-6">
        <label for="city" class="form-label">City/Town</label>
        <input type="text" class="form-control" id="city" name="city" value="Dhaka" autocomplete="off" required>
      </div>
      <div class="col-md-6">
        <label for="country" class="form-label">Country</label>
        <input type="text" class="form-control" id="country" name="country" value="Bangladesh" autocomplete="off" required>
      </div>
      <div class="col-12 mt-3">
        <button type="submit" name="update"  id="update" class="btn btn-custom w-100">Update</button>
      </div>
    </div>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('menu-toggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('main-content').classList.toggle('collapsed');
  });
</script>
</body>
</html>
