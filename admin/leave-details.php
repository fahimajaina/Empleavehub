<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ELMS | Leave Details</title>

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


    .main-content {
      margin-left: 240px;
      padding: 100px 30px 30px 30px;
      background-color: #f7fdfd;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
      margin-left: 0;
    }

    .page-title {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 30px;
    }

    .page-title .material-icons {
      font-size: 32px;
      color: rgb(66, 155, 193);
    }

    .page-title h3 {
      margin: 0;
      font-weight: 600;
      font-size: 26px;
      color:rgb(66, 155, 193);
    }

    .card {
      border: none;
      border-radius: 16px;
      background: #fff;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    }

    .card-title {
      font-size: 22px;
      font-weight: 600;
      color: #48A6A7;
      display: flex;
      align-items: center;
      gap: 6px;
      margin-bottom: 20px;
    }

    .table td {
      vertical-align: middle;
      padding: 14px 12px;
      font-size: 15px;
      color: #333;
    }

    .label {
      font-weight: 600;
      color: #6c757d;
      font-size: 15px;
    }

    .value {
      font-weight: 500;
      font-size: 15.5px;
      color: #2d4f4f;
    }

    .badge {
      font-size: 14px;
      padding: 6px 14px;
      font-weight: 600;
      border-radius: 12px;
    }

    .section-divider {
      border-top: 1px solid #e0e0e0;
      margin: 20px 0;
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

      .main-content.collapsed {
        margin-left: 240px !important;
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
  <div class="container-fluid">
    <div class="page-title">
      <span class="material-icons">event_note</span>
      <h3>Leave Details</h3>
    </div>

    <div class="card p-4">
      <div class="card-title"><span class="material-icons">info</span>Leave Information</div>

      <table class="table table-borderless">
        <tbody>
          <tr>
            <td class="label">Employee Name:</td>
            <td class="value">John Doe</td>
            <td class="label">Emp ID:</td>
            <td class="value">7856214</td>
            <td class="label">Gender:</td>
            <td class="value">Male</td>
          </tr>
          <tr>
            <td class="label">Emp Email ID:</td>
            <td class="value">jhn12@gmail.com</td>
            <td class="label">Emp Contact No.:</td>
            <td class="value">23232323</td>
            <td></td><td></td>
          </tr>
          <tr>
  <td class="label">Leave Type:</td>
  <td class="value">Casual Leaves</td>
  <td class="label">Leave Date:</td>
  <td class="value">09/09/2024 - 15/09/2024</td>
  <td class="label">Posting Date:</td>
  <td class="value">2024-09-12 17:42:40</td>
</tr>
<tr>
  <td colspan="6">
    <div class="d-flex flex-wrap gap-3">
      <div class="p-3 bg-light rounded shadow-sm flex-fill text-center">
        <div class="label">Max Allowed (per year)</div>
        <div class="value fs-5 fw-semibold text-primary">10</div>
      </div>
      <div class="p-3 bg-light rounded shadow-sm flex-fill text-center">
        <div class="label">Requested So Far</div>
        <div class="value fs-5 fw-semibold text-warning">3</div>
      </div>
      <div class="p-3 bg-light rounded shadow-sm flex-fill text-center">
        <div class="label">Remaining</div>
        <div class="value fs-5 fw-semibold text-success">7</div>
      </div>
    </div>
  </td>
</tr>


        </tbody>
      </table>

      <div class="section-divider"></div>

      <table class="table table-borderless mt-3">
        <tbody>
          <tr>
            <td class="label">Leave Description:</td>
            <td class="value" colspan="5">Need casual leaves for some personal work.</td>
          </tr>
          <tr>
            <td class="label">Leave Status:</td>
            <td colspan="5"><span class="badge bg-success text-white">Approved</span></td>
          </tr>
          <tr>
            <td class="label">Admin Remark:</td>
            <td class="value" colspan="5">Leave approved</td>
          </tr>
          <tr>
            <td class="label">Admin Action Taken Date:</td>
            <td class="value" colspan="5">2024-09-13 20:39:40</td>
          </tr>
          <tr>
            <td colspan="6">
              <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#actionModal">
                <span class="material-icons align-middle">gavel</span> Take Action
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Action Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <form name="adminaction" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="actionModalLabel">Take Action on Leave Request</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="leaveStatus" class="form-label">Leave Status</label>
            <select class="form-select" name="status" id="leaveStatus" required>
              <option value="">Choose an option</option>
              <option value="1">Approved</option>
              <option value="2">Not Approved</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="adminRemark" class="form-label">Admin Remark</label>
            <textarea class="form-control" id="adminRemark" name="description" placeholder="Enter a remark..." rows="4" maxlength="500" required></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="update">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const toggleBtn = document.getElementById('menu-toggle');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('main-content');

  toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
  });
</script>

</body>
</html>
