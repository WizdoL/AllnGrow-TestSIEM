<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $course->title }} - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/dashboardSiswa/dashboardSiswa.css') }}">
  <style>
    .course-header {
      background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 2rem;
      margin-bottom: 2rem;
    }
    .course-meta {
      display: flex;
      gap: 2rem;
      margin-top: 1rem;
      color: #a3a3a3;
    }
    .course-meta span {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .progress-section {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    .progress-bar-large {
      height: 12px;
      background: #262626;
      border-radius: 6px;
      overflow: hidden;
      margin-top: 0.5rem;
    }
    .progress-bar-large > div {
      height: 100%;
      background: #4ade80;
      transition: width 0.3s;
    }
    .subcourses-section {
      background: #0d0d0d;
      border: 1px solid #262626;
      border-radius: 12px;
      padding: 1.5rem;
    }
    .subcourse-item {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      background: #000;
      border: 1px solid #262626;
      border-radius: 8px;
      margin-bottom: 0.75rem;
      transition: all 0.2s;
      cursor: pointer;
    }
    .subcourse-item:hover {
      border-color: #4ade80;
      transform: translateX(4px);
    }
    .subcourse-number {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: #1a1a1a;
      border-radius: 8px;
      font-weight: 600;
      color: #4ade80;
    }
    .subcourse-content {
      flex: 1;
    }
    .subcourse-title {
      font-weight: 600;
      margin-bottom: 0.25rem;
    }
    .subcourse-desc {
      font-size: 0.9rem;
      color: #a3a3a3;
    }
    .subcourse-duration {
      color: #737373;
      font-size: 0.85rem;
    }
    .video-player {
      width: 100%;
      aspect-ratio: 16/9;
      background: #000;
      border-radius: 8px;
      margin-top: 1rem;
    }
    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1.5rem;
      background: #262626;
      color: #f5f5f5;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.2s;
      border: 1px solid #262626;
    }
    .btn-back:hover {
      background: #1a1a1a;
      border-color: #4ade80;
    }
  </style>
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">AllnGrow</div>
      <nav>
        <a href="{{ route('dashboardSiswa') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('student.my-courses') }}" class="active"><i class="fas fa-book"></i> My Courses</a>
        <a href="{{ route('student.browse-courses') }}"><i class="fas fa-search"></i> Browse Courses</a>
        <a href="{{ route('schedule') }}"><i class="fas fa-calendar"></i> Schedule</a>
        <a href="{{ route('progress') }}"><i class="fas fa-chart-line"></i> Progress</a>
        <a href="{{ route('settings') }}"><i class="fas fa-cog"></i> Settings</a>
        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid #262626;">
          <form method="POST" action="{{ route('student.logout') }}">
            @csrf
            <button type="submit" style="width: 100%; text-align: left; background: none; border: none; color: #f5f5f5; cursor: pointer; font: inherit; padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s; border-radius: 8px;" onmouseover="this.style.background='#1a1a1a'; this.style.color='#ef4444'" onmouseout="this.style.background=''; this.style.color='#f5f5f5'">
              <i class="fas fa-sign-out-alt"></i> Logout
            </button>
          </form>
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <!-- Header -->
      <header class="header">
        <div class="header-left">
          <a href="{{ route('student.my-courses') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to My Courses
          </a>
        </div>
        <div class="header-right">
          <button class="icon-btn"><i class="fas fa-bell"></i></button>
          <div class="user">
            <div class="user-avatar">
              @php
                $name = $student->detail->fullname ?? $student->email;
                $words = explode(' ', $name);
                $initials = '';
                foreach(array_slice($words, 0, 2) as $word) {
                  $initials .= strtoupper(substr($word, 0, 1));
                }
                echo $initials;
              @endphp
            </div>
            <div class="user-info">
              <div class="user-name">{{ $student->detail->fullname ?? 'Student' }}</div>
              <div class="user-role">Student</div>
            </div>
          </div>
        </div>
      </header>

      @if(session('success'))
        <div style="padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; background: #0d3b0d; border: 1px solid #1a5a1a; color: #4ade80;">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div style="padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; background: #3b0d0d; border: 1px solid #5a1a1a; color: #f87171;">
          <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
      @endif

      <!-- Course Header -->
      <div class="course-header">
        <div style="font-size: 0.9rem; color: #4ade80; font-weight: 600; margin-bottom: 0.5rem;">
          {{ $course->category->name ?? 'Uncategorized' }}
        </div>
        <h1 style="font-size: 2rem; margin-bottom: 0.5rem;">{{ $course->title }}</h1>
        <p style="color: #a3a3a3; margin-bottom: 1rem;">{{ $course->description }}</p>
        <div class="course-meta">
          <span>
            <i class="fas fa-user-circle"></i>
            {{ $course->instructor->detail->fullname ?? $course->instructor->email }}
          </span>
          <span>
            <i class="fas fa-book-open"></i>
            {{ $course->subcourses->count() }} Modules
          </span>
          <span>
            <i class="fas fa-clock"></i>
            {{ $course->duration ?? 'Self-paced' }}
          </span>
          <span>
            <i class="fas fa-signal"></i>
            {{ ucfirst($course->level ?? 'beginner') }}
          </span>
        </div>
      </div>

      <!-- Progress Section -->
      <div class="progress-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
          <h2 style="font-size: 1.1rem; font-weight: 600;">Your Progress</h2>
          <span style="font-size: 1.5rem; font-weight: 700; color: #4ade80;">{{ $enrollment->pivot->completion }}%</span>
        </div>
        <div class="progress-bar-large">
          <div style="width: {{ $enrollment->pivot->completion }}%;"></div>
        </div>
        <div style="margin-top: 1rem; color: #a3a3a3; font-size: 0.9rem;">
          @if($enrollment->pivot->completed)
            <i class="fas fa-check-circle" style="color: #4ade80;"></i> Course Completed!
          @else
            Keep learning to complete this course
          @endif
        </div>
      </div>

      <!-- Course Content -->
      <div class="subcourses-section">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 1.5rem;">
          <i class="fas fa-list"></i> Course Content
        </h2>

        @if($course->subcourses->count() > 0)
          @foreach($course->subcourses as $index => $subcourse)
            <div class="subcourse-item" onclick="openSubcourse({{ $subcourse->id }})">
              <div class="subcourse-number">{{ $index + 1 }}</div>
              <div class="subcourse-content">
                <div class="subcourse-title">{{ $subcourse->title }}</div>
                <div class="subcourse-desc">{{ $subcourse->description ?? 'No description available' }}</div>
              </div>
              <div class="subcourse-duration">
                <i class="fas fa-play-circle"></i> 
                @if($subcourse->video_url)
                  Video
                @elseif($subcourse->content)
                  Article
                @else
                  Content
                @endif
              </div>
              <i class="fas fa-chevron-right" style="color: #737373;"></i>
            </div>
          @endforeach
        @else
          <div style="text-align: center; padding: 3rem; color: #737373;">
            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p>No modules available yet. The instructor is still preparing the content.</p>
          </div>
        @endif
      </div>

      <!-- Modal for Subcourse Content -->
      <div id="subcourseModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: #0d0d0d; border: 1px solid #262626; border-radius: 12px; width: 90%; max-width: 1200px; max-height: 90vh; overflow-y: auto;">
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; border-bottom: 1px solid #262626;">
            <h3 id="modalTitle" style="font-size: 1.5rem;">Module Title</h3>
            <button onclick="closeModal()" style="background: none; border: none; color: #f5f5f5; font-size: 1.5rem; cursor: pointer; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: all 0.2s;" onmouseover="this.style.background='#262626'" onmouseout="this.style.background='none'">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div id="modalContent" style="padding: 2rem;">
            <!-- Content will be loaded here -->
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    const subcourses = @json($course->subcourses);

    function openSubcourse(subcourseId) {
      const subcourse = subcourses.find(s => s.id === subcourseId);
      if (!subcourse) return;

      document.getElementById('modalTitle').textContent = subcourse.title;
      
      let content = '';
      
      // Video content
      if (subcourse.video_url) {
        // Check if it's a YouTube URL
        const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
        const match = subcourse.video_url.match(youtubeRegex);
        
        if (match) {
          const videoId = match[1];
          content += `
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 8px;">
              <iframe 
                src="https://www.youtube.com/embed/${videoId}" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
              </iframe>
            </div>
          `;
        } else {
          content += `
            <video controls style="width: 100%; border-radius: 8px;">
              <source src="${subcourse.video_url}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          `;
        }
      }
      
      // Text content
      if (subcourse.content) {
        content += `
          <div style="margin-top: 1.5rem; line-height: 1.8; color: #d4d4d4;">
            ${subcourse.content}
          </div>
        `;
      }
      
      // Description
      if (subcourse.description) {
        content += `
          <div style="margin-top: 1.5rem; padding: 1rem; background: #000; border: 1px solid #262626; border-radius: 8px;">
            <h4 style="margin-bottom: 0.5rem; color: #4ade80;"><i class="fas fa-info-circle"></i> Description</h4>
            <p style="color: #a3a3a3; line-height: 1.6;">${subcourse.description}</p>
          </div>
        `;
      }
      
      if (!subcourse.video_url && !subcourse.content) {
        content = `
          <div style="text-align: center; padding: 3rem; color: #737373;">
            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p>Content not available yet.</p>
          </div>
        `;
      }
      
      document.getElementById('modalContent').innerHTML = content;
      document.getElementById('subcourseModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('subcourseModal').style.display = 'none';
    }

    // Close modal when clicking outside
    document.getElementById('subcourseModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeModal();
      }
    });

    // Auto-dismiss alerts
    setTimeout(() => {
      document.querySelectorAll('[style*="background: #0d3b0d"], [style*="background: #3b0d0d"]').forEach(alert => {
        alert.style.transition = 'opacity 0.3s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
      });
    }, 5000);
  </script>
</body>
</html>
