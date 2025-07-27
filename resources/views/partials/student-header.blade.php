<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

<header class="header">
  <div class="left-side">
    <i class="fa-solid fa-bars" id="hamburger-icon"></i>

    <div class="selected-nav-label" id="selected-nav-label"> 
      Analytics
    </div>
  </div>
    
  <div class="right-side">
    <div class="notif" onclick="toggleNotifications()">
      <i class="fa-solid fa-bell" id="notif-bell"></i>

      <div class="notif-count">
        1
      </div>

      <div class="notif-box" id="notif-box">
        <div class="notif-title">
          Notifications
        </div>

        <div class="notif-container">
          <a href="{{ route('student/documents-hub') }}">
            <div class="notif-group">
              <div class="notif-content"> 
                  <strong>Anthony Formon Ehurango</strong> added a <strong>PSA Birth Certificate</strong> with a deadline of <strong>12/20/2023</strong> to your document deficiencies.
              </div>

              <div class="notif-timestamp">
                5 hours ago
              </div>
            </div>
          </a>

          <a href="{{ route('student/documents-hub') }}">
            <div class="notif-group read">
              <div class="notif-content">
                <strong>Trixie Belnas</strong> has initiated the processing of your request for a <strong>Transcript of Records.</strong>
              </div>

              <div class="notif-timestamp">
                7 days ago
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    @if($user->avatar)
        <img class="avatar" src="{{ asset($user->avatar) }}">
    @else
        <img class="avatar" src="{{ asset('images/anya.jpg') }}">
    @endif

    <div class="profile">
      <div class="name">
        {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}
      </div>

      <div class="role">
        {{ $user->role }}
      </div>
    </div>
  </div>
</header>

  <script>
    function toggleNotifications() {
      var notifBox = document.getElementById('notif-box');
      notifBox.style.display = (notifBox.style.display === 'block') ? 'none' : 'block';
    }
  </script>