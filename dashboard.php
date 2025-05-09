<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EMPLEAVEHUB | Dashboard</title>

  <!-- Bootstrap 5 -->
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
      z-index: 1001;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1),
                  0 6px 15px rgba(0, 0, 0, 0.1);
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
      overflow: hidden;
    }

    #sidebar.collapsed {
      transform: translateX(-100%);
    }

    .sidebar-content {
      overflow-y: auto;
      flex-grow: 1;
      padding-top: 10px;
    }

    #sidebar .material-icons {
      margin-right: 10px;
      font-size: 20px;
    }

    #sidebar hr {
      border-color: #e0e0e0;
    }

    #sidebar a,
    #sidebar button.sidebar-btn {
      display: flex;
      align-items: center;
      width: 100%;
      padding: 12px 20px;
      color: #333;
      text-decoration: none;
      font-weight: 500;
      background: transparent;
      border: none;
      text-align: left;
      transition: background 0.3s ease;
    }

    #sidebar a:hover,
    #sidebar button.sidebar-btn:hover {
      background-color: #e6fafa;
      color: #000;
    }

    #sidebar .collapse a {
      font-weight: 400;
      padding-left: 36px;
      color: #555;
    }

    #sidebar .collapse a:hover {
      background-color: #f0fdfd;
    }

    #sidebar .material-icons.float-end {
      margin-left: auto;
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
      padding: 80px 30px 30px 30px;
      transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
      margin-left: 0;
    }

    .card {
      border-radius: 12px;
    }

    .summary-card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .summary-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .table th {
      font-weight: 600;
    }

    .table td,
    .table th {
      vertical-align: middle;
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.45em 0.7em;
      border-radius: 0.5rem;
    }

    a.text-decoration-none:hover {
      text-decoration: none;
    }
  </style>
</head>
<body>

<!-- Navbar -->
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
      <h6 class="mb-0" style="font-weight:600;">John Doe</h6>
      <small class="text-muted">EMP12345</small>
    </div>
    <hr class="mx-3">

    <a href="dashboard.php"><span class="material-icons">dashboard</span> Dashboard</a>
    <a href="myprofile.php"><span class="material-icons">account_circle</span> My Profile</a>
    <a href="emp-changepassword.php"><span class="material-icons">lock</span> Change Password</a>

    <button class="sidebar-btn" type="button" data-bs-toggle="collapse" data-bs-target="#leaveMenu" aria-expanded="false" aria-controls="leaveMenu">
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
  <div class="row g-4 mt-4">
    <div class="col-md-4">
      <a href="leavehistory.php" class="text-decoration-none">
        <div class="card border-0 shadow-sm summary-card" style="background-color: #48A6A7; color: #fff;">
          <div class="card-body">
            <h5 class="card-title">Total Leaves</h5>
            <p class="card-text display-6 fw-semibold">2</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-4">
      <a href="approvedleave-history.php" class="text-decoration-none">
        <div class="card border-0 shadow-sm summary-card" style="background-color: #48A6A7; color: #fff;">
          <div class="card-body">
            <h5 class="card-title">Approved Leaves</h5>
            <p class="card-text display-6 fw-semibold">1</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col-md-4">
      <a href="pending-leavehistory.php" class="text-decoration-none">
        <div class="card border-0 shadow-sm summary-card" style="background-color: #48A6A7; color: #fff;">
          <div class="card-body">
            <h5 class="card-title">New Leave Applications</h5>
            <p class="card-text display-6 fw-semibold">1</p>
          </div>
        </div>
      </a>
    </div>
  </div>

  <!-- Leave Applications Table -->
  <div class="card mt-4 border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
      <h6 class="mb-0 fw-bold" style="color: #48A6A7;">Latest Leave Applications</h6>
    <!--  <button class="btn btn-sm btn-outline-primary">View All</button>-->
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead style="background-color: #e0f7f7;">
            <tr style="color: #1f5d5d;">
              <th scope="col">#</th>
              <th scope="col">Employee Name</th>
              <th scope="col">Leave Type</th>
              <th scope="col">Posting Date</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-bottom">
              <td>1</td>
              <td>John Doe (7856214)</td>
              <td>Sick Leave</td>
              <td>2025-02-12 01:14:42</td>
              <td><span class="badge bg-warning text-dark">Pending</span></td>
              <td><a href="leave-details.php" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
            <tr>
              <td>2</td>
              <td>John Doe (7856214)</td>
              <td>Casual Leave</td>
              <td>2024-09-12 17:42:40</td>
              <td><span class="badge bg-success">Approved</span></td>
              <td><a href="leave-details.php" class="btn btn-sm btn-outline-primary">View</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle Script -->
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
