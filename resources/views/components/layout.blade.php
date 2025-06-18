<!doctype html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <!-- Alpine Plugins -->
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>

  <div
  x-data="{ menuOpen: false }"
  class="flex min-h-screen custom-scrollbar"
>
  <!-- start::Black overlay -->
  <div
    :class="menuOpen ? 'block' : 'hidden'"
    @click="menuOpen = false"
    class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"
  ></div>
  <!-- end::Black overlay -->

  <!-- start::Sidebar -->
  <x-sidebar></x-sidebar>
  <!-- end::Sidebar -->

  

  <div class="lg:pl-64 w-full flex flex-col">
    <!-- start::Topbar -->
    <x-topbar></x-topbar>
    <!-- end::Topbar -->

    

    <!-- start:Page content -->
    <div class="h-full bg-gray-200 p-8">

      @if (session('success'))
      <div id="alert-success"
      role="alert"
      class="mb-5 w-full flex items-center justify-between bg-green-100 px-6 py-2 rounded-lg border border-green-300">
        <div class="flex items-center space-x-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <div class="flex flex-col justify-center">
                <span class="text-green-600 font-bold">Success</span>
                <span class="text-sm text-green-600">{{ session('success') }}</span>
            </div>
        </div>
        <button 
        type="button"
          onclick="document.getElementById('alert-success').remove();"
         class="text-xl text-gray-400 hover:text-gray-500" title="Close">&#10005;</button>
    </div>
    @endif

    
    @if (session('warning'))
    <div id="alert-warning"
    role="alert"
    class=" mb-5 w-full flex items-center justify-between bg-yellow-100 px-6 py-2 rounded-lg border border-yellow-300">
      <div class="flex items-center space-x-6">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          <div class="flex flex-col justify-center">
              <span class="text-yellow-600 font-bold">Warning</span>
              <span class="text-sm text-yellow-600">{{ session('warning') }}</span>
          </div>
      </div>
      <button 
        type="button"
          onclick="document.getElementById('alert-warning').remove();"
         class="text-xl text-gray-400 hover:text-gray-500" title="Close">&#10005;</button>
  </div>
    @endif

        <main>
          {{ $slot }}
        </main>

    </div>
    <!-- end:Page content -->
  </div>
</div>

<script>
  setTimeout(() => {
      const alert = document.getElementById('alert-success');
      if (alert) {
          alert.remove();
      }
  }, 10000); // Menghilang setelah 10 detik
</script>

</body>
</html>