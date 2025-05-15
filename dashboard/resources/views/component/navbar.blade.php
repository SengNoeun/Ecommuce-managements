
  
  <!-- Icon Library CDNs -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> <!-- Material Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> <!-- Bootstrap Icons -->

  <!-- Favicon (optional, from previous discussion) -->
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body class=" text-gray-800 min-h-screen flex flex-col">
  
  <div class="flex flex-1">
    <aside class="sidebar  text-white shadow-lg z-50" id="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="space-y-2">
          <!-- Dashboard (Material Icons, as in your example) -->
          <li>
            <button type="button" id="sidebar-1" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <i class="material-icons mr-3">dashboard</i>
              Dashboard
            </button>
          </li>
          <!-- Home (Heroicons) -->
          <li>
            <a href="#" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              Home
            </a>
          </li>
             <li>
            <button type="button" id="sidebar-2" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
             Products
            </button>
          </li>
             <li>
            <a href="#" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              Home
            </a>
          </li>
          </li>
            
           <li>
           <button type="button" id="sidebar-3"  class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              Category
           </button>
          </li>
           <li>
            <button type="button" id="sidebar-4" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              Brands
            </button>
          </li>
          <li>
           <button type="button" id="sidebar-5" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
              Sliders
            </button>

          <!-- Settings (Font Awesome) -->
          <li>
            <a href="#" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <i class="fas fa-cog mr-3"></i>
              Settings
            </a>
          </li>

          <!-- Users (Bootstrap Icons) -->
          <li>
            <button id="sidebar-6"  class="flex items-center p-4 hover:bg-gray-700 text-white">
              <i class="bi bi-people mr-3"></i>
              Users
            </button>
          </li>

          <!-- Notifications (Material Icons) -->
          <li>
            <a href="#" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <i class="material-icons mr-3">notifications</i>
              Notifications
            </a>
          </li>

          <!-- Search (Heroicons) -->
          <li>
            <a href="#" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7 7 0 1110 3a7 7 0 016.65 9.65z"></path>
              </svg>
              Search
            </a>
          </li>

          <!-- Profile (Font Awesome) -->
          <li>
            <a href="#" class="flex items-center p-4 hover:bg-gray-700 text-white">
              <i class="fas fa-user mr-3"></i>
              Profile
            </a>
          </li>
        </ul>
      </nav>
    </aside>
      <div id="modalOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="modalContent" class=" ml-64   w-[70%] p-6 overflow-y-auto max-h-[90vh] relative">
            <!-- Loading Indicator -->
            <div id="modalLoading" class="flex flex-col items-center">
                <i class="fas fa-spinner fa-spin text-blue-600 text-3xl"></i>
                <span class="mt-2 text-gray-600">Loading...</span>
            </div>
            <!-- Modal content will be loaded here -->
        </div>
      </div>
  </div>

  <!-- JavaScript for Sidebar Toggle (optional, from your previous code) -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const contentWrapper = document.getElementById('content-wrapper');
      const toggleButton = document.querySelector('[data-widget="pushmenu"]');

      if (toggleButton) {
        toggleButton.addEventListener('click', () => {
          sidebar.classList.toggle('sidebar-open');
          sidebar.classList.toggle('sidebar-hidden');
          contentWrapper.classList.toggle('ml-0');
        });
      }
    });


$(document).ready(function () {
  $('#sidebar-1').click(function () {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.dashboard.index') }}",
      // headers: {
      //   // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Optional for GET
      // },
      beforeSend: function () {
       $('#modalOverlay').removeClass('hidden');
       $('#modalLoading').removeClass('hidden');
      },
      success: function (response) {
        // Update the content area with the response (e.g., HTML or JSON)
        $('body').html(response); // Adjust based on your setup
        console.log('Dashboard loaded successfully');
      },
      error: function (xhr) {
        // Handle errors (e.g., show an alert or message)
        console.error('Error loading dashboard:', xhr.status, xhr.statusText);
        alert('Failed to load dashboard. Please try again.');
      }
    });
  });
   $('#sidebar-2').click(function () {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.products.index') }}",
      // headers: {
      //   // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Optional for GET
      // },
      beforeSend: function () {
              $('#modalOverlay').removeClass('hidden');
              $('#modalLoading').removeClass('hidden');
      
        
      },
      success: function (response) {
        // Update the content area with the response (e.g., HTML or JSON)
        $('body').html(response); // Adjust based on your setup
        console.log('Dashboard loaded successfully');
      },
      error: function (xhr) {
        // Handle errors (e.g., show an alert or message)
        console.error('Error loading dashboard:', xhr.status, xhr.statusText);
        alert('Failed to load dashboard. Please try again.');
      }
    });
  });


  $('#sidebar-3').click(function () {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.categorys.index') }}",
      // headers: {
      //   // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Optional for GET
      // },
      beforeSend: function () {
              $('#modalOverlay').removeClass('hidden');
              $('#modalLoading').removeClass('hidden');
      },
      success: function (response) {
        // Update the content area with the response (e.g., HTML or JSON)
        $('body').html(response); // Adjust based on your setup
        console.log('Dashboard loaded successfully');
      },
      error: function (xhr) {
        // Handle errors (e.g., show an alert or message)
        console.error('Error loading dashboard:', xhr.status, xhr.statusText);
        alert('Failed to load dashboard. Please try again.');
      }
    });
  });
  $('#sidebar-4').click(function () {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.brands.index') }}",
      // headers: {
      //   // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Optional for GET
      // },
      beforeSend: function () {
              $('#modalOverlay').removeClass('hidden');
              $('#modalLoading').removeClass('hidden');
      },
      success: function (response) {
        // Update the content area with the response (e.g., HTML or JSON)
        $('body').html(response); // Adjust based on your setup
        console.log('Dashboard loaded successfully');
      },
      error: function (xhr) {
        // Handle errors (e.g., show an alert or message)
        console.error('Error loading dashboard:', xhr.status, xhr.statusText);
        alert('Failed to load dashboard. Please try again.');
      }
    });
  });
  $('#sidebar-5').click(function () {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.slide.index') }}",
      // headers: {
      //   // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Optional for GET
      // },
      beforeSend: function () {
              $('#modalOverlay').removeClass('hidden');
              $('#modalLoading').removeClass('hidden');

      },
      success: function (response) {
        // Update the content area with the response (e.g., HTML or JSON)
        $('body').html(response); // Adjust based on your setup
        console.log('Dashboard loaded successfully');
      },
      error: function (xhr) {
        // Handle errors (e.g., show an alert or message)
        console.error('Error loading dashboard:', xhr.status, xhr.statusText);
        alert('Failed to load dashboard. Please try again.');
      }
    });
  });
  $('#sidebar-6').click(function () {
    $.ajax({
      type: 'GET',
      url: "{{ route('admin.user.index') }}",
      // headers: {
      //   // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Optional for GET
      // },
      beforeSend: function () {
              $('#modalOverlay').removeClass('hidden');
              $('#modalLoading').removeClass('hidden');

      },
      success: function (response) {
        // Update the content area with the response (e.g., HTML or JSON)
        $('body').html(response); // Adjust based on your setup
        console.log('Dashboard loaded successfully');
      },
      error: function (xhr) {
        // Handle errors (e.g., show an alert or message)
        console.error('Error loading dashboard:', xhr.status, xhr.statusText);
        alert('Failed to load dashboard. Please try again.');
      }
    });
  });

});


  </script>
