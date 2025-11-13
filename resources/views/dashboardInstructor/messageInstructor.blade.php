<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardInstructor/messageInstructor.css">
</head>
<body>
  <div class="messages-container">
    <!-- Sidebar: Conversation List -->
    <aside class="conversations-sidebar">
      <div class="sidebar-header">
        <h2>Messages</h2>
        <button class="icon-btn" title="New Message">
          <i class="fas fa-edit"></i>
        </button>
      </div>

      <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search messages..." id="searchInput">
      </div>

      <div class="conversation-filters">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="unread">Unread</button>
        <button class="filter-btn" data-filter="archived">Archived</button>
      </div>

      <div class="conversations-list">
        <!-- Conversation Item 1 -->
        <div class="conversation-item active" data-user="ahmad">
          <div class="conversation-avatar">AR</div>
          <div class="conversation-info">
            <div class="conversation-header">
              <h4>Ahmad Rizki</h4>
              <span class="time">2m ago</span>
            </div>
            <p class="last-message">Thank you for the explanation! I understand now.</p>
          </div>
          <span class="unread-badge">2</span>
        </div>

        <!-- Conversation Item 2 -->
        <div class="conversation-item" data-user="maria">
          <div class="conversation-avatar">MK</div>
          <div class="conversation-info">
            <div class="conversation-header">
              <h4>Maria Klein</h4>
              <span class="time">1h ago</span>
            </div>
            <p class="last-message">Could you please review my project submission?</p>
          </div>
        </div>

        <!-- Conversation Item 3 -->
        <div class="conversation-item" data-user="john">
          <div class="conversation-avatar">JD</div>
          <div class="conversation-info">
            <div class="conversation-header">
              <h4>John Doe</h4>
              <span class="time">3h ago</span>
            </div>
            <p class="last-message">I'm having trouble with the React assignment</p>
          </div>
          <span class="unread-badge">1</span>
        </div>

        <!-- Conversation Item 4 -->
        <div class="conversation-item" data-user="sarah">
          <div class="conversation-avatar">SL</div>
          <div class="conversation-info">
            <div class="conversation-header">
              <h4>Sarah Lee</h4>
              <span class="time">Yesterday</span>
            </div>
            <p class="last-message">Great course! Really enjoying it so far.</p>
          </div>
        </div>

        <!-- Conversation Item 5 -->
        <div class="conversation-item" data-user="mike">
          <div class="conversation-avatar">MT</div>
          <div class="conversation-info">
            <div class="conversation-header">
              <h4>Mike Thompson</h4>
              <span class="time">2 days ago</span>
            </div>
            <p class="last-message">When will the next module be available?</p>
          </div>
        </div>

        <!-- Conversation Item 6 -->
        <div class="conversation-item" data-user="emma">
          <div class="conversation-avatar">EW</div>
          <div class="conversation-info">
            <div class="conversation-header">
              <h4>Emma Wilson</h4>
              <span class="time">3 days ago</span>
            </div>
            <p class="last-message">Thank you for the quick response!</p>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="chat-area">
      <div class="chat-header">
        <div class="chat-user-info">
          <div class="chat-avatar">AR</div>
          <div>
            <h3>Ahmad Rizki</h3>
            <p class="status">
              <span class="status-dot online"></span>
              Active now
            </p>
          </div>
        </div>
        <div class="chat-actions">
          <button class="icon-btn" title="Call">
            <i class="fas fa-phone"></i>
          </button>
          <button class="icon-btn" title="Video Call">
            <i class="fas fa-video"></i>
          </button>
          <button class="icon-btn" title="More Options">
            <i class="fas fa-ellipsis-v"></i>
          </button>
        </div>
      </div>

      <div class="messages-area" id="messagesArea">
        <!-- Date Separator -->
        <div class="date-separator">
          <span>Today</span>
        </div>

        <!-- Received Message -->
        <div class="message received">
          <div class="message-avatar">AR</div>
          <div class="message-content">
            <div class="message-bubble">
              Hello Dr. Sarah! I have a question about the JavaScript closures lesson. Could you help me understand it better?
            </div>
            <span class="message-time">10:30 AM</span>
          </div>
        </div>

        <!-- Sent Message -->
        <div class="message sent">
          <div class="message-content">
            <div class="message-bubble">
              Hi Ahmad! Of course, I'd be happy to help. What specific part of closures are you finding confusing?
            </div>
            <span class="message-time">10:32 AM</span>
          </div>
        </div>

        <!-- Received Message -->
        <div class="message received">
          <div class="message-avatar">AR</div>
          <div class="message-content">
            <div class="message-bubble">
              I'm not quite understanding how the inner function can still access variables from the outer function even after the outer function has returned. Could you explain that?
            </div>
            <span class="message-time">10:35 AM</span>
          </div>
        </div>

        <!-- Sent Message -->
        <div class="message sent">
          <div class="message-content">
            <div class="message-bubble">
              Great question! This is actually one of the most powerful features of JavaScript. Let me explain with an example...
            </div>
            <span class="message-time">10:37 AM</span>
          </div>
        </div>

        <!-- Sent Message with Code -->
        <div class="message sent">
          <div class="message-content">
            <div class="message-bubble">
              <pre><code>function outer() {
  let count = 0;
  return function inner() {
    count++;
    return count;
  }
}</code></pre>
            </div>
            <span class="message-time">10:37 AM</span>
          </div>
        </div>

        <!-- Sent Message -->
        <div class="message sent">
          <div class="message-content">
            <div class="message-bubble">
              The inner function "remembers" the environment it was created in. Even though outer() has finished executing, inner() still has access to count through the closure!
            </div>
            <span class="message-time">10:38 AM</span>
          </div>
        </div>

        <!-- Received Message -->
        <div class="message received">
          <div class="message-avatar">AR</div>
          <div class="message-content">
            <div class="message-bubble">
              Oh! That makes so much more sense now! So the closure is like a "memory" of the outer function's scope?
            </div>
            <span class="message-time">10:40 AM</span>
          </div>
        </div>

        <!-- Sent Message -->
        <div class="message sent">
          <div class="message-content">
            <div class="message-bubble">
              Exactly! That's a perfect way to think about it. You've got it! 🎉
            </div>
            <span class="message-time">10:41 AM</span>
          </div>
        </div>

        <!-- Received Message -->
        <div class="message received">
          <div class="message-avatar">AR</div>
          <div class="message-content">
            <div class="message-bubble">
              Thank you for the explanation! I understand now.
            </div>
            <span class="message-time">10:43 AM</span>
          </div>
        </div>

        <!-- Typing Indicator -->
        <div class="typing-indicator" style="display: none;">
          <div class="message-avatar">AR</div>
          <div class="typing-dots">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>

      <div class="message-input-area">
        <button class="icon-btn" title="Attach File">
          <i class="fas fa-paperclip"></i>
        </button>
        <button class="icon-btn" title="Insert Emoji">
          <i class="fas fa-smile"></i>
        </button>
        <input 
          type="text" 
          placeholder="Type your message..." 
          id="messageInput"
          class="message-input"
        >
        <button class="send-btn" id="sendBtn">
          <i class="fas fa-paper-plane"></i>
        </button>
      </div>
    </main>

    <!-- Empty State (shown when no conversation selected) -->
    <div class="empty-state" style="display: none;">
      <i class="fas fa-comments"></i>
      <h3>Select a conversation</h3>
      <p>Choose a conversation from the list to start messaging</p>
    </div>
  </div>

  <script>
    // Conversation switching
    const conversationItems = document.querySelectorAll('.conversation-item');
    const chatArea = document.querySelector('.chat-area');
    const emptyState = document.querySelector('.empty-state');

    conversationItems.forEach(item => {
      item.addEventListener('click', function() {
        // Remove active class from all items
        conversationItems.forEach(conv => conv.classList.remove('active'));
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Remove unread badge
        const badge = this.querySelector('.unread-badge');
        if (badge) badge.remove();
        
        // Show chat area
        chatArea.style.display = 'flex';
        emptyState.style.display = 'none';
        
        // Update chat header with user info
        const userName = this.querySelector('h4').textContent;
        const userAvatar = this.querySelector('.conversation-avatar').textContent;
        
        document.querySelector('.chat-user-info h3').textContent = userName;
        document.querySelector('.chat-avatar').textContent = userAvatar;
      });
    });

    // Send message
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const messagesArea = document.getElementById('messagesArea');

    function sendMessage() {
      const messageText = messageInput.value.trim();
      
      if (messageText) {
        // Create message element
        const messageDiv = document.createElement('div');
        messageDiv.className = 'message sent';
        
        const currentTime = new Date().toLocaleTimeString('en-US', { 
          hour: 'numeric', 
          minute: '2-digit' 
        });
        
        messageDiv.innerHTML = `
          <div class="message-content">
            <div class="message-bubble">${messageText}</div>
            <span class="message-time">${currentTime}</span>
          </div>
        `;
        
        // Append to messages area
        messagesArea.appendChild(messageDiv);
        
        // Clear input
        messageInput.value = '';
        
        // Scroll to bottom
        messagesArea.scrollTop = messagesArea.scrollHeight;
        
        // Show typing indicator briefly
        setTimeout(() => {
          const typingIndicator = document.querySelector('.typing-indicator');
          typingIndicator.style.display = 'flex';
          messagesArea.scrollTop = messagesArea.scrollHeight;
          
          setTimeout(() => {
            typingIndicator.style.display = 'none';
          }, 2000);
        }, 500);
      }
    }

    sendBtn.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        sendMessage();
      }
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      
      conversationItems.forEach(item => {
        const userName = item.querySelector('h4').textContent.toLowerCase();
        const lastMessage = item.querySelector('.last-message').textContent.toLowerCase();
        
        if (userName.includes(searchTerm) || lastMessage.includes(searchTerm)) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });

    // Filter buttons
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        
        conversationItems.forEach(item => {
          if (filter === 'all') {
            item.style.display = 'flex';
          } else if (filter === 'unread') {
            const hasUnread = item.querySelector('.unread-badge');
            item.style.display = hasUnread ? 'flex' : 'none';
          } else if (filter === 'archived') {
            // For demo purposes, hide all when archived is selected
            item.style.display = 'none';
          }
        });
      });
    });
  </script>
</body>
</html>