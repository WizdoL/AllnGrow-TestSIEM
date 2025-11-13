<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings - AllnGrow</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="css/dashboardInstructor/settingsInstructor.css">
</head>
<body>
  <div class="settings-container">
    <!-- Header -->
    <header class="settings-header">
      <div class="header-left">
        <h1>Settings</h1>
        <p class="muted">Manage your instructor account preferences</p>
      </div>
    </header>

    <!-- Settings Tabs -->
    <div class="settings-tabs">
      <button class="settings-tab active" data-tab="profile">
        <i class="fas fa-user"></i> Profile
      </button>
      <button class="settings-tab" data-tab="account">
        <i class="fas fa-lock"></i> Account & Security
      </button>
      <button class="settings-tab" data-tab="notifications">
        <i class="fas fa-bell"></i> Notifications
      </button>
      <button class="settings-tab" data-tab="payment">
        <i class="fas fa-credit-card"></i> Payment Methods
      </button>
      <button class="settings-tab" data-tab="privacy">
        <i class="fas fa-shield-alt"></i> Privacy
      </button>
    </div>

    <!-- Tab Content: Profile -->
    <div class="tab-panel active" id="profile">
      <div class="settings-card">
        <h2 class="card-title">Profile Information</h2>
        
        <div class="profile-photo-section">
          <div class="current-photo">
            <div class="photo-placeholder">SJ</div>
          </div>
          <div class="photo-actions">
            <button class="btn-secondary">
              <i class="fas fa-camera"></i> Change Photo
            </button>
            <button class="btn-text">Remove</button>
            <p class="help-text">JPG, PNG up to 5MB</p>
          </div>
        </div>

        <form class="settings-form">
          <div class="form-row">
            <div class="form-group">
              <label>First Name *</label>
              <input type="text" value="Sarah" required>
            </div>
            <div class="form-group">
              <label>Last Name *</label>
              <input type="text" value="Johnson" required>
            </div>
          </div>

          <div class="form-group">
            <label>Display Name</label>
            <input type="text" value="Dr. Sarah Johnson">
            <span class="help-text">This name will be displayed publicly</span>
          </div>

          <div class="form-group">
            <label>Professional Title</label>
            <input type="text" value="Senior Web Development Instructor">
          </div>

          <div class="form-group">
            <label>Bio</label>
            <textarea rows="5" placeholder="Tell students about yourself...">Experienced web developer with 10+ years in the industry. Passionate about teaching and helping students achieve their goals.</textarea>
            <span class="help-text">Max 500 characters</span>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>Website</label>
              <input type="url" placeholder="https://yourwebsite.com">
            </div>
            <div class="form-group">
              <label>LinkedIn</label>
              <input type="url" placeholder="https://linkedin.com/in/username">
            </div>
          </div>

          <div class="form-actions">
            <button type="button" class="btn-secondary">Cancel</button>
            <button type="submit" class="btn-primary">
              <i class="fas fa-save"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Tab Content: Account & Security -->
    <div class="tab-panel" id="account">
      <div class="settings-card">
        <h2 class="card-title">Account Information</h2>
        
        <form class="settings-form">
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" value="sarah.johnson@example.com" readonly>
            <span class="help-text">Contact support to change your email</span>
          </div>

          <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" value="+1 (555) 123-4567">
          </div>
        </form>
      </div>

      <div class="settings-card">
        <h2 class="card-title">Change Password</h2>
        
        <form class="settings-form">
          <div class="form-group">
            <label>Current Password *</label>
            <input type="password" required>
          </div>

          <div class="form-group">
            <label>New Password *</label>
            <input type="password" required>
            <span class="help-text">Minimum 8 characters</span>
          </div>

          <div class="form-group">
            <label>Confirm New Password *</label>
            <input type="password" required>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <i class="fas fa-key"></i> Update Password
            </button>
          </div>
        </form>
      </div>

      <div class="settings-card">
        <h2 class="card-title">Two-Factor Authentication</h2>
        <p class="card-description">Add an extra layer of security to your account</p>
        
        <div class="two-factor-status">
          <div class="status-indicator">
            <i class="fas fa-times-circle"></i>
            <span>Two-factor authentication is currently disabled</span>
          </div>
          <button class="btn-primary">Enable 2FA</button>
        </div>
      </div>

      <div class="settings-card danger-zone">
        <h2 class="card-title">Danger Zone</h2>
        
        <div class="danger-action">
          <div>
            <strong>Delete Account</strong>
            <p class="help-text">Permanently delete your account and all associated data</p>
          </div>
          <button class="btn-danger">Delete Account</button>
        </div>
      </div>
    </div>

    <!-- Tab Content: Notifications -->
    <div class="tab-panel" id="notifications">
      <div class="settings-card">
        <h2 class="card-title">Email Notifications</h2>
        
        <div class="notification-group">
          <div class="notification-item">
            <div class="notification-info">
              <strong>Course Enrollments</strong>
              <p>Get notified when a student enrolls in your course</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>New Reviews</strong>
              <p>Get notified when students leave reviews on your courses</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>Course Completions</strong>
              <p>Get notified when students complete your courses</p>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>New Messages</strong>
              <p>Get notified when you receive messages from students</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>Monthly Reports</strong>
              <p>Receive monthly performance reports</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>
        </div>
      </div>

      <div class="settings-card">
        <h2 class="card-title">Push Notifications</h2>
        
        <div class="notification-group">
          <div class="notification-item">
            <div class="notification-info">
              <strong>Desktop Notifications</strong>
              <p>Receive notifications on your desktop</p>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>Mobile Notifications</strong>
              <p>Receive notifications on your mobile device</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>
        </div>
      </div>
    </div>

    <!-- Tab Content: Payment Methods -->
    <div class="tab-panel" id="payment">
      <div class="settings-card">
        <h2 class="card-title">Payout Information</h2>
        <p class="card-description">Choose how you want to receive your earnings</p>
        
        <form class="settings-form">
          <div class="form-group">
            <label>Payout Method *</label>
            <select>
              <option value="">Select payout method</option>
              <option value="paypal" selected>PayPal</option>
              <option value="bank">Bank Transfer</option>
              <option value="stripe">Stripe</option>
            </select>
          </div>

          <div class="form-group">
            <label>PayPal Email *</label>
            <input type="email" value="sarah.johnson@paypal.com" required>
          </div>

          <div class="form-group">
            <label>Minimum Payout Amount</label>
            <select>
              <option value="50">$50</option>
              <option value="100" selected>$100</option>
              <option value="250">$250</option>
              <option value="500">$500</option>
            </select>
            <span class="help-text">You'll receive payouts when your balance reaches this amount</span>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <i class="fas fa-save"></i> Save Payment Info
            </button>
          </div>
        </form>
      </div>

      <div class="settings-card">
        <h2 class="card-title">Tax Information</h2>
        
        <form class="settings-form">
          <div class="form-group">
            <label>Tax ID / VAT Number</label>
            <input type="text" placeholder="Enter your tax ID">
          </div>

          <div class="form-group">
            <label>Country of Residence *</label>
            <select>
              <option value="">Select country</option>
              <option value="us" selected>United States</option>
              <option value="uk">United Kingdom</option>
              <option value="ca">Canada</option>
            </select>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-primary">
              <i class="fas fa-save"></i> Update Tax Info
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Tab Content: Privacy -->
    <div class="tab-panel" id="privacy">
      <div class="settings-card">
        <h2 class="card-title">Privacy Settings</h2>
        
        <div class="notification-group">
          <div class="notification-item">
            <div class="notification-info">
              <strong>Show Profile to Public</strong>
              <p>Allow anyone to view your instructor profile</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>Show Enrollment Numbers</strong>
              <p>Display student enrollment counts on your courses</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>Allow Student Messages</strong>
              <p>Let students send you direct messages</p>
            </div>
            <label class="toggle">
              <input type="checkbox" checked>
              <span class="toggle-slider"></span>
            </label>
          </div>

          <div class="notification-item">
            <div class="notification-info">
              <strong>Show Online Status</strong>
              <p>Display when you're online to students</p>
            </div>
            <label class="toggle">
              <input type="checkbox">
              <span class="toggle-slider"></span>
            </label>
          </div>
        </div>
      </div>

      <div class="settings-card">
        <h2 class="card-title">Data & Privacy</h2>
        
        <div class="data-actions">
          <div class="data-action-item">
            <div>
              <strong>Download Your Data</strong>
              <p>Request a copy of your personal data</p>
            </div>
            <button class="btn-secondary">
              <i class="fas fa-download"></i> Request Data
            </button>
          </div>

          <div class="data-action-item">
            <div>
              <strong>Data Retention</strong>
              <p>Learn how we store and manage your data</p>
            </div>
            <button class="btn-secondary">
              <i class="fas fa-info-circle"></i> Learn More
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Tab switching
    const tabButtons = document.querySelectorAll('.settings-tab');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const targetTab = button.dataset.tab;
        
        // Remove active class from all tabs and panels
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabPanels.forEach(panel => panel.classList.remove('active'));
        
        // Add active class to clicked tab and corresponding panel
        button.classList.add('active');
        document.getElementById(targetTab).classList.add('active');
      });
    });

    // Form submission handlers
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        alert('Settings saved successfully!');
      });
    });
  </script>
</body>
</html>