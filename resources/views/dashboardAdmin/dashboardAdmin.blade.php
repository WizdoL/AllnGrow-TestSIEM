<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AllnGrow - Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardAdmin/admin-dashboard.css">
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow Admin</div>
      <nav>
        <a class="nav-link active" data-page="dashboard">
          <i class="fas fa-home"></i> Dashboard
        </a>
        <a class="nav-link" data-page="pending-instructors">
          <i class="fas fa-user-clock"></i> Pending Instructors
          <span class="badge">3</span>
        </a>
        <a class="nav-link" data-page="manage-instructors">
          <i class="fas fa-chalkboard-teacher"></i> Manage Instructors
        </a>
        <a class="nav-link" data-page="pending-courses">
          <i class="fas fa-book-medical"></i> Pending Courses
          <span class="badge">5</span>
        </a>
        <a class="nav-link" data-page="manage-courses">
          <i class="fas fa-book"></i> Manage Courses
        </a>
        <a class="nav-link" data-page="students">
          <i class="fas fa-users"></i> Students
        </a>
        <a class="nav-link" data-page="analytics">
          <i class="fas fa-chart-line"></i> Analytics
        </a>
        <a class="nav-link" data-page="settings">
          <i class="fas fa-cog"></i> Settings
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Dashboard Tab -->
      <div class="tab-content active" id="dashboard">
        <header class="header">
          <div class="header-left">
            <h1>Admin Dashboard</h1>
            <p class="muted">Manage platform operations and approvals</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>

        <!-- Stats Grid -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">124</div>
              <div class="stat-label">Total Instructors</div>
              <div class="stat-change positive">+12 this month</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon green">
              <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">3,847</div>
              <div class="stat-label">Total Students</div>
              <div class="stat-change positive">+234 this month</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon orange">
              <i class="fas fa-book"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">456</div>
              <div class="stat-label">Total Courses</div>
              <div class="stat-change positive">+18 this month</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon purple">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">$124,560</div>
              <div class="stat-label">Total Revenue</div>
              <div class="stat-change positive">+8.5% this month</div>
            </div>
          </div>
        </div>

        <!-- Pending Approvals -->
        <div class="dashboard-grid">
          <section class="section">
            <div class="section-header">
              <h2>Pending Instructor Approvals</h2>
              <button class="btn-link" onclick="switchTab('pending-instructors')">View All</button>
            </div>
            <div class="approval-list">
              <div class="approval-item">
                <div class="approval-info">
                  <div class="approval-avatar">MK</div>
                  <div>
                    <h4>Dr. Michael Kim</h4>
                    <p class="muted">Applied 2 hours ago</p>
                  </div>
                </div>
                <div class="approval-actions">
                  <button class="btn-approve"><i class="fas fa-check"></i> Approve</button>
                  <button class="btn-reject"><i class="fas fa-times"></i> Reject</button>
                </div>
              </div>

              <div class="approval-item">
                <div class="approval-info">
                  <div class="approval-avatar">EW</div>
                  <div>
                    <h4>Emma Wilson</h4>
                    <p class="muted">Applied 5 hours ago</p>
                  </div>
                </div>
                <div class="approval-actions">
                  <button class="btn-approve"><i class="fas fa-check"></i> Approve</button>
                  <button class="btn-reject"><i class="fas fa-times"></i> Reject</button>
                </div>
              </div>
            </div>
          </section>

          <section class="section">
            <div class="section-header">
              <h2>Pending Course Approvals</h2>
              <button class="btn-link" onclick="switchTab('pending-courses')">View All</button>
            </div>
            <div class="approval-list">
              <div class="approval-item">
                <div class="approval-info">
                  <div class="course-icon"><i class="fas fa-code"></i></div>
                  <div>
                    <h4>React for Beginners</h4>
                    <p class="muted">By Dr. Sarah Johnson</p>
                  </div>
                </div>
                <div class="approval-actions">
                  <button class="btn-approve"><i class="fas fa-check"></i> Approve</button>
                  <button class="btn-reject"><i class="fas fa-times"></i> Reject</button>
                </div>
              </div>

              <div class="approval-item">
                <div class="approval-info">
                  <div class="course-icon"><i class="fas fa-mobile-alt"></i></div>
                  <div>
                    <h4>Flutter Development</h4>
                    <p class="muted">By John Anderson</p>
                  </div>
                </div>
                <div class="approval-actions">
                  <button class="btn-approve"><i class="fas fa-check"></i> Approve</button>
                  <button class="btn-reject"><i class="fas fa-times"></i> Reject</button>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- Pending Instructors Tab -->
      <div class="tab-content" id="pending-instructors">
        <header class="header">
          <div class="header-left">
            <h1>Pending Instructor Approvals</h1>
            <p class="muted">Review and approve instructor registrations</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>

        <div class="instructor-cards">
          <!-- Instructor Card 1 -->
          <div class="instructor-card">
            <div class="card-header">
              <div class="instructor-profile">
                <div class="instructor-avatar large">MK</div>
                <div class="profile-details">
                  <h3>Dr. Michael Kim</h3>
                  <p class="subtitle">PhD in Computer Science</p>
                  <p class="timestamp"><i class="fas fa-clock"></i> Applied 2 hours ago</p>
                </div>
              </div>
              <span class="status-badge pending">Pending Review</span>
            </div>

            <div class="card-body">
              <div class="info-grid">
                <div class="info-item">
                  <label>Email</label>
                  <p>michael.kim@university.edu</p>
                </div>
                <div class="info-item">
                  <label>Phone</label>
                  <p>+1 (555) 123-4567</p>
                </div>
                <div class="info-item">
                  <label>Expertise</label>
                  <p>Web Development, AI, Machine Learning</p>
                </div>
                <div class="info-item">
                  <label>Years of Experience</label>
                  <p>12 years</p>
                </div>
              </div>

              <div class="info-section">
                <label>Bio</label>
                <p>Experienced professor with over 12 years in teaching web development and AI. Published multiple research papers and worked with leading tech companies.</p>
              </div>

              <div class="info-section">
                <label>Credentials</label>
                <div class="file-list">
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>PhD_Certificate.pdf</span>
                  </div>
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Teaching_License.pdf</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button class="btn-secondary">
                <i class="fas fa-eye"></i> View Details
              </button>
              <div class="action-buttons">
                <button class="btn-reject">
                  <i class="fas fa-times"></i> Reject
                </button>
                <button class="btn-approve">
                  <i class="fas fa-check"></i> Approve
                </button>
              </div>
            </div>
          </div>

          <!-- Instructor Card 2 -->
          <div class="instructor-card">
            <div class="card-header">
              <div class="instructor-profile">
                <div class="instructor-avatar large">EW</div>
                <div class="profile-details">
                  <h3>Emma Wilson</h3>
                  <p class="subtitle">UI/UX Design Expert</p>
                  <p class="timestamp"><i class="fas fa-clock"></i> Applied 5 hours ago</p>
                </div>
              </div>
              <span class="status-badge pending">Pending Review</span>
            </div>

            <div class="card-body">
              <div class="info-grid">
                <div class="info-item">
                  <label>Email</label>
                  <p>emma.wilson@design.com</p>
                </div>
                <div class="info-item">
                  <label>Phone</label>
                  <p>+1 (555) 987-6543</p>
                </div>
                <div class="info-item">
                  <label>Expertise</label>
                  <p>UI/UX Design, Figma, Adobe XD</p>
                </div>
                <div class="info-item">
                  <label>Years of Experience</label>
                  <p>8 years</p>
                </div>
              </div>

              <div class="info-section">
                <label>Bio</label>
                <p>Senior UI/UX designer with 8 years of experience. Worked with Fortune 500 companies and startups to create beautiful user experiences.</p>
              </div>

              <div class="info-section">
                <label>Credentials</label>
                <div class="file-list">
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Design_Portfolio.pdf</span>
                  </div>
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Certifications.pdf</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button class="btn-secondary">
                <i class="fas fa-eye"></i> View Details
              </button>
              <div class="action-buttons">
                <button class="btn-reject">
                  <i class="fas fa-times"></i> Reject
                </button>
                <button class="btn-approve">
                  <i class="fas fa-check"></i> Approve
                </button>
              </div>
            </div>
          </div>

          <!-- Instructor Card 3 -->
          <div class="instructor-card">
            <div class="card-header">
              <div class="instructor-profile">
                <div class="instructor-avatar large">JL</div>
                <div class="profile-details">
                  <h3>James Lee</h3>
                  <p class="subtitle">Data Science Specialist</p>
                  <p class="timestamp"><i class="fas fa-clock"></i> Applied 1 day ago</p>
                </div>
              </div>
              <span class="status-badge pending">Pending Review</span>
            </div>

            <div class="card-body">
              <div class="info-grid">
                <div class="info-item">
                  <label>Email</label>
                  <p>james.lee@datascience.com</p>
                </div>
                <div class="info-item">
                  <label>Phone</label>
                  <p>+1 (555) 456-7890</p>
                </div>
                <div class="info-item">
                  <label>Expertise</label>
                  <p>Data Science, Python, Machine Learning</p>
                </div>
                <div class="info-item">
                  <label>Years of Experience</label>
                  <p>10 years</p>
                </div>
              </div>

              <div class="info-section">
                <label>Bio</label>
                <p>Data scientist with a decade of experience in machine learning and AI. Former lead data scientist at major tech companies.</p>
              </div>

              <div class="info-section">
                <label>Credentials</label>
                <div class="file-list">
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Masters_Degree.pdf</span>
                  </div>
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <span>Work_Experience.pdf</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer">
              <button class="btn-secondary">
                <i class="fas fa-eye"></i> View Details
              </button>
              <div class="action-buttons">
                <button class="btn-reject">
                  <i class="fas fa-times"></i> Reject
                </button>
                <button class="btn-approve">
                  <i class="fas fa-check"></i> Approve
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Manage Instructors Tab -->
      <div class="tab-content" id="manage-instructors">
        <header class="header">
          <div class="header-left">
            <h1>Manage Instructors</h1>
            <p class="muted">View and manage all approved instructors</p>
          </div>
          <div class="header-right">
            <div class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" placeholder="Search instructors...">
            </div>
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>

        <div class="table-container">
          <table class="table">
            <thead>
              <tr>
                <th>Instructor</th>
                <th>Email</th>
                <th>Courses</th>
                <th>Students</th>
                <th>Rating</th>
                <th>Revenue</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="table-user">
                    <div class="table-avatar">SJ</div>
                    <div>
                      <strong>Dr. Sarah Johnson</strong>
                      <p class="muted">Web Development</p>
                    </div>
                  </div>
                </td>
                <td>sarah.johnson@email.com</td>
                <td>8</td>
                <td>1,243</td>
                <td>⭐ 4.8</td>
                <td>$12,450</td>
                <td><span class="status-badge active">Active</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Suspend"><i class="fas fa-ban"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="table-user">
                    <div class="table-avatar">MC</div>
                    <div>
                      <strong>Prof. Michael Chen</strong>
                      <p class="muted">Data Science</p>
                    </div>
                  </div>
                </td>
                <td>michael.chen@email.com</td>
                <td>6</td>
                <td>856</td>
                <td>⭐ 4.9</td>
                <td>$9,800</td>
                <td><span class="status-badge active">Active</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Suspend"><i class="fas fa-ban"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="table-user">
                    <div class="table-avatar">JA</div>
                    <div>
                      <strong>John Anderson</strong>
                      <p class="muted">Mobile Development</p>
                    </div>
                  </div>
                </td>
                <td>john.anderson@email.com</td>
                <td>5</td>
                <td>634</td>
                <td>⭐ 4.7</td>
                <td>$7,230</td>
                <td><span class="status-badge active">Active</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Suspend"><i class="fas fa-ban"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="table-user">
                    <div class="table-avatar">LM</div>
                    <div>
                      <strong>Lisa Martinez</strong>
                      <p class="muted">Marketing</p>
                    </div>
                  </div>
                </td>
                <td>lisa.martinez@email.com</td>
                <td>4</td>
                <td>423</td>
                <td>⭐ 4.6</td>
                <td>$5,120</td>
                <td><span class="status-badge suspended">Suspended</span></td>
                <td>
                  <div class="action-btns">
                    <button class="action-btn" title="View"><i class="fas fa-eye"></i></button>
                    <button class="action-btn" title="Edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn" title="Activate"><i class="fas fa-check"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pending Courses Tab -->
      <div class="tab-content" id="pending-courses">
        <header class="header">
          <div class="header-left">
            <h1>Pending Course Approvals</h1>
            <p class="muted">Review and approve course submissions</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>

        <div class="course-review-list">
          <!-- Course Review Card 1 -->
          <div class="course-review-card">
            <div class="course-thumbnail">
              <div class="thumbnail-placeholder">
                <i class="fas fa-code"></i>
              </div>
            </div>
            <div class="course-details">
              <div class="course-header-section">
                <div>
                  <h3>React for Beginners</h3>
                  <p class="muted">By Dr. Sarah Johnson • Submitted 2 days ago</p>
                </div>
                <span class="status-badge pending">Pending Review</span>
              </div>

              <div class="course-info">
                <div class="info-row">
                  <span><i class="fas fa-tag"></i> Development</span>
                  <span><i class="fas fa-signal"></i> Beginner</span>
                  <span><i class="fas fa-clock"></i> 12 hours</span>
                  <span><i class="fas fa-dollar-sign"></i> $29.99</span>
                </div>
              </div>

              <div class="course-description">
                <p>Learn React from scratch with hands-on projects. Perfect for beginners who want to master modern web development.</p>
              </div>

              <div class="course-actions">
                <button class="btn-secondary">
                  <i class="fas fa-eye"></i> Preview Course
                </button>
                <div class="action-buttons">
                  <button class="btn-reject">
                    <i class="fas fa-times"></i> Reject
                  </button>
                  <button class="btn-approve">
                    <i class="fas fa-check"></i> Approve
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Course Review Card 2 -->
          <div class="course-review-card">
            <div class="course-thumbnail">
              <div class="thumbnail-placeholder">
                <i class="fas fa-mobile-alt"></i>
              </div>
            </div>
            <div class="course-details">
              <div class="course-header-section">
                <div>
                  <h3>Flutter Development Masterclass</h3>
                  <p class="muted">By John Anderson • Submitted 3 days ago</p>
                </div>
                <span class="status-badge pending">Pending Review</span>
              </div>

              <div class="course-info">
                <div class="info-row">
                  <span><i class="fas fa-tag"></i> Mobile Development</span>
                  <span><i class="fas fa-signal"></i> Intermediate</span>
                  <span><i class="fas fa-clock"></i> 18 hours</span>
                  <span><i class="fas fa-dollar-sign"></i> $49.99</span>
                </div>
              </div>

              <div class="course-description">
                <p>Master Flutter and build beautiful cross-platform mobile apps. Includes real-world projects and advanced techniques.</p>
              </div>

              <div class="course-actions">
                <button class="btn-secondary">
                  <i class="fas fa-eye"></i> Preview Course
                </button>
                <div class="action-buttons">
                  <button class="btn-reject">
                    <i class="fas fa-times"></i> Reject
                  </button>
                  <button class="btn-approve">
                    <i class="fas fa-check"></i> Approve
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Other Tabs Placeholder -->
      <div class="tab-content" id="manage-courses">
        <header class="header">
          <div class="header-left">
            <h1>Manage Courses</h1>
            <p class="muted">View and manage all platform courses</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>
        <p>Manage Courses content coming soon...</p>
      </div>

      <div class="tab-content" id="students">
        <header class="header">
          <div class="header-left">
            <h1>Students</h1>
            <p class="muted">View and manage all students</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>
        <p>Students management content coming soon...</p>
      </div>

      <div class="tab-content" id="analytics">
        <header class="header">
          <div class="header-left">
            <h1>Analytics</h1>
            <p class="muted">Platform analytics and insights</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>
        <p>Analytics content coming soon...</p>
      </div>

      <div class="tab-content" id="settings">
        <header class="header">
          <div class="header-left">
            <h1>Settings</h1>
            <p class="muted">Platform settings and configuration</p>
          </div>
          <div class="header-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <div class="user">
              <div class="user-avatar">AD</div>
              <div class="user-info">
                <div class="user-name">Admin User</div>
                <div class="user-role">Administrator</div>
              </div>
            </div>
          </div>
        </header>
        <p>Settings content coming soon...</p>
      </div>
    </main>
  </div>

  <script>
    // Tab Navigation
    const navLinks = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-content');

    function switchTab(pageName) {
      navLinks.forEach(nav => nav.classList.remove('active'));
      tabContents.forEach(tab => tab.classList.remove('active'));
      
      document.querySelector(`[data-page="${pageName}"]`).classList.add('active');
      document.getElementById(pageName).classList.add('active');
    }

    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetPage = this.dataset.page;
        switchTab(targetPage);
      });
    });
  </script>
</body>
</html>