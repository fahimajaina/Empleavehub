<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EMPLEAVEHUB | Apply Leave</title>

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

    .succWrap, .errorWrap {
      padding: 12px 20px;
      margin-bottom: 20px;
      background: #ffffff;
      border-left: 5px solid;
      border-radius: 8px;
      font-weight: 500;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
    }

    .succWrap {
      border-color: #28a745;
      color: #155724;
    }

    .errorWrap {
      border-color: #dc3545;
      color: #721c24;
    }

    .main-content .form-label {
      color: #333;
    }

    .main-content .form-control,
    .main-content .form-select {
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .main-content .form-control:focus,
    .main-content .form-select:focus {
      border-color: #48A6A7;
      box-shadow: 0 0 0 0.25rem rgba(72, 166, 167, 0.2);
    }

    .form-control:hover,
    .form-select:hover {
      background-color: #f9fdfd;
    }

    .btn-primary {
      background-color: #48A6A7;
      border-color: #48A6A7;
    }

    .btn-primary:hover {
      background-color: #3f9393;
      border-color: #3f9393;
    }

    .text-leave-title {
      color: #2c7a7b;
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
      <small class="text-muted">7856214</small>
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
  <div class="container-fluid px-0">
    <div class="card shadow-sm rounded-4 p-5 border-0" style="background: #ffffff;">
      <h4 class="mb-4 fw-semibold text-leave-title">Apply for Leave</h4>

     

      <form>
        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label for="leavetype" class="form-label fw-medium text-secondary">Leave Type</label>
            <select class="form-select rounded-3 shadow-sm border-1" id="leavetype" required>
             <option value="">Select leave type...</option>
             <option value="Casual Leave">Casual Leave (3 left)</option>
             <option value="Sick Leave">Sick Leave (4 left)</option>
             <option value="Earned Leave">Earned Leave (2 left)</option>
           </select>

          </div>
        </div>

        <div class="row g-4 mb-4">
          <div class="col-md-6">
            <label for="fromdate" class="form-label fw-medium text-secondary">From Date</label>
            <input type="date" class="form-control rounded-3 shadow-sm border-1" id="fromdate" required>
          </div>
          <div class="col-md-6">
            <label for="todate" class="form-label fw-medium text-secondary">To Date</label>
            <input type="date" class="form-control rounded-3 shadow-sm border-1" id="todate" required>
          </div>
        </div>

        <div class="mb-4">
          <label for="description" class="form-label fw-medium text-secondary">Description</label>
          <textarea class="form-control rounded-3 shadow-sm border-1" id="description" rows="4" placeholder="Enter the reason for leave..." required></textarea>
        </div>

        <button type="submit" name="apply" id="apply" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm">Apply</button>
      </form>
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
