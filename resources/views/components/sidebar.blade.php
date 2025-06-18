<aside
    :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 bg-secondary overflow-y-auto lg:translate-x-0 lg:inset-0 custom-scrollbar"
  >
    <!-- start::Logo -->
    <div
      class="flex items-center justify-center bg-black bg-opacity-30 h-16"
    >
    <img src="/img/logo-only-cons-black.png" alt="Logo MZQUizzer" style="max-height: 64px">
      <h1 class="text-gray-100 text-lg font-bold uppercase tracking-widest">
        MZQuizzer
      </h1>
    </div>
    <!-- end::Logo -->

    <!-- start::Navigation -->
    <nav class="py-10 custom-scrollbar">
      <!-- start::Menu link -->
      <a
        x-data="{ linkHover: false }"
        @mouseover="linkHover = true"
        @mouseleave="linkHover = false"
        href="{{ route('dashboard.index') }}"
        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="w-5 h-5 transition duration-200"
          :class="linkHover ? 'text-gray-100' : ''"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
          />
        </svg>
        <span
          class="ml-3 transition duration-200"
          :class="linkHover ? 'text-gray-100' : ''"
        >
          Dashboard
        </span>
      </a>
      <!-- end::Menu link -->

      <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">Apps</p>

      <!-- start::Menu link -->
      <div x-data="{ linkHover: false, linkActive: false }">
        <div
          @mouseover="linkHover = true"
          @mouseleave="linkHover = false"
          @click="linkActive = !linkActive"
          class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
          :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''"
        >
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
          </svg>
            <span class="ml-3">Spreadsheet</span>
          </div>
          <svg
            class="w-3 h-3 transition duration-300"
            :class="linkActive ? 'rotate-90' : ''"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5l7 7-7 7"
            ></path>
          </svg>
        </div>
        <!-- start::Submenu -->
        <ul
          x-show="linkActive"
          x-cloak
          x-collapse.duration.300ms
          class="text-gray-400"
        >
          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('spreadsheet.index') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">Table</span>
            </a>
          </li>
          <!-- end::Submenu link -->

          <!-- start::Submenu link -->
          {{-- <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a
              href="{{ route('spreadsheet.activeStatus') }}"
              class="flex items-center"
            >
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">Active</span>
            </a>
          </li> --}}
          <!-- end::Submenu link -->

        </ul>
        <!-- end::Submenu -->
      </div>
      <!-- end::Menu link -->

      <!-- start::Menu link -->
      <div x-data="{ linkHover: false, linkActive: false }">
        <div
          @mouseover="linkHover = true"
          @mouseleave="linkHover = false"
          @click="linkActive = !linkActive"
          class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
          :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''"
        >
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
            <span class="ml-3">Sheetname</span>
          </div>
          <svg
            class="w-3 h-3 transition duration-300"
            :class="linkActive ? 'rotate-90' : ''"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5l7 7-7 7"
            ></path>
          </svg>
        </div>
        <!-- start::Submenu -->
        <ul
          x-show="linkActive"
          x-cloak
          x-collapse.duration.300ms
          class="text-gray-400"
        >
          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('sheetname.index') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">Table</span>
            </a>
          </li>
          <!-- end::Submenu link -->

        </ul>
        <!-- end::Submenu -->
      </div>
      <!-- end::Menu link -->

      <!-- start::Menu link -->
      <div x-data="{ linkHover: false, linkActive: false }">
        <div
          @mouseover="linkHover = true"
          @mouseleave="linkHover = false"
          @click="linkActive = !linkActive"
          class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
          :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''"
        >
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
          </svg>
            <span class="ml-3 mr-2">Media</span>
            @if ($missingFiles)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
    @endif
          </div>
          <svg
            class="w-3 h-3 transition duration-300"
            :class="linkActive ? 'rotate-90' : ''"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5l7 7-7 7"
            ></path>
          </svg>
        </div>
        <!-- start::Submenu -->
        <ul
          x-show="linkActive"
          x-cloak
          x-collapse.duration.300ms
          class="text-gray-400"
        >
          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('media.index') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis mr-2">Question</span>
              @if ($missingFiles)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
    @endif
            </a>
          </li>
          <!-- end::Submenu link -->
          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('media.file') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">File</span>
            </a>
          </li>
          <!-- end::Submenu link -->

        </ul>
        <!-- end::Submenu -->
      </div>
      <!-- end::Menu link -->

      <!-- start::Menu link -->
      <div x-data="{ linkHover: false, linkActive: false }">
        <div
          @mouseover="linkHover = true"
          @mouseleave="linkHover = false"
          @click="linkActive = !linkActive"
          class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
          :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''"
        >
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
            <span class="ml-3">Question Builder</span>
          </div>
          <svg
            class="w-3 h-3 transition duration-300"
            :class="linkActive ? 'rotate-90' : ''"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5l7 7-7 7"
            ></path>
          </svg>
        </div>
        <!-- start::Submenu -->
        <ul
          x-show="linkActive"
          x-cloak
          x-collapse.duration.300ms
          class="text-gray-400"
        >
          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('builder.truefalse') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">True or False</span>
            </a>
          </li>
          <!-- end::Submenu link -->

          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('builder.multichoice') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">Multiple Choice</span>
            </a>
          </li>
          <!-- end::Submenu link -->

          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('builder.shortanswer') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">Short Answer</span>
            </a>
          </li>
          <!-- end::Submenu link -->

          <!-- start::Submenu link -->
          <li
            class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100"
          >
            <a href="{{ route('builder.bundle') }}" class="flex items-center">
              <span class="mr-2 text-sm">&bull;</span>
              <span class="overflow-ellipsis">Bundle</span>
            </a>
          </li>
          <!-- end::Submenu link -->

        </ul>
        <!-- end::Submenu -->
      </div>
      <!-- end::Menu link -->

    </nav>
    <!-- end::Navigation -->
  </aside>