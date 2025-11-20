<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $lesson->title }} - {{ $course->title }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/coursesDetail/courses-detail-dark.css') }}">
</head>
<body>
  <!-- Top Navbar -->
  <nav class="top-navbar">
    <div class="nav-left">
      <a href="{{ route('student.view-course', $course->courseID) }}" class="btn-back">
        <i class="fas fa-arrow-left"></i>
      </a>
      <div class="course-info">
        <h1>{{ $course->title }}</h1>
        <p class="course-subtitle">By {{ $course->instructor->detail->fullname ?? $course->instructor->email }}</p>
      </div>
    </div>
    <div class="nav-right">
      <div class="progress-info">
        <div class="progress-circle">
          <svg viewBox="0 0 36 36">
            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
            <path class="circle-progress" stroke-dasharray="{{ $enrollment->pivot->completion }}, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
          </svg>
          <span class="progress-text">{{ $enrollment->pivot->completion }}%</span>
        </div>
        <span class="progress-label">Progress</span>
      </div>
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
    </div>
  </nav>

  <div class="learning-container">
    <!-- Flash Messages -->
    @if(session('success'))
      <div style="position: fixed; top: 80px; right: 20px; z-index: 1000; padding: 1rem 1.5rem; border-radius: 8px; background: #0d3b0d; border: 1px solid #1a5a1a; color: #4ade80; max-width: 400px;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div style="position: fixed; top: 80px; right: 20px; z-index: 1000; padding: 1rem 1.5rem; border-radius: 8px; background: #3b0d0d; border: 1px solid #5a1a1a; color: #f87171; max-width: 400px;">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
      </div>
    @endif

    @if(session('info'))
      <div style="position: fixed; top: 80px; right: 20px; z-index: 1000; padding: 1rem 1.5rem; border-radius: 8px; background: #0d2b3b; border: 1px solid #1a4a5a; color: #60a5fa; max-width: 400px;">
        <i class="fas fa-info-circle"></i> {{ session('info') }}
      </div>
    @endif

    <!-- Sidebar - Course Content -->
    <aside class="content-sidebar">
      <div class="sidebar-header">
        <h3>Course Content</h3>
        <p class="content-progress">{{ $completedLessons }} of {{ $totalLessons }} completed</p>
      </div>

      @foreach($course->chapters as $chapter)
        <div class="chapter-section {{ $chapter->lessons->contains('id', $lesson->id) ? 'active' : '' }}">
          <div class="chapter-header">
            <div class="chapter-title">
              <i class="fas fa-book-open"></i>
              <span>{{ $chapter->title }}</span>
            </div>
            <span class="chapter-duration">{{ $chapter->lessons->count() }} materi</span>
          </div>
          <div class="lessons-list" style="{{ $chapter->lessons->contains('id', $lesson->id) ? 'max-height: 1000px;' : '' }}">
            @foreach($chapter->lessons as $chapterLesson)
              <div class="lesson-item {{ $chapterLesson->id == $lesson->id ? 'active' : '' }} {{ in_array($chapterLesson->id, $completedLessonIds ?? []) ? 'completed' : '' }}">
                <div class="lesson-icon">
                  @if(in_array($chapterLesson->id, $completedLessonIds ?? []))
                    <i class="fas fa-check-circle"></i>
                  @elseif($chapterLesson->id == $lesson->id)
                    <i class="fas fa-play-circle"></i>
                  @else
                    <i class="fas fa-circle"></i>
                  @endif
                </div>
                <a href="{{ route('student.view-lesson', [$course->courseID, $chapterLesson->id]) }}" class="lesson-content" style="text-decoration: none; color: inherit;">
                  <span class="lesson-title">{{ $chapterLesson->title }}</span>
                  <span class="lesson-meta">
                    @if($chapterLesson->video_url)
                      <i class="fas fa-play-circle"></i>
                    @endif
                    @if($chapterLesson->duration)
                      {{ $chapterLesson->formatted_duration }}
                    @endif
                  </span>
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endforeach
    </aside>

    <!-- Main Learning Area -->
    <main class="learning-main">
      <!-- Video Section -->
      @if($lesson->video_url)
        <section class="video-section">
          <div class="video-container">
            <div class="video-player">
              @php
                $youtubeRegex = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
                preg_match($youtubeRegex, $lesson->video_url, $match);
              @endphp
              @if(isset($match[1]))
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $match[1] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              @else
                <video controls style="width: 100%; height: 100%;">
                  <source src="{{ $lesson->video_url }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              @endif
            </div>
          </div>
        </section>
      @endif

      <!-- Lesson Navigation (Prev/Next only) -->
      <div class="lesson-navigation">
        @if($prevLesson)
          <a href="{{ route('student.view-lesson', [$course->courseID, $prevLesson->id]) }}" class="nav-btn prev">
            <i class="fas fa-chevron-left"></i> Previous
          </a>
        @else
          <span></span>
        @endif

        @if($nextLesson)
          <a href="{{ route('student.view-lesson', [$course->courseID, $nextLesson->id]) }}" class="nav-btn next">
            Next <i class="fas fa-chevron-right"></i>
          </a>
        @else
          <span></span>
        @endif
      </div>

      <!-- Content Tabs -->
      <div class="content-tabs">
        <button class="tab active" data-tab="overview">Overview</button>
        <button class="tab" data-tab="resources">Resources</button>
      </div>

      <!-- Tab Content -->
      <div class="tab-content-container">
        <!-- Overview Tab -->
        <div class="tab-panel active" id="overview">
          <div class="lesson-header">
            <h2>{{ $lesson->title }}</h2>
            <div class="lesson-meta-info">
              @if($lesson->duration)
                <span><i class="fas fa-clock"></i> {{ $lesson->formatted_duration }}</span>
              @endif
              @if($lesson->is_free)
                <span><i class="fas fa-unlock"></i> Free Preview</span>
              @endif
            </div>
          </div>

          @if($lesson->content)
            <div class="lesson-description">
              <h3>Lesson Content</h3>
              <div style="line-height: 1.8;">
                {!! nl2br(e($lesson->content)) !!}
              </div>
            </div>
          @endif

          @if(!$lesson->video_url && !$lesson->content)
            <div class="lesson-description">
              <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                <p>No content available for this lesson yet.</p>
              </div>
            </div>
          @endif
        </div>

        <!-- Resources Tab -->
        <div class="tab-panel" id="resources">
          <div class="resources-container">
            <h3>Downloadable Resources</h3>

            @if($lesson->fileUpload)
              <div class="resource-list">
                <div class="resource-item">
                  <div class="resource-icon">
                    <i class="fas fa-file-download"></i>
                  </div>
                  <div class="resource-info">
                    <h4>{{ basename($lesson->fileUpload) }}</h4>
                    <p>Lesson Attachment</p>
                  </div>
                  <a href="{{ Storage::url($lesson->fileUpload) }}" target="_blank" class="btn-download">
                    <i class="fas fa-download"></i> Download
                  </a>
                </div>
              </div>
            @else
              <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                <p>No resources available for this lesson.</p>
              </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Mark as Complete Section -->
      <div style="margin-top: 2rem; padding: 1.5rem; background: var(--surface); border: 1px solid var(--border); border-radius: 12px;">
        @if(in_array($lesson->id, $completedLessonIds ?? []))
          <div style="text-align: center;">
            <div style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 1rem 2rem; background: rgba(34, 197, 94, 0.1); border: 1px solid var(--success); border-radius: 8px; color: var(--success);">
              <i class="fas fa-check-circle" style="font-size: 1.5rem;"></i>
              <div style="text-align: left;">
                <div style="font-weight: 600; font-size: 1rem;">Lesson Completed!</div>
                <div style="font-size: 0.8rem; opacity: 0.8;">You've finished this lesson</div>
              </div>
            </div>
            @if($nextLesson)
              <div style="margin-top: 1rem;">
                <a href="{{ route('student.view-lesson', [$course->courseID, $nextLesson->id]) }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: var(--primary); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.2s;">
                  Continue to Next Lesson <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            @endif
          </div>
        @else
          <div style="text-align: center;">
            <p style="color: var(--text-muted); margin-bottom: 1rem; font-size: 0.9rem;">
              Finished studying this lesson? Mark it as complete to track your progress.
            </p>
            <form method="POST" action="{{ route('student.mark-lesson-complete', [$course->courseID, $lesson->id]) }}" style="display: inline;">
              @csrf
              <button type="submit" style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 1rem 2rem; background: var(--success); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s;">
                <i class="fas fa-check-circle"></i> Mark as Complete
              </button>
            </form>
            @if($nextLesson)
              <p style="color: var(--text-muted); margin-top: 0.75rem; font-size: 0.8rem;">
                <i class="fas fa-info-circle"></i> You'll automatically go to the next lesson after marking complete
              </p>
            @endif
          </div>
        @endif
      </div>
    </main>
  </div>

  <script>
    // Tab switching
    const tabs = document.querySelectorAll('.tab');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const targetTab = tab.dataset.tab;

        tabs.forEach(t => t.classList.remove('active'));
        tabPanels.forEach(p => p.classList.remove('active'));

        tab.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
      });
    });

    // Chapter accordion
    const chapterHeaders = document.querySelectorAll('.chapter-header');

    chapterHeaders.forEach(header => {
      header.addEventListener('click', function() {
        const section = this.parentElement;
        const lessonsList = section.querySelector('.lessons-list');

        section.classList.toggle('active');

        if (section.classList.contains('active')) {
          lessonsList.style.maxHeight = lessonsList.scrollHeight + 'px';
        } else {
          lessonsList.style.maxHeight = '0';
        }
      });
    });

    // Initialize active chapters
    document.querySelectorAll('.chapter-section.active').forEach(section => {
      const lessonsList = section.querySelector('.lessons-list');
      if (lessonsList) {
        lessonsList.style.maxHeight = lessonsList.scrollHeight + 'px';
      }
    });

    // Auto-dismiss flash messages
    setTimeout(() => {
      document.querySelectorAll('[style*="position: fixed"][style*="top: 80px"]').forEach(alert => {
        alert.style.transition = 'opacity 0.3s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
      });
    }, 5000);
  </script>
</body>
</html>
