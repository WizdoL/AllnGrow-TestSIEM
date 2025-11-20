<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Development Fundamentals - Learning</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/coursesDetail/courses-detail-dark.css') }}">
</head>
<body>
  <!-- Top Navbar -->
  <nav class="top-navbar">
    <div class="nav-left">
      <button class="btn-back">
        <i class="fas fa-arrow-left"></i>
      </button>
      <div class="course-info">
        <h1>Web Development Fundamentals</h1>
        <p class="course-subtitle">By Dr. Sarah Johnson</p>
      </div>
    </div>
    <div class="nav-right">
      <div class="progress-info">
        <div class="progress-circle">
          <svg viewBox="0 0 36 36">
            <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
            <path class="circle-progress" stroke-dasharray="65, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"></path>
          </svg>
          <span class="progress-text">65%</span>
        </div>
        <span class="progress-label">Progress</span>
      </div>
      <div class="user-avatar">AR</div>
    </div>
  </nav>

  <div class="learning-container">
    <!-- Sidebar - Course Content -->
    <aside class="content-sidebar">
      <div class="sidebar-header">
        <h3>Course Content</h3>
        <p class="content-progress">16 of 24 completed</p>
      </div>

      <!-- Chapter 1 -->
      <div class="chapter-section">
        <div class="chapter-header">
          <div class="chapter-title">
            <i class="fas fa-book-open"></i>
            <span>Chapter 1: Introduction</span>
          </div>
          <span class="chapter-duration">45 min</span>
        </div>
        <div class="lessons-list">
          <div class="lesson-item completed">
            <div class="lesson-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Welcome to the Course</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 5:30
              </span>
            </div>
          </div>
          <div class="lesson-item completed">
            <div class="lesson-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">What is Web Development?</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 8:45
              </span>
            </div>
          </div>
          <div class="lesson-item completed">
            <div class="lesson-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Tools & Setup</span>
              <span class="lesson-meta">
                <i class="fas fa-file-alt"></i> Reading
              </span>
            </div>
          </div>
          <div class="lesson-item completed">
            <div class="lesson-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Quiz: Introduction</span>
              <span class="lesson-meta">
                <i class="fas fa-question-circle"></i> 5 questions
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Chapter 2 -->
      <div class="chapter-section active">
        <div class="chapter-header">
          <div class="chapter-title">
            <i class="fas fa-book-open"></i>
            <span>Chapter 2: HTML Fundamentals</span>
          </div>
          <span class="chapter-duration">2h 15min</span>
        </div>
        <div class="lessons-list">
          <div class="lesson-item completed">
            <div class="lesson-icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Introduction to HTML</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 10:30
              </span>
            </div>
          </div>
          <div class="lesson-item active">
            <div class="lesson-icon">
              <i class="fas fa-play-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">HTML Document Structure</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 15:45
              </span>
            </div>
          </div>
          <div class="lesson-item">
            <div class="lesson-icon">
              <i class="fas fa-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Text Elements & Formatting</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 22:30
              </span>
            </div>
          </div>
          <div class="lesson-item">
            <div class="lesson-icon">
              <i class="fas fa-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Links and Navigation</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 18:20
              </span>
            </div>
          </div>
          <div class="lesson-item">
            <div class="lesson-icon">
              <i class="fas fa-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Working with Images</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 16:45
              </span>
            </div>
          </div>
          <div class="lesson-item">
            <div class="lesson-icon">
              <i class="fas fa-circle"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Practice: Build a Page</span>
              <span class="lesson-meta">
                <i class="fas fa-code"></i> Exercise
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Chapter 3 -->
      <div class="chapter-section">
        <div class="chapter-header">
          <div class="chapter-title">
            <i class="fas fa-book"></i>
            <span>Chapter 3: CSS Styling</span>
          </div>
          <span class="chapter-duration">3h 30min</span>
        </div>
        <div class="lessons-list">
          <div class="lesson-item locked">
            <div class="lesson-icon">
              <i class="fas fa-lock"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">Introduction to CSS</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 12:00
              </span>
            </div>
          </div>
          <div class="lesson-item locked">
            <div class="lesson-icon">
              <i class="fas fa-lock"></i>
            </div>
            <div class="lesson-content">
              <span class="lesson-title">CSS Selectors</span>
              <span class="lesson-meta">
                <i class="fas fa-play-circle"></i> 16:30
              </span>
            </div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Learning Area -->
    <main class="learning-main">
      <!-- Video Player Section -->
      <section class="video-section">
        <div class="video-container">
          <div class="video-player">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </section>

      <!-- Lesson Navigation -->
      <div class="lesson-navigation">
        <button class="nav-btn prev">
          <i class="fas fa-chevron-left"></i> Previous Lesson
        </button>
        <button class="btn-mark-complete">
          <i class="fas fa-check"></i> Mark as Complete
        </button>
        <button class="nav-btn next">
          Next Lesson <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Lesson Content Tabs -->
      <div class="content-tabs">
        <button class="tab active" data-tab="overview">Overview</button>
        <button class="tab" data-tab="notes">Notes</button>
        <button class="tab" data-tab="resources">Resources</button>
        <button class="tab" data-tab="qa">Q&A</button>
      </div>

      <!-- Tab Content -->
      <div class="tab-content-container">
        <!-- Overview Tab -->
        <div class="tab-panel active" id="overview">
          <div class="lesson-header">
            <h2>HTML Document Structure</h2>
            <div class="lesson-meta-info">
              <span><i class="fas fa-clock"></i> 15 minutes</span>
              <span><i class="fas fa-eye"></i> 324 views</span>
              <span><i class="fas fa-calendar"></i> Updated Nov 2024</span>
            </div>
          </div>

          <div class="lesson-description">
            <h3>What You'll Learn</h3>
            <p>In this lesson, you'll understand the basic structure of an HTML document and how different elements work together to create a web page.</p>
            
            <h4>Key Topics Covered:</h4>
            <ul>
              <li>The DOCTYPE declaration</li>
              <li>HTML root element</li>
              <li>Head section and metadata</li>
              <li>Body section and content</li>
              <li>Proper nesting and indentation</li>
            </ul>
          </div>

          <div class="lesson-content-section">
            <h3>Understanding HTML Document Structure</h3>
            
            <p>Every HTML document follows a standard structure that browsers can understand and render properly. Let's break down each component:</p>

            <h4>1. The DOCTYPE Declaration</h4>
            <p>The DOCTYPE tells the browser which version of HTML the page is written in. For HTML5, we use:</p>
            
            <div class="code-block">
              <div class="code-header">
                <span>HTML</span>
                <button class="btn-copy"><i class="fas fa-copy"></i> Copy</button>
              </div>
              <pre><code>&lt;!DOCTYPE html&gt;</code></pre>
            </div>

            <h4>2. The HTML Root Element</h4>
            <p>The <code>&lt;html&gt;</code> element is the root of your HTML document. It wraps all other elements:</p>
            
            <div class="code-block">
              <div class="code-header">
                <span>HTML</span>
                <button class="btn-copy"><i class="fas fa-copy"></i> Copy</button>
              </div>
              <pre><code>&lt;html lang="en"&gt;
  &lt;!-- All content goes here --&gt;
