<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin | Manage Departments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
   body {
      font-family: 'Poppins', sans-serif;
      background-color: #eef9fa; /* Updated background */
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
      border: none; /* Remove border */
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
      padding-left: 40px; /* indent submenu items */
      font-size: 14px;
    }

    #sidebar .collapse .list-group-item:hover {
      background-color: #f0fbfd;
      color: #344C64;
    }

    .main-content {
      margin-left: 260px;
      padding: 100px 30px 30px 30px;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
      margin-left: 0;
    }

    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
    }

    .card h4 {
      color: #344C64;
    }

    .search-input {
      border-radius: 50rem;
    }

    .table thead th {
      background-color: #e9f8fa;
      color: #344C64;
      font-weight: 600;
      border: none;
    }

    .table tbody tr:hover {
      background-color: #f0fbfd;
    }

    .table td, .table th {
      vertical-align: middle;
    }

    .btn-action {
      border-radius: 20px;
      padding: 6px 12px;
      font-size: 14px;
      font-weight: 500;
    }

    .btn-view {
      background-color: transparent;
      border: 1px solid #7AC6D2;
      color: #7AC6D2;
    }

    .btn-view:hover {
      background-color: #7AC6D2;
      color: white;
    }

    @media (max-width: 768px) {
      #sidebar {
        transform: translateX(-100%);
      }

      #sidebar.collapsed {
        transform: translateX(0);
      }

      .main-content {
        margin-left: 0;
        padding-top: 100px;
      }
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
<div class="main-content" id="mainContent">
  <h2 class="fw-bold mb-4" style="color: #344C64;">
    <i class="material-icons me-2" style="color: #7AC6D2;">apartment</i> Manage Departments
  </h2>

  <div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="mb-0">Departments Info</h4>
      <input type="text" class="form-control w-25 search-input" placeholder="Search...">
    </div>

    <div class="table-responsive">
      <table class="table align-middle text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Dept Name</th>
            <th>Short Name</th>
            <th>Code</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Human Resource</td>
            <td>HR</td>
            <td>HR01</td>
            <td>2023-09-01 20:50</td>
            <td>
            <a href="editdepartment.php?id=1" class="btn btn-view btn-action me-1">Edit</a>
            <a href="manageleavetype.php?id=1" class="btn btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Information Technology</td>
            <td>IT</td>
            <td>IT01</td>
            <td>2023-09-01 20:50</td>
            <td>
            <a href="editdepartment.php?id=1" class="btn btn-view btn-action me-1">Edit</a>
            <a href="manageleavetype.php?id=1" class="btn btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Accounts</td>
            <td>Accounts</td>
            <td>ACCNT01</td>
            <td>2023-09-01 20:50</td>
            <td>
            <a href="editdepartment.php?id=1" class="btn btn-view btn-action me-1">Edit</a>
            <a href="manageleavetype.php?id=1" class="btn btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
            </td>
          </tr>
          <tr>
            <td>4</td>
            <td>Admin</td>
            <td>Admin</td>
            <td>ADMN01</td>
            <td>2023-09-01 20:50</td>
            <td>
            <a href="editdepartment.php?id=1" class="btn btn-view btn-action me-1">Edit</a>
            <a href="manageleavetype.php?id=1" class="btn btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this department?');">Delete</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <p class="text-muted mt-3">Showing 1 to 4 of 4 entries</p>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('menu-toggle').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('mainContent').classList.toggle('collapsed');
  });
</script>
</body>
</html>
