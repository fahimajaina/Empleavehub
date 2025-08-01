# **EmpLeaveHub - Employee Leave Management System**

## **Table of Contents**
- [Overview](#overview)
- [Purpose](#purpose)
- [Technologies Used](#technologies-used)
- [Features](#features)
  - [Employee Features](#employee-features)
  - [Admin Features](#admin-features)
- [Project Structure](#project-structure)
- [Installation](#installation)
  - [Prerequisites](#prerequisites)
  - [Database Setup](#database-setup)
  - [Configuration](#configuration)
- [How It Works](#how-it-works)
  - [Employee Workflow](#employee-workflow)
  - [Admin Workflow](#admin-workflow)
- [Security Features](#security-features)
- [Future Enhancements](#future-enhancements)
- [Team Members](#team-members)
- [Instructor](#instructor)

## **Overview**

EmpLeaveHub is a comprehensive web-based Employee Leave Management System designed to streamline and automate the process of applying, approving, and tracking employee leave requests. The system provides an intuitive interface for employees to manage their leave applications and for administrators to efficiently process these requests.

## **Purpose**

The **EmpLeaveHub** platform aims to replace traditional paper-based leave application systems with a digital solution that offers:

- Simplified leave application process for employees
- Efficient approval workflow for management
- Centralized leave record management
- Real-time leave status tracking
- Automated leave balance calculations
- Comprehensive reporting capabilities

This system enhances organizational efficiency by reducing paperwork, minimizing errors, and providing instant access to leave-related information for both employees and management.

---

## **Technologies Used**

- **Frontend**:
  - HTML5
  - CSS3
  - Bootstrap 5
  - JavaScript
  - Material Icons

- **Backend**:
  - PHP 7+
  - MySQL Database
  - PDO for database connections

- **Email System**:
  - PHPMailer

- **Security**:
  - Password hashing using PHP's password_hash()
  - CSRF protection
  - Input sanitization

---

## **Features**

### **Employee Features**

- **Dashboard**: Employees can view their leave statistics and recent leave applications at a glance
- **Apply for Leave**: Submit leave requests specifying dates, type, and reason
- **Leave History**: View complete history of leave applications and their status
- **Profile Management**: Update personal information and contact details
- **Password Management**: Change password and reset forgotten passwords
- **Notifications**: Receive email alerts about leave request status updates

### **Admin Features**

- **Dashboard**: Comprehensive overview of department-wise leave statistics
- **Department Management**: Add, edit, and manage departments
- **Leave Type Management**: Define different leave categories with customizable allocations
- **Employee Management**: Add, edit, and manage employee records
- **Leave Processing**: Review, approve, or reject leave applications with comments
- **Leave Reports**: Filter and view leave records by department, status, or date range
- **User Management**: Reset passwords and manage user accounts

---

## **Project Structure**

```
/EmpLeaveHub
├── /admin                      # Admin portal files
│   ├── /includes               # Admin configuration files
│   ├── dashboard.php           # Admin dashboard
│   ├── leaves.php              # Leave management
│   └── ...                     # Other admin pages
├── /assets                     # Frontend assets
│   ├── /css                    # Stylesheets
│   ├── /js                     # JavaScript files
│   ├── /images                 # Image resources
│   └── /plugins                # Third-party plugins
├── /include                    # Shared configuration files
├── /PHPMailer-master           # Email functionality
├── dashboard.php               # Employee dashboard
├── apply-leave.php             # Leave application form
├── index.php                   # Login page
└── README.md                   # Project documentation
```

---

## **Installation**

### **Prerequisites**

- Web server (Apache/Nginx)
- PHP 7.0 or higher
- MySQL 5.7 or higher
- SMTP server for email functionality

### **Database Setup**

1. Create a new MySQL database named `empleavehub`
2. Import the `empleavehub.sql` file to set up the required tables and initial data

### **Configuration**

1. Update database connection parameters in:
   - `/include/config.php` (for employee portal)
   - `/admin/includes/config.php` (for admin portal)

2. Configure email settings in the relevant PHP files:
   ```php
   $mail->Host = 'your-smtp-server';
   $mail->Username = 'your-email@example.com';
   $mail->Password = 'your-email-password';
   ```

3. Deploy the application to your web server's document root

---

## **How It Works**

### **Employee Workflow**

1. **Login**: Employees log in using their email and password
2. **Dashboard**: View leave balance and recent leave applications
3. **Apply for Leave**: Fill out the leave application form with required details
4. **Track Status**: Monitor the status of leave applications (Pending/Approved/Rejected)
5. **View History**: Access complete leave history with filtering options

### **Admin Workflow**

1. **Login**: Administrators log in to the admin panel
2. **Dashboard**: View department-wise leave statistics and pending requests
3. **Review Requests**: Examine leave applications with employee details
4. **Process Leaves**: Approve or reject leave requests with appropriate remarks
5. **Manage System**: Configure departments, leave types, and employee records

---

## **Security Features**

- Secure password storage using PHP's built-in hashing functions
- Token-based password reset system with expiration
- Input validation and sanitization to prevent SQL injection
- CSRF token implementation for form submissions
- Role-based access control for different user types

---

## **Future Enhancements**

- Mobile application for on-the-go leave management
- Calendar integration with popular platforms (Google Calendar, Outlook)
- Advanced reporting and analytics dashboard
- Document upload feature for supporting documentation
- Integration with HR management systems
- Automated leave policy enforcement
- Multi-language support for international organizations

---

## **Team Members**

| Name | Role |
|------|------|
| **MST. FAHIMAJJAMAN JAINA** | Team Lead & Backend Developer |
| **DULON AKHTER SATHEE** | Frontend Developer & UI Designer |
| **HALIMA SADIA TABASSUM** | Database Administrator & Documentation Specialist |

---

## **Instructor**

This project was developed under the guidance of **Sabuj Chandra Paul**, who provided valuable insights and feedback throughout the development process.