&lt;/html&gt;</code></pre>
            </div>

            <h4>3. The Head Section</h4>
            <p>The <code>&lt;head&gt;</code> contains metadata about your document:</p>
            
            <div class="code-block">
              <div class="code-header">
                <span>HTML</span>
                <button class="btn-copy"><i class="fas fa-copy"></i> Copy</button>
              </div>
              <pre><code>&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;My First Web Page&lt;/title&gt;
&lt;/head&gt;</code></pre>
            </div>

            <h4>4. The Body Section</h4>
            <p>The <code>&lt;body&gt;</code> contains all the visible content of your web page:</p>
            
            <div class="code-block">
              <div class="code-header">
                <span>HTML</span>
                <button class="btn-copy"><i class="fas fa-copy"></i> Copy</button>
              </div>
              <pre><code>&lt;body&gt;
  &lt;h1&gt;Welcome to My Website&lt;/h1&gt;
  &lt;p&gt;This is my first paragraph.&lt;/p&gt;
&lt;/body&gt;</code></pre>
            </div>

            <div class="info-box">
              <div class="info-icon">
                <i class="fas fa-lightbulb"></i>
              </div>
              <div class="info-content">
                <h5>Pro Tip</h5>
                <p>Always use proper indentation in your HTML code. It makes your code more readable and easier to debug!</p>
              </div>
            </div>

            <h4>5. Complete Example</h4>
            <p>Here's a complete HTML document structure:</p>
            
            <div class="code-block">
              <div class="code-header">
                <span>HTML</span>
                <button class="btn-copy"><i class="fas fa-copy"></i> Copy</button>
              </div>
              <pre><code>&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
  &lt;title&gt;My First Web Page&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;h1&gt;Hello, World!&lt;/h1&gt;
  &lt;p&gt;This is my first web page.&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
            </div>

            <div class="image-container">
              <img src="https://via.placeholder.com/800x400/667eea/ffffff?text=HTML+Document+Structure+Diagram" alt="HTML Structure">
              <p class="image-caption">Figure 1: Visual representation of HTML document structure</p>
            </div>

            <h3>Practice Exercise</h3>
            <p>Now it's your turn! Try creating a simple HTML document with the following requirements:</p>
            <ol>
              <li>Add a proper DOCTYPE declaration</li>
              <li>Include a title in the head section</li>
              <li>Add a heading and two paragraphs in the body</li>
              <li>Use proper indentation</li>
            </ol>

            <div class="warning-box">
              <div class="warning-icon">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
              <div class="warning-content">
                <h5>Common Mistake</h5>
                <p>Don't forget to close your tags! Every opening tag needs a closing tag (except for self-closing tags like &lt;img&gt; and &lt;br&gt;).</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Notes Tab -->
        <div class="tab-panel" id="notes">
          <div class="notes-container">
            <div class="notes-header">
              <h3>My Notes</h3>
              <button class="btn-add-note">
                <i class="fas fa-plus"></i> Add Note
              </button>
            </div>
            
            <div class="notes-list">
              <div class="note-item">
                <div class="note-time">5:30</div>
                <div class="note-content">
                  <p>Remember: DOCTYPE declaration is case-insensitive but best practice is to use uppercase</p>
                  <div class="note-actions">
                    <button class="btn-note-action"><i class="fas fa-edit"></i></button>
                    <button class="btn-note-action"><i class="fas fa-trash"></i></button>
                  </div>
                </div>
              </div>
              
              <div class="note-item">
                <div class="note-time">12:15</div>
                <div class="note-content">
                  <p>The lang attribute in html tag helps screen readers and search engines</p>
                  <div class="note-actions">
                    <button class="btn-note-action"><i class="fas fa-edit"></i></button>
                    <button class="btn-note-action"><i class="fas fa-trash"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Resources Tab -->
        <div class="tab-panel" id="resources">
          <div class="resources-container">
            <h3>Downloadable Resources</h3>
            
            <div class="resource-list">
              <div class="resource-item">
                <div class="resource-icon">
                  <i class="fas fa-file-pdf"></i>
                </div>
                <div class="resource-info">
                  <h4>HTML Document Structure Cheat Sheet</h4>
                  <p>PDF • 2.5 MB</p>
                </div>
                <button class="btn-download">
                  <i class="fas fa-download"></i> Download
                </button>
              </div>

              <div class="resource-item">
                <div class="resource-icon">
                  <i class="fas fa-file-code"></i>
                </div>
                <div class="resource-info">
                  <h4>HTML Template Files</h4>
                  <p>ZIP • 1.2 MB</p>
                </div>
                <button class="btn-download">
                  <i class="fas fa-download"></i> Download
                </button>
              </div>

              <div class="resource-item">
                <div class="resource-icon">
                  <i class="fas fa-link"></i>
                </div>
                <div class="resource-info">
                  <h4>MDN HTML Documentation</h4>
                  <p>External Link</p>
                </div>
                <button class="btn-download">
                  <i class="fas fa-external-link-alt"></i> Visit
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Q&A Tab -->
        <div class="tab-panel" id="qa">
          <div class="qa-container">
            <div class="qa-header">
              <h3>Questions & Answers</h3>
              <button class="btn-ask-question">
                <i class="fas fa-question-circle"></i> Ask a Question
              </button>
            </div>

            <div class="qa-list">
              <div class="qa-item">
                <div class="qa-user">
                  <div class="qa-avatar">JD</div>
                  <div class="qa-user-info">
                    <strong>John Doe</strong>
                    <span>2 days ago</span>
                  </div>
                </div>
                <div class="qa-question">
                  <h4>Do I always need to include the viewport meta tag?</h4>
                  <p>I noticed some websites don't have it. Is it really necessary?</p>
                </div>
                <div class="qa-answer">
                  <div class="answer-badge">Instructor</div>
                  <p>Yes, the viewport meta tag is essential for responsive design. It tells the browser how to handle the page's dimensions and scaling on different devices. Without it, your site may not display properly on mobile devices.</p>
                </div>
                <div class="qa-stats">
                  <button class="qa-action"><i class="fas fa-thumbs-up"></i> 12</button>
                  <button class="qa-action"><i class="fas fa-reply"></i> Reply</button>
                </div>
              </div>

              <div class="qa-item">
                <div class="qa-user">
                  <div class="qa-avatar">MK</div>
                  <div class="qa-user-info">
                    <strong>Maria Klein</strong>
                    <span>1 week ago</span>
                  </div>
                </div>
                <div class="qa-question">
                  <h4>Can I have multiple body tags in one HTML document?</h4>
                  <p>Just curious about this...</p>
                </div>
                <div class="qa-answer">
                  <div class="answer-badge">Instructor</div>
                  <p>No, you should only have one &lt;body&gt; tag per HTML document. Having multiple body tags will cause validation errors and unpredictable browser behavior.</p>
                </div>
                <div class="qa-stats">
                  <button class="qa-action"><i class="fas fa-thumbs-up"></i> 8</button>
                  <button class="qa-action"><i class="fas fa-reply"></i> Reply</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Tab switching for main content tabs
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

    // Sidebar lesson navigation
    const lessonItems = document.querySelectorAll('.lesson-item');
    
    lessonItems.forEach((item, index) => {
      item.addEventListener('click', function() {
        // Check if lesson is locked
        if (this.classList.contains('locked')) {
          alert('This lesson is locked. Please complete previous lessons first.');
          return;
        }

        // Remove active class from all lessons
        lessonItems.forEach(lesson => lesson.classList.remove('active'));
        
        // Add active class to clicked lesson
        this.classList.add('active');
        
        // Update main content based on lesson
        updateLessonContent(this);
        
        // Scroll to top of main content
        document.querySelector('.learning-main').scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    });

    // Chapter accordion functionality
    const chapterHeaders = document.querySelectorAll('.chapter-header');
    
    chapterHeaders.forEach(header => {
      header.addEventListener('click', function() {
        const section = this.parentElement;
        const lessonsList = section.querySelector('.lessons-list');
        
        // Toggle active class
        section.classList.toggle('active');
        
        // Toggle lessons visibility
        if (section.classList.contains('active')) {
          lessonsList.style.maxHeight = lessonsList.scrollHeight + 'px';
        } else {
          lessonsList.style.maxHeight = '0';
        }
      });
    });

    // Initialize - Open active chapter by default
    document.querySelectorAll('.chapter-section.active').forEach(section => {
      const lessonsList = section.querySelector('.lessons-list');
      if (lessonsList) {
        lessonsList.style.maxHeight = lessonsList.scrollHeight + 'px';
      }
    });

    // Function to update lesson content
    function updateLessonContent(lessonElement) {
      const lessonTitle = lessonElement.querySelector('.lesson-title').textContent;
      const lessonMeta = lessonElement.querySelector('.lesson-meta').textContent.trim();
      
      // Update video (in real app, this would change the video source)
      console.log('Loading lesson:', lessonTitle);
      
      // Update lesson header title
      document.querySelector('.lesson-header h2').textContent = lessonTitle;
      
      // You can add more content updates here based on lesson data
      // For example, fetch lesson content from API and update the overview tab
    }

    // Mark as complete button
    const markCompleteBtn = document.querySelector('.btn-mark-complete');
    
    markCompleteBtn.addEventListener('click', function() {
      const activeLesson = document.querySelector('.lesson-item.active');
      
      if (activeLesson && !activeLesson.classList.contains('completed')) {
        // Mark lesson as completed
        activeLesson.classList.add('completed');
        activeLesson.classList.remove('active');
        
        // Change icon to checkmark
        const icon = activeLesson.querySelector('.lesson-icon i');
        icon.className = 'fas fa-check-circle';
        
        // Update progress
        updateProgress();
        
        // Move to next lesson
        const nextLesson = getNextLesson(activeLesson);
        if (nextLesson) {
          // Unlock next lesson if it was locked
          nextLesson.classList.remove('locked');
          
          // Auto-navigate to next lesson
          setTimeout(() => {
            nextLesson.click();
          }, 500);
        }
        
        // Show success message
        showNotification('Lesson completed! 🎉');
      }
    });

    // Get next lesson
    function getNextLesson(currentLesson) {
      let nextLesson = currentLesson.nextElementSibling;
      
      // If no next lesson in current chapter, check next chapter
      if (!nextLesson || !nextLesson.classList.contains('lesson-item')) {
        const currentChapter = currentLesson.closest('.chapter-section');
        const nextChapter = currentChapter.nextElementSibling;
        
        if (nextChapter && nextChapter.classList.contains('chapter-section')) {
          const firstLesson = nextChapter.querySelector('.lesson-item');
          return firstLesson;
        }
        return null;
      }
      
      return nextLesson;
    }

    // Update progress percentage
    function updateProgress() {
      const totalLessons = document.querySelectorAll('.lesson-item:not(.locked)').length;
      const completedLessons = document.querySelectorAll('.lesson-item.completed').length;
      const progressPercent = Math.round((completedLessons / totalLessons) * 100);
      
      // Update progress circle
      const progressText = document.querySelector('.progress-text');
      const progressFill = document.querySelector('.circle-progress');
      
      if (progressText) {
        progressText.textContent = progressPercent + '%';
      }
      
      if (progressFill) {
        const circumference = 2 * Math.PI * 15.9155;
        const offset = circumference - (progressPercent / 100) * circumference;
        progressFill.style.strokeDasharray = `${progressPercent}, 100`;
      }
      
      // Update sidebar progress text
      const contentProgress = document.querySelector('.content-progress');
      if (contentProgress) {
        contentProgress.textContent = `${completedLessons} of ${totalLessons} completed`;
      }
    }

    // Navigation buttons (Previous/Next)
    const prevBtn = document.querySelector('.nav-btn.prev');
    const nextBtn = document.querySelector('.nav-btn.next');
    
    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        const activeLesson = document.querySelector('.lesson-item.active');
        if (activeLesson) {
          const prevLesson = getPreviousLesson(activeLesson);
          if (prevLesson) {
            prevLesson.click();
          }
        }
      });
    }
    
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        const activeLesson = document.querySelector('.lesson-item.active');
        if (activeLesson) {
          const nextLesson = getNextLesson(activeLesson);
          if (nextLesson) {
            nextLesson.click();
          }
        }
      });
    }

    // Get previous lesson
    function getPreviousLesson(currentLesson) {
      let prevLesson = currentLesson.previousElementSibling;
      
      if (!prevLesson || !prevLesson.classList.contains('lesson-item')) {
        const currentChapter = currentLesson.closest('.chapter-section');
        const prevChapter = currentChapter.previousElementSibling;
        
        if (prevChapter && prevChapter.classList.contains('chapter-section')) {
          const lessons = prevChapter.querySelectorAll('.lesson-item');
          return lessons[lessons.length - 1];
        }
        return null;
      }
      
      return prevLesson;
    }

    // Show notification
    function showNotification(message) {
      const notification = document.createElement('div');
      notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: #22c55e;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
      `;
      notification.textContent = message;
      document.body.appendChild(notification);
      
      setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    }

    // Add CSS animations for notifications
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideInRight {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }
      @keyframes slideOutRight {
        from {
          transform: translateX(0);
          opacity: 1;
        }
        to {
          transform: translateX(100%);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);

    // Copy code functionality
    document.querySelectorAll('.btn-copy').forEach(btn => {
      btn.addEventListener('click', () => {
        const code = btn.closest('.code-block').querySelector('code').textContent;
        navigator.clipboard.writeText(code);
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        setTimeout(() => {
          btn.innerHTML = '<i class="fas fa-copy"></i> Copy';
        }, 2000);
      });
    });

    // Initialize progress on page load
    updateProgress();
  </script>
</body>
</html>