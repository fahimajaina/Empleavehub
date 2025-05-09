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
      background-color: #eef9fa; 
      color: #333;
      margin: 0;
    }

    .navbar {
      background-color: #71C9CE;
      height: 64px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1),
                  0 6px 15px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1050;
      padding: 0 20px;
      display: flex;
      align-items: center;
    }

    .navbar-brand {
      font-size: 22px;
      font-weight: 600;
      color: #fff;
      margin-left: 10px;
    }

    .hamburger {
      border: none;
      background: none;
      font-size: 28px;
      color: white;
      cursor: pointer;
    }
    #sidebar {
      position: fixed;
      top: 64px;
      left: 0;
      width: 240px;
      height: calc(100% - 64px);
      background-color: #fff;
      padding: 1rem;
      z-index: 999;
      transition: transform 0.3s ease;
      overflow-y: auto;
    }

    #sidebar.collapsed {
      transform: translateX(-240px);
    }

    .sidebar-header {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .sidebar-header img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid #71C9CE;
    }

    .sidebar-header p {
      font-weight: 600;
      color: #3D90D7;
      margin-top: 10px;
    }

    .list-group-item {
      display: flex;
      align-items: center;
      gap: 12px; /* space between icon and text */
      padding: 10px 15px;
      font-size: 15px;
      font-weight: 500;
      color: #333;
      border-radius: 8px;
      margin-bottom: 10px;
      transition: all 0.2s ease-in-out;
      border: none; 
    }

    .list-group-item span.material-icons {
      font-size: 20px;
    }

    .list-group-item:hover {
      background-color: #e6fafa;
      color: #000;
      text-decoration: none;
    }

    #sidebar .collapse .list-group-item {
      padding-left: 40px; 
      font-size: 14px;
    }

    #sidebar .collapse .list-group-item:hover {
      background-color: #f0fbfd;
      color: #344C64;
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
      border-color: rgb(144, 215, 246);
      box-shadow: 0 0 0 0.2rem rgba(72, 166, 167, 0.25);
    }

    .btn-custom {
      background-color:rgb(80, 173, 214);
      color: white;
      border-radius: 12px;
      font-weight: 500;
      padding: 10px;
      transition: 0.3s ease;
    }

    .btn-custom:hover {
      background-color: rgb(66, 155, 193);
    }

  

    
    .heading-colored {
      color:rgb(66, 155, 193);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">
    <button class="hamburger" id="menu-toggle"><span class="material-icons">menu</span></button>
    <a class="navbar-brand ms-2" href="#">EMPLAVEHUB</a>
  </div>
</nav>

<!-- Sidebar -->
<div id="sidebar">
  <div class="sidebar-header">
    <img src="../assets/images/profile-image.png" alt="Profile">
    <p>Admin</p>
  </div>

  <div class="list-group" id="sidebarMenu">
    <a href="dashboard.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <span class="material-icons">dashboard</span> Dashboard
    </a>

    <!-- Department -->
    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#deptMenu" role="button" aria-expanded="false" aria-controls="deptMenu">
      <span class="material-icons">apartment</span> Department
      <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="deptMenu">
      <a href="adddepartment.php" class="list-group-item list-group-item-action">Add Department</a>
      <a href="managedepartments.php" class="list-group-item list-group-item-action">Manage Department</a>
    </div>

    <!-- Leave Type -->
    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#leaveTypeMenu" role="button" aria-expanded="false" aria-controls="leaveTypeMenu">
      <span class="material-icons">event_note</span> Leave Type
      <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="leaveTypeMenu">
      <a href="addleavetype.php" class="list-group-item list-group-item-action">Add Leave Type</a>
      <a href="manageleavetype.php" class="list-group-item list-group-item-action">Manage Leave Type</a>
    </div>

    <!-- Employees -->
    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#employeeMenu" role="button" aria-expanded="false" aria-controls="employeeMenu">
      <span class="material-icons">people</span> Employees
      <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="employeeMenu">
      <a href="addemployee.php" class="list-group-item list-group-item-action">Add Employee</a>
      <a href="manageemployee.php" class="list-group-item list-group-item-action">Manage Employee</a>
    </div>

    <!-- Leave Management -->
    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#leaveMgmtMenu" role="button" aria-expanded="false" aria-controls="leaveMgmtMenu">
      <span class="material-icons">assignment</span> Leave Management
      <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="leaveMgmtMenu">
      <a href="leaves.php" class="list-group-item list-group-item-action">All Leaves</a>
      <a href="pending-leavehistory.php" class="list-group-item list-group-item-action">Pending Leaves</a>
      <a href="approvedleave-history.php" class="list-group-item list-group-item-action">Approved Leaves</a>
      <a href="notapproved-leaves.php" class="list-group-item list-group-item-action">Not Approved Leaves</a>
    </div>

    <!-- Other Links -->
    <a href="changepassword.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <span class="material-icons">lock</span> Change Password
    </a>
    <a href="logout.php" class="list-group-item list-group-item-action d-flex align-items-center">
      <span class="material-icons">logout</span> Sign Out
    </a>
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
