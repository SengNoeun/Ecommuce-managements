<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

  <!-- Custom JS (placeholders, replace with actual paths) -->
  <script src="{{ asset('js/CardRefresh.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    /* Custom styles for Tailwind */
    .sidebar {
      height: 100vh;
      position: fixed;
      background-color: rgb(131, 149, 165)
      top: 0;
      left: 0;
      width: 250px;
      transition: transform 0.3s ease-in-out;
    }
    
    .sidebar-hidden {
      transform: translateX(-250px);
    }
    .content-wrapper {
      margin-left: 250px;
      transition: margin-left 0.3s ease-in-out;
    }
    .sidebar-hidden + .content-wrapper {
      margin-left: 0;
    }
    @media (max-width: 640px) {
      .sidebar {
        transform: translateX(-250px);
      }
      .sidebar-open {
        transform: translateX(0);
      }
      .content-wrapper {
        margin-left: 0;
      }
      .aa:hover.sidebar {
            display: block;
      }
      
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
  <div class="flex flex-1">
          {{-- <div class=" aa text-4xl">+</div> --}}
    <!-- Main Sidebar Container -->
    <aside class="sidebar   text-white bg-gray-900   w-[13.5%]  z-50"  id="sidebar">
      <!-- Brand Logo -->
      <div class="p-4 border-b box-border border-gray-700">
        <div class="flex items-center">
          <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="w-8 h-8 mr-2">
          {{-- <span class="text-lg font-bold">{{session()-.get("NAME")}}</span> --}}
        </div>
      </div>

      <!-- Sidebar Search Form -->
      <div class="p-4 ">
        <div class="flex">
          <input type="search" placeholder="Search" aria-label="Search" class="w-full p-2 rounded-l-md border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <button class="p-2 bg-indigo-500 rounded-r-md hover:bg-indigo-700">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7 7 0 1110 3a7 7 0 016.65 9.65z"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Navbar Menu (Included via Component) -->
      @include('component.navbar')
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper flex-1 ml-64 w-[80%] transition-all duration-300" id="content-wrapper">
      <div class="container mx-auto mt-6">
        @yield("content")
      </div>
    </div>
  </div>

  <!-- Footer (Included via Component) -->
  <footer class="mt-6   ml-72">
    {{-- @include('component.footer') --}}
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar bg-gray-800 text-white w-64 fixed top-0 right-0 h-full shadow-lg transform translate-x-full transition-transform duration-300" id="control-sidebar">
    <!-- Control sidebar content goes here -->
  </aside>

  <!-- JavaScript for Sidebar Toggle -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.getElementById('sidebar');
      const contentWrapper = document.getElementById('content-wrapper');
      const controlSidebar = document.getElementById('control-sidebar');
      const toggleButton = document.querySelector('[data-widget="pushmenu"]'); // Assuming this is in the navbar component

      if (toggleButton) {
        toggleButton.addEventListener('click', () => {
          sidebar.classList.toggle('sidebar-open');
          sidebar.classList.toggle('sidebar-hidden');
          contentWrapper.classList.toggle('ml-0');
        });
      }
        // $().ready(function(){
          
        // })

      // Control sidebar toggle (example)
      document.querySelector('[data-widget="control-sidebar"]').addEventListener('click', () => {
        controlSidebar.classList.toggle('translate-x-0');
        controlSidebar.classList.toggle('translate-x-full');
      });
    });
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
   
</body>
</html>