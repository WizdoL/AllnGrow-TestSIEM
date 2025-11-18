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
          @php
            $pendingCount = $instructors->filter(function($instructor) {
              return $instructor->detail && $instructor->detail->status === 'pending';
            })->count();
          @endphp
          @if($pendingCount > 0)
          <span class="badge">{{ $pendingCount }}</span>
          @endif
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
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline; margin-left: 10px;">
              @csrf
              <button type="submit" style="background:#ff4444;color:#fff;padding:8px 16px;border:none;border-radius:6px;cursor:pointer;font-weight:500;">
                <i class="fas fa-sign-out-alt"></i> Logout
              </button>
            </form>
          </div>
        </header>

        <!-- Stats Grid -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">{{ $instructors->count() }}</div>
              <div class="stat-label">Total Instructors</div>
              @php
                $approvedCount = $instructors->filter(function($instructor) {
                  return $instructor->detail && $instructor->detail->status === 'approved';
                })->count();
              @endphp
              <div class="stat-change positive">{{ $approvedCount }} approved</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon green">
              <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">{{ \App\Models\Student::count() }}</div>
              <div class="stat-label">Total Students</div>
              <div class="stat-change positive">Active learners</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon orange">
              <i class="fas fa-book"></i>
            </div>
            <div class="stat-content">
              <div class="stat-value">{{ \App\Models\Course::count() }}</div>
              <div class="stat-label">Total Courses</div>
              <div class="stat-change positive">Published</div>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon purple">
              <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-content">
              @php
                $pendingCount = $instructors->filter(function($instructor) {
                  return $instructor->detail && $instructor->detail->status === 'pending';
                })->count();
              @endphp
              <div class="stat-value">{{ $pendingCount }}</div>
              <div class="stat-label">Pending Approvals</div>
              <div class="stat-change {{ $pendingCount > 0 ? 'negative' : 'positive' }}">Requires action</div>
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
              @php
                $pendingInstructors = $instructors->filter(function($instructor) {
                  return $instructor->detail && $instructor->detail->status === 'pending';
                })->take(2);
              @endphp
              
              @forelse($pendingInstructors as $instructor)
              <div class="approval-item">
                <div class="approval-info">
                  <div class="approval-avatar">{{ strtoupper(substr($instructor->name ?? 'IN', 0, 2)) }}</div>
                  <div>
                    <h4>{{ $instructor->name ?? 'Unknown' }}</h4>
                    <p class="muted">{{ $instructor->created_at->diffForHumans() }}</p>
                  </div>
                </div>
                <div class="approval-actions">
                  <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn-approve"><i class="fas fa-check"></i> Approve</button>
                  </form>
                  <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn-reject"><i class="fas fa-times"></i> Reject</button>
                  </form>
                </div>
              </div>
              @empty
              <p class="muted" style="text-align: center; padding: 20px;">Tidak ada instructor yang menunggu approval</p>
              @endforelse
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

        @if(session('success'))
          <div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:16px;margin:20px;border-radius:8px;font-weight:500;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div style="background:#f8d7da;border:1px solid #f5c6cb;color:#721c24;padding:16px;margin:20px;border-radius:8px;font-weight:500;">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
          </div>
        @endif

        <div class="instructor-cards">
          @php
            $pendingInstructors = $instructors->filter(function($instructor) {
              return $instructor->detail && $instructor->detail->status === 'pending';
            });
          @endphp
          
          @forelse($pendingInstructors as $instructor)
          <div class="instructor-card">
            <div class="card-header">
              <div class="instructor-profile">
                <div class="instructor-avatar large">{{ strtoupper(substr($instructor->name ?? 'IN', 0, 2)) }}</div>
                <div class="profile-details">
                  <h3>{{ $instructor->name ?? 'Unknown' }}</h3>
                  <p class="subtitle">{{ $instructor->detail->expertise ?? 'N/A' }}</p>
                  <p class="timestamp"><i class="fas fa-clock"></i> Applied {{ $instructor->created_at->diffForHumans() }}</p>
                </div>
              </div>
              <span class="status-badge pending">Pending Review</span>
            </div>

            <div class="card-body">
              <div class="info-grid">
                <div class="info-item">
                  <label>Email</label>
                  <p>{{ $instructor->email }}</p>
                </div>
                <div class="info-item">
                  <label>Phone</label>
                  <p>{{ $instructor->detail->phone ?? 'N/A' }}</p>
                </div>
                <div class="info-item">
                  <label>Expertise</label>
                  <p>{{ $instructor->detail->expertise ?? 'N/A' }}</p>
                </div>
                <div class="info-item">
                  <label>Years of Experience</label>
                  <p>{{ $instructor->detail->yearsOfExperience ?? 'N/A' }}</p>
                </div>
              </div>

              <div class="info-section">
                <label>Bio</label>
                <p>{{ $instructor->detail->bio ?? 'No bio provided' }}</p>
              </div>

              @if($instructor->detail && $instructor->detail->cv)
              <div class="info-section">
                <label>CV / Credentials</label>
                <div class="file-list">
                  <div class="file-item">
                    <i class="fas fa-file-pdf"></i>
                    <a href="{{ Storage::url($instructor->detail->cv) }}" target="_blank" style="color: inherit; text-decoration: none;">
                      <span>{{ basename($instructor->detail->cv) }}</span>
                    </a>
                  </div>
                </div>
              </div>
              @endif
            </div>

            <div class="card-footer">
              <div class="action-buttons" style="width: 100%; display: flex; gap: 10px; justify-content: flex-end;">
                <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                  @csrf
                  <input type="hidden" name="status" value="rejected">
                  <button type="submit" class="btn-reject" onclick="return confirm('Yakin ingin reject instructor ini?')">
                    <i class="fas fa-times"></i> Reject
                  </button>
                </form>
                <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                  @csrf
                  <input type="hidden" name="status" value="approved">
                  <button type="submit" class="btn-approve" onclick="return confirm('Yakin ingin approve instructor ini?')">
                    <i class="fas fa-check"></i> Approve
                  </button>
                </form>
              </div>
            </div>
          </div>
          @empty
          <div style="text-align: center; padding: 60px 20px; color: #737373;">
            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></i>
            <h3 style="margin-bottom: 8px;">Tidak ada instructor pending</h3>
            <p>Semua instructor sudah di-review</p>
          </div>
          @endforelse
        </div>
      </div>

      <!-- Manage Instructors Tab -->
      <div class="tab-content" id="manage-instructors">
        <header class="header">
          <div class="header-left">
            <h1>Manage Instructors</h1>
            <p class="muted">View and manage all instructors</p>
          </div>
          <div class="header-right">
            <div class="search-box">
              <i class="fas fa-search"></i>
              <input type="text" id="searchInstructor" placeholder="Search instructors..." onkeyup="searchInstructors()">
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

        @if(session('success'))
          <div style="background:#d4edda;border:1px solid #c3e6cb;color:#155724;padding:16px;margin:20px;border-radius:8px;font-weight:500;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div style="background:#f8d7da;border:1px solid #f5c6cb;color:#721c24;padding:16px;margin:20px;border-radius:8px;font-weight:500;">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
          </div>
        @endif

        <div class="table-container">
          <table class="table" id="instructorTable">
            <thead>
              <tr>
                <th>Instructor</th>
                <th>Email</th>
                <th>Expertise</th>
                <th>Courses</th>
                <th>Students</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($instructors as $instructor)
              <tr>
                <td>
                  <div class="table-user">
                    <div class="table-avatar">{{ strtoupper(substr($instructor->name ?? 'IN', 0, 2)) }}</div>
                    <div>
                      <strong>{{ $instructor->name ?? 'Unknown' }}</strong>
                      <p class="muted">{{ $instructor->created_at->format('M d, Y') }}</p>
                    </div>
                  </div>
                </td>
                <td>{{ $instructor->email }}</td>
                <td>{{ $instructor->detail->expertise ?? 'N/A' }}</td>
                <td>{{ $instructor->courses->count() }}</td>
                <td>
                  @php
                    $totalStudents = $instructor->courses->sum(function($course) {
                      return $course->students->count();
                    });
                  @endphp
                  {{ $totalStudents }}
                </td>
                <td>
                  @if($instructor->detail)
                    @if($instructor->detail->status === 'approved')
                      <span class="status-badge active">Approved</span>
                    @elseif($instructor->detail->status === 'pending')
                      <span class="status-badge pending">Pending</span>
                    @else
                      <span class="status-badge suspended">Rejected</span>
                    @endif
                  @else
                    <span class="status-badge suspended">No Detail</span>
                  @endif
                </td>
                <td>
                  <div class="action-btns">
                    @if($instructor->detail)
                      @if($instructor->detail->status === 'approved')
                        <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                          @csrf
                          <input type="hidden" name="status" value="rejected">
                          <button type="submit" class="action-btn" title="Suspend" onclick="return confirm('Yakin ingin suspend instructor ini?')" style="background:none;border:none;cursor:pointer;">
                            <i class="fas fa-ban"></i>
                          </button>
                        </form>
                      @elseif($instructor->detail->status === 'pending')
                        <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                          @csrf
                          <input type="hidden" name="status" value="approved">
                          <button type="submit" class="action-btn" title="Approve" onclick="return confirm('Yakin ingin approve instructor ini?')" style="background:none;border:none;cursor:pointer;">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                        <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                          @csrf
                          <input type="hidden" name="status" value="rejected">
                          <button type="submit" class="action-btn" title="Reject" onclick="return confirm('Yakin ingin reject instructor ini?')" style="background:none;border:none;cursor:pointer;">
                            <i class="fas fa-times"></i>
                          </button>
                        </form>
                      @else
                        <form action="{{ route('admin.instructor.updateStatus', $instructor->id) }}" method="POST" style="display: inline;">
                          @csrf
                          <input type="hidden" name="status" value="approved">
                          <button type="submit" class="action-btn" title="Activate" onclick="return confirm('Yakin ingin activate instructor ini?')" style="background:none;border:none;cursor:pointer;">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                      @endif
                    @endif
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: #737373;">
                  <i class="fas fa-inbox" style="font-size: 48px; opacity: 0.5; margin-bottom: 16px;"></i>
                  <p>Tidak ada instructor</p>
                </td>
              </tr>
              @endforelse
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

    // Search Instructors Function
    function searchInstructors() {
      const input = document.getElementById('searchInstructor');
      const filter = input.value.toLowerCase();
      const table = document.getElementById('instructorTable');
      const tr = table.getElementsByTagName('tr');

      for (let i = 1; i < tr.length; i++) {
        const tdName = tr[i].getElementsByTagName('td')[0];
        const tdEmail = tr[i].getElementsByTagName('td')[1];
        const tdExpertise = tr[i].getElementsByTagName('td')[2];
        
        if (tdName || tdEmail || tdExpertise) {
          const nameValue = tdName.textContent || tdName.innerText;
          const emailValue = tdEmail.textContent || tdEmail.innerText;
          const expertiseValue = tdExpertise.textContent || tdExpertise.innerText;
          
          if (nameValue.toLowerCase().indexOf(filter) > -1 || 
              emailValue.toLowerCase().indexOf(filter) > -1 ||
              expertiseValue.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = '';
          } else {
            tr[i].style.display = 'none';
          }
        }
      }
    }
  </script>
</body>
</html>