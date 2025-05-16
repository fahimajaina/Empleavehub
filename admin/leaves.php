<?php
// Start session and include configuration
session_start();
include('includes/config.php');

// Check if admin is logged in
if (!isset($_SESSION['alogin'])) {
    header('location:index.php');
    exit();
}

// Fetch all leaves with employee and leave type details
$sql = "SELECT l.id, l.PostingDate, l.Status, 
        e.id as employee_id, e.FirstName, e.LastName, e.EmpId,
        lt.LeaveType 
        FROM tblleaves l
        JOIN tblemployees e ON l.empid = e.id
        JOIN tblleavetype lt ON l.LeaveTypeID = lt.id
        ORDER BY l.PostingDate DESC";

try {
    $query = $dbh->prepare($sql);
    $query->execute();
    $leaves = $query->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Log error and show generic message
    error_log("Error fetching leaves: " . $e->getMessage());
    $error = "Error fetching leave records. Please try again later.";
}

// Function to get status badge class
function getStatusBadgeClass($status) {
    switch($status) {
        case 1:
            return 'bg-success';
        case 2:
            return 'bg-danger';
        default:
            return 'bg-warning text-dark';
    }
}

// Function to get status text
function getStatusText($status) {
    switch($status) {
        case 1:
            return 'Approved';
        case 2:
            return 'Not Approved';
        default:
            return 'Pending';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EMPLEAVEHUB | Leave History</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts & Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

    .main-content {
      margin-left: 240px;
      padding: 90px 40px 40px 40px;
      transition: margin-left 0.3s ease;
      background: linear-gradient(135deg, #f9fefe, #f0fdfd);
      min-height: 100vh;
    }

    .main-content.collapsed {
      margin-left: 0;
    }

    .page-title {
      display: flex;
      align-items: center;
      gap: 10px;
      color: rgb(66, 155, 193);
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 30px;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .card {
      border: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
      border-radius: 20px;
      background: #ffffff;
      transition: box-shadow 0.2s ease;
    }

    .card:hover {
      /* Removed translateY to prevent table shift on hover */
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
    }

    .card-title {
      color: #333;
      font-size: 20px;
    }

    .search-wrapper {
      position: relative;
      max-width: 300px;
      margin-bottom: 16px;
    }

    .search-wrapper .material-icons {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #aaa;
    }

    .search-box {
      padding-left: 40px;
      border-radius: 12px;
      border: 1px solid #ccc;
      transition: border-color 0.3s, box-shadow 0.3s;
      background-color: #fdfdfd;
    }

    .search-box:focus {
      border-color: rgb(144, 215, 246);
      box-shadow: 0 0 0 0.2rem rgba(110, 220, 222, 0.25);
    }

    .table thead {
      background-color: #e0f7f7;
      font-weight: 600;
    }

    .table tbody tr:hover {
      background-color: #f1fefe;
      transition: background 0.2s ease;
    }

    .badge {
      padding: 6px 10px;
      font-size: 13px;
      border-radius: 12px;
    }

    .btn-outline-primary {
      border-radius: 10px;
      font-size: 14px;
      transition: all 0.2s ease;
    }

    .btn-outline-primary:hover {
      background-color: #48A6A7;
      color: white;
      border-color: #48A6A7;
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

    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#deptMenu">
      <span class="material-icons">apartment</span> Department <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="deptMenu">
      <a href="adddepartment.php" class="list-group-item list-group-item-action">Add Department</a>
      <a href="managedepartments.php" class="list-group-item list-group-item-action">Manage Department</a>
    </div>

    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#leaveTypeMenu">
      <span class="material-icons">event_note</span> Leave Type <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="leaveTypeMenu">
      <a href="addleavetype.php" class="list-group-item list-group-item-action">Add Leave Type</a>
      <a href="manageleavetype.php" class="list-group-item list-group-item-action">Manage Leave Type</a>
    </div>

    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#employeeMenu">
      <span class="material-icons">people</span> Employees <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="employeeMenu">
      <a href="addemployee.php" class="list-group-item list-group-item-action">Add Employee</a>
      <a href="manageemployee.php" class="list-group-item list-group-item-action">Manage Employee</a>
    </div>

    <a class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="collapse" href="#leaveMgmtMenu">
      <span class="material-icons">assignment</span> Leave Management <span class="ms-auto">›</span>
    </a>
    <div class="collapse" id="leaveMgmtMenu">
      <a href="leaves.php" class="list-group-item list-group-item-action">All Leaves</a>
      <a href="pending-leavehistory.php" class="list-group-item list-group-item-action">Pending Leaves</a>
      <a href="approvedleave-history.php" class="list-group-item list-group-item-action">Approved Leaves</a>
      <a href="notapproved-leaves.php" class="list-group-item list-group-item-action">Not Approved Leaves</a>
    </div>

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
  <div class="page-title">
    <span class="material-icons">event_note</span> Leave History
  </div>

  <!-- Leave History Card -->
  <div class="card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
      <h5 class="card-title fw-bold mb-3" style="color: #333;">Leave Records</h5>

      <!-- Search Input -->
      <div class="search-wrapper">
        <span class="material-icons">search</span>
        <input type="text" id="searchInput" class="form-control search-box" placeholder="Search...">
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle" id="leaveTable">
        <thead>
          <tr class="text-secondary">
            <th>#</th>
            <th>Employe Name</th>
            <th>Leave Type</th>
            <th>Posting Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(isset($error)): ?>
            <tr>
              <td colspan="6" class="text-center text-danger"><?php echo htmlspecialchars($error); ?></td>
            </tr>
          <?php 
          elseif(empty($leaves)): ?>
            <tr>
              <td colspan="6" class="text-center">No leave records found</td>
            </tr>
          <?php 
          else:
            $cnt = 1;
            foreach($leaves as $leave): 
              // Prepare employee name with ID
              $empName = htmlspecialchars($leave['FirstName'] . ' ' . $leave['LastName'] . 
                        '(' . $leave['EmpId'] . ')');
              // Get status styling
              $statusClass = getStatusBadgeClass($leave['Status']);
              $statusText = getStatusText($leave['Status']);
          ?>
            <tr>              <td><?php echo $cnt++; ?></td>
              <td><a href="editemployee.php?id=<?php echo htmlspecialchars($leave['employee_id']); ?>"><?php echo $empName; ?></a></td>
              <td><?php echo htmlspecialchars($leave['LeaveType']); ?></td>
              <td><?php echo htmlspecialchars($leave['PostingDate']); ?></td>
              <td><span class="badge <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
              <td><a href="leave-details.php?leaveid=<?php echo htmlspecialchars($leave['id']); ?>" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
          <?php 
            endforeach;
          endif; 
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle -->
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('main-content');

  toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
  });
</script>

<!-- Search Filter Script -->
<script>
  const searchInput = document.getElementById('searchInput');
  const table = document.getElementById('leaveTable');
  searchInput.addEventListener('keyup', function () {
    const filter = searchInput.value.toLowerCase();
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>

</body>
</html>
