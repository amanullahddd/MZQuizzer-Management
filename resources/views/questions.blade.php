<!DOCTYPE html>
<html>
<head>
    <title>Questions</title>
</head>
<body>
    <pre>
        {{ json_encode($questionDatabase, JSON_PRETTY_PRINT) }}
    </pre>

    <div class="lg:pl-64 w-full flex flex-col">
        <!-- start::Topbar -->
        <div class="flex flex-col">
          <header
            class="flex justify-between items-center h-16 py-4 px-6 bg-white"
          >
            <!-- start::Mobile menu button -->
            <div class="flex items-center">
              <button
                @click="menuOpen = true"
                class="text-gray-500 hover:text-primary focus:outline-none lg:hidden transition duration-200"
              >
                <svg
                  class="w-6 h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h7"
                  ></path>
                </svg>
              </button>
            </div>
            <!-- end::Mobile menu button -->
    
            <!-- start::Right side top menu -->
            <div class="flex items-center">
              <!-- start::Search input -->
              <form class="relative">
                <input
                  type="text"
                  placeholder="Search..."
                  class="w-48 lg:w-72 bg-gray-200 text-sm py-2 pl-4 rounded-lg focus:ring-0 focus:outline-none"
                />
                <button class="absolute right-2 top-2.5">
                  <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                  </svg>
                </button>
              </form>
              <!-- end::Search input -->
    
              <!-- start::Notifications -->
              <div x-data="{ linkActive: false }" class="relative mx-6">
                <!-- start::Main link -->
                <div
                  @click="linkActive = !linkActive"
                  class="cursor-pointer flex"
                >
                  <svg
                    class="w-6 h-6 cursor-pointer hover:text-primary"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                    ></path>
                  </svg>
                  <sub>
                    <span
                      class="bg-red-600 text-gray-100 px-1.5 py-0.5 rounded-full -ml-1 animate-pulse"
                    >
                      4
                    </span>
                  </sub>
                </div>
                <!-- end::Main link -->
    
                <!-- start::Submenu -->
                <div
                  x-show="linkActive"
                  @click.away="linkActive = false"
                  x-cloak
                  class="absolute right-0 w-96 top-11 border border-gray-300 z-10"
                >
                  <!-- start::Submenu content -->
                  <div
                    class="bg-white rounded max-h-96 overflow-y-scroll custom-scrollbar"
                  >
                    <!-- start::Submenu header -->
                    <div class="flex items-center justify-between px-4 py-2">
                      <span class="font-bold">Notifications</span>
                      <span
                        class="text-xs px-1.5 py-0.5 bg-red-600 text-gray-100 rounded"
                      >
                        4 new
                      </span>
                    </div>
                    <hr />
                    <!-- end::Submenu header -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Order Completed
                          </p>
                          <p class="text-xs">Your order is completed</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 5 min ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <img
                          src="./assets/img/profile.jpg"
                          class="w-8 rounded-full"
                        />
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Maria sent you a message
                          </p>
                          <p class="text-xs">Hey there, how are you do...</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 30 min ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Order Completed
                          </p>
                          <p class="text-xs">Your order is completed</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 54 min ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <img
                          src="./assets/img/profile.jpg"
                          class="w-8 rounded-full"
                        />
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Maria sent you a message
                          </p>
                          <p class="text-xs">Hey there, how are you do...</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 1 hour ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Order Completed
                          </p>
                          <p class="text-xs">Your order is completed</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 15 hours ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <img
                          src="./assets/img/profile.jpg"
                          class="w-8 rounded-full"
                        />
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Maria sent you a message
                          </p>
                          <p class="text-xs">Hey there, how are you do...</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 12 day ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Order Completed
                          </p>
                          <p class="text-xs">Your order is completed</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 3 months ago </span>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="#"
                      class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <img
                          src="./assets/img/profile.jpg"
                          class="w-8 rounded-full"
                        />
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Maria sent you a message
                          </p>
                          <p class="text-xs">Hey there, how are you do...</p>
                        </div>
                      </div>
                      <span class="text-xs font-bold"> 10 months ago </span>
                    </a>
                    <!-- end::Submenu link -->
                  </div>
                  <!-- end::Submenu content -->
                </div>
                <!-- end::Submenu -->
              </div>
              <!-- end::Notifications -->
    
              <!-- start::Profile -->
              <div x-data="{ linkActive: false }" class="relative">
                <!-- start::Main link -->
                <div @click="linkActive = !linkActive" class="cursor-pointer">
                  <img
                    src="./assets/img/profile.jpg"
                    class="w-10 rounded-full"
                  />
                </div>
                <!-- end::Main link -->
    
                <!-- start::Submenu -->
                <div
                  x-show="linkActive"
                  @click.away="linkActive = false"
                  x-cloak
                  class="absolute right-0 w-40 top-11 border border-gray-300 z-20"
                >
                  <!-- start::Submenu content -->
                  <div class="bg-white rounded">
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="./pages/profile.html"
                      class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-5 h-5 text-primary"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Profile
                          </p>
                        </div>
                      </div>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="./pages/email/inbox.html"
                      class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-5 h-5 text-primary"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Inbox
                            <span
                              class="bg-red-600 text-gray-100 text-xs px-1.5 py-0.5 ml-2 rounded"
                              >3</span
                            >
                          </p>
                        </div>
                      </div>
                    </a>
                    <!-- end::Submenu link -->
                    <!-- start::Submenu link -->
                    <a
                      x-data="{ linkHover: false }"
                      href="./pages/settings.html"
                      class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-5 h-5 text-primary"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                          ></path>
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                          ></path>
                        </svg>
                        <div class="text-sm ml-3">
                          <p
                            class="text-gray-600 font-bold capitalize"
                            :class=" linkHover ? 'text-primary' : ''"
                          >
                            Settings
                          </p>
                        </div>
                      </div>
                    </a>
                    <!-- end::Submenu link -->
    
                    <hr />
    
                    <!-- start::Submenu link -->
                    <form
                      method=""
                      action=""
                      x-data="{ linkHover: false }"
                      class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                      @mouseover="linkHover = true"
                      @mouseleave="linkHover = false"
                    >
                      <div class="flex items-center">
                        <svg
                          class="w-5 h-5 text-red-600"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                          ></path>
                        </svg>
                        <button
                          class="text-sm ml-3 text-gray-600 font-bold capitalize"
                          :class=" linkHover ? 'text-primary' : ''"
                        >
                          Log out
                        </button>
                      </div>
                    </form>
                    <!-- end::Submenu link -->
                  </div>
                  <!-- end::Submenu content -->
                </div>
                <!-- end::Submenu -->
              </div>
              <!-- end::Profile -->
            </div>
            <!-- end::Right side top menu -->
          </header>
        </div>
        <!-- end::Topbar -->
    
        <!-- start:Page content -->
        {{-- <div class="h-full bg-gray-200 p-8">
          <!-- start::Stats -->
          <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10">
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
              <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-indigo-600"
                  >Total Revenue</span
                >
                <span
                  class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  >Today</span
                >
              </div>
              <div class="flex items-center justify-between mt-6">
                <div>
                  <svg
                    class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-indigo-400 bg-opacity-20 rounded-full text-indigo-600 border border-indigo-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1"
                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col">
                  <div class="flex items-end">
                    <span class="text-2xl 2xl:text-4xl font-bold">$8,141</span>
                    <div class="flex items-center ml-2 mb-1">
                      <svg
                        class="w-5 h-5 text-green-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                        ></path>
                      </svg>
                      <span class="font-bold text-sm text-gray-500 ml-0.5"
                        >3%</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
              <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-green-600">New Orders</span>
                <span
                  class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  >7 days</span
                >
              </div>
              <div class="flex items-center justify-between mt-6">
                <div>
                  <svg
                    class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-green-400 bg-opacity-20 rounded-full text-green-600 border border-green-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col">
                  <div class="flex items-end">
                    <span class="text-2xl 2xl:text-4xl font-bold">217</span>
                    <div class="flex items-center ml-2 mb-1">
                      <svg
                        class="w-5 h-5 text-green-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                        ></path>
                      </svg>
                      <span class="font-bold text-sm text-gray-500 ml-0.5"
                        >5%</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
              <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-blue-600">New Users</span>
                <span
                  class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  >7 days</span
                >
              </div>
              <div class="flex items-center justify-between mt-6">
                <div>
                  <svg
                    class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-blue-400 bg-opacity-20 rounded-full text-blue-600 border border-blue-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col">
                  <div class="flex items-end">
                    <span class="text-2xl 2xl:text-4xl font-bold">54</span>
                    <div class="flex items-center ml-2 mb-1">
                      <svg
                        class="w-5 h-5 text-green-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                        ></path>
                      </svg>
                      <span class="font-bold text-sm text-gray-500 ml-0.5"
                        >7%</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="px-6 py-6 bg-white rounded-lg shadow-xl">
              <div class="flex items-center justify-between">
                <span class="font-bold text-sm text-yellow-600">Visits</span>
                <span
                  class="text-xs bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  >30 days</span
                >
              </div>
              <div class="flex items-center justify-between mt-6">
                <div>
                  <svg
                    class="w-12 2xl:w-16 h-12 2xl:h-16 p-1 2xl:p-3 bg-yellow-400 bg-opacity-20 rounded-full text-yellow-600 border border-yellow-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                    ></path>
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                    ></path>
                  </svg>
                </div>
                <div class="flex flex-col">
                  <div class="flex items-end">
                    <span class="text-2xl 2xl:text-4xl font-bold">10,644</span>
                    <div class="flex items-center ml-2 mb-1">
                      <svg
                        class="w-5 h-5 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"
                        ></path>
                      </svg>
                      <span class="font-bold text-sm text-gray-500 ml-0.5"
                        >-1%</span
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end::Stats -->
    
          <!-- start::Charts -->
          <div
            class="w-full flex flex-col lg:flex-row items-center justify-between bg-white my-16 px-2 py-4 rounded-lg shadow-lg"
          >
            <div class="w-full lg:w-2/3">
              <h4 class="text-center text-xl font-semibold mb-4">
                Statistic 1
              </h4>
              <div>
                <canvas id="chart_1"></canvas>
              </div>
            </div>
            <div class="hidden lg:block lg:mx-2 xl:mx-10 2xl:mx-20"></div>
            <div class="w-full lg:w-1/3 mt-10 lg:mt-0">
              <h4 class="text-center text-xl font-semibold mb-4">
                Statistic 2
              </h4>
              <div>
                <canvas id="chart_2"></canvas>
              </div>
            </div>
          </div>
          <!-- end::Charts -->
    
          <!-- start::Stats  -->
          <div
            class="flex flex-col xl:flex-row space-y-4 xl:space-y-0 xl:space-x-4"
          >
            <!-- start::Stats by category -->
            <div
              class="w-full xl:w-1/3 p-6 space-y-6 bg-white rounded-lg shadow-xl capitalize"
            >
              <h4 class="text-center text-xl font-semibold mb-4">
                Project completion
              </h4>
              <section x-data="statsByCategory" class="space-y-6">
                <div class="flex items-center justify-center">
                  <template x-for="item in items">
                    <button
                      x-text="item.name"
                      class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-1.5 mx-1 rounded-lg transition duration-200"
                      :class="(currentItem.name == item.name) && 'bg-gray-300'"
                      @click="currentItem = item"
                    ></button>
                  </template>
                </div>
    
                <p
                  class="text-center text-xl font-semibold text-gray-700"
                  x-text="`${currentItem.name}`"
                ></p>
    
                <div
                  class="flex items-center justify-center"
                  x-data="{ circumference: 2 * 22 / 7 * 80 }"
                >
                  <svg class="-rotate-90 w-48 h-48">
                    <circle
                      cx="96"
                      cy="96"
                      r="80"
                      stroke="currentColor"
                      stroke-width="20"
                      fill="transparent"
                      class="text-gray-300"
                    />
    
                    <circle
                      cx="96"
                      cy="96"
                      r="80"
                      stroke="currentColor"
                      stroke-width="20"
                      fill="transparent"
                      :stroke-dasharray="circumference"
                      :stroke-dashoffset="circumference - currentItem.percent / 100 * circumference"
                      class="text-green-500"
                    />
                  </svg>
                  <span
                    class="absolute text-3xl font-bold text-green-500"
                    x-text="`${currentItem.percent}%`"
                  ></span>
                </div>
              </section>
            </div>
            <!-- end::Stats by category -->
    
            <!-- start::Project overview stats -->
            <div
              x-data="productOverviewStats"
              class="w-full xl:w-1/3 p-6 space-y-6 bg-white shadow-xl rounded-lg"
            >
              <h4 class="text-xl font-semibold mb-4 capitalize">
                Project overview
              </h4>
              <section class="space-y-6">
                <div
                  class="flex items-center justify-center"
                  x-data="{ circumference: 2 * 22 / 7 * 110 }"
                >
                  <svg class="rotate-90 w-64 h-64">
                    <circle
                      cx="128"
                      cy="128"
                      r="110"
                      stroke="currentColor"
                      stroke-width="7"
                      fill="transparent"
                      class="text-gray-300"
                    />
    
                    <circle
                      cx="128"
                      cy="128"
                      r="110"
                      stroke="currentColor"
                      stroke-width="20"
                      fill="transparent"
                      :stroke-dasharray="circumference"
                      :stroke-dashoffset="circumference - Math.round((project.completed / (project.completed + project.in_progress)) * 100) / 100 * circumference"
                      class="text-green-500"
                    />
                  </svg>
                  <span
                    class="absolute text-5xl font-bold text-green-500"
                    x-text="`${Math.round((project.completed / (project.completed + project.in_progress)) * 100)}%`"
                  ></span>
                </div>
              </section>
              <div class="grid grid-cols-2 border-t-2 border-gray-300 pt-4">
                <div
                  class="flex flex-col items-center justify-center border-r-2 border-gray-300"
                >
                  <span class="text-sm text-gray-600">Completed</span>
                  <span
                    class="text-3xl font-bold text-gray-800"
                    x-text="`${project.completed}`"
                  ></span>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <span class="text-sm text-gray-600">In Progress</span>
                  <span
                    class="text-3xl font-bold text-gray-800"
                    x-text="`${project.in_progress}`"
                  ></span>
                </div>
              </div>
            </div>
            <!-- end::Project overview stats -->
    
            <!-- start::Total stats -->
            <div
              class="w-full xl:w-1/3 p-6 space-y-6 bg-white shadow-xl rounded-lg"
            >
              <h4 class="text-xl font-semibold mb-4 capitalize">Order stats</h4>
              <div class="grid grid-cols-2 gap-4 h-40">
                <div
                  class="bg-green-300 bg-opacity-20 text-green-700 flex flex-col items-center justify-center rounded-lg"
                >
                  <span class="text-4xl font-bold">184</span>
                  <span>Completed</span>
                </div>
                <div
                  class="bg-indigo-300 bg-opacity-20 text-indigo-700 flex flex-col items-center justify-center rounded-lg"
                >
                  <span class="text-4xl font-bold">54</span>
                  <span>Shipped</span>
                </div>
              </div>
              <div class="grid grid-cols-3 gap-2 h-32">
                <div
                  class="bg-yellow-300 bg-opacity-20 text-yellow-700 flex flex-col items-center justify-center rounded-lg"
                >
                  <span class="text-3xl font-bold">9</span>
                  <span>Pending</span>
                </div>
                <div
                  class="bg-blue-300 bg-opacity-20 text-blue-700 flex flex-col items-center justify-center rounded-lg"
                >
                  <span class="text-3xl font-bold">24</span>
                  <span>Refunded</span>
                </div>
                <div
                  class="bg-red-300 bg-opacity-20 text-red-700 flex flex-col items-center justify-center rounded-lg"
                >
                  <span class="text-3xl font-bold">37</span>
                  <span>Canceled</span>
                </div>
              </div>
            </div>
            <!-- end::Total stats -->
          </div>
          <!-- end::Stats -->
    
          <!-- start::Activities -->
          <div
            class="flex flex-col xl:flex-row my-16 space-y-4 xl:space-y-0 xl:space-x-4"
          >
            <!-- start::Schedule -->
            <div
              class="w-full xl:w-2/3 bg-white shadow-xl rounded-lg space-y-1"
            >
              <h4 class="text-xl font-semibold m-6 capitalize">Schedule</h4>
              <!-- start::Task in calendar -->
              <div class="flex">
                <div
                  class="w-32 flex flex-col items-center justify-center px-2 bg-blue-500 text-gray-100"
                >
                  <span class="text-sm lg:text-base font-semibold">24 Sep</span>
                  <span class="text-xs lg:text-sm text-gray-200">1:30 PM</span>
                </div>
                <div
                  class="w-full flex justify-between p-4 bg-gray-100 hover:bg-gray-200 transition duration-200"
                >
                  <div class="flex flex-col justify-center">
                    <span class="xl:text-lg"
                      >New project requirements meeting</span
                    >
                    <span class="flex items-start">
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        ></path>
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                      </svg>
                      <span class="text-xs lg:text-sm"> Meeting room 3 </span>
                    </span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="text-xs lg:text-sm bg-gray-300 p-2 rounded-lg text-center"
                      >2 hours</span
                    >
                  </div>
                </div>
              </div>
              <!-- end::Task in calendar -->
    
              <!-- start::Task in calendar -->
              <div class="flex">
                <div
                  class="w-32 flex flex-col items-center justify-center px-2 bg-blue-500 text-gray-100"
                >
                  <span class="text-sm lg:text-base font-semibold">27 Sep</span>
                  <span class="text-xs lg:text-sm text-gray-200">11:30 AM</span>
                </div>
                <div
                  class="w-full flex justify-between p-4 bg-gray-100 hover:bg-gray-200 transition duration-200"
                >
                  <div class="flex flex-col justify-center">
                    <span class="xl:text-lg">Weekly dev team meeting</span>
                    <span class="flex items-start">
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        ></path>
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                      </svg>
                      <span class="text-xs lg:text-sm"> Meeting room 2 </span>
                    </span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="text-xs lg:text-sm bg-gray-300 p-2 rounded-lg text-center"
                      >3 days</span
                    >
                  </div>
                </div>
              </div>
              <!-- end::Task in calendar -->
    
              <!-- start::Task in calendar -->
              <div class="flex">
                <div
                  class="w-32 flex flex-col items-center justify-center px-2 bg-blue-500 text-gray-100"
                >
                  <span class="text-sm lg:text-base font-semibold">27 Sep</span>
                  <span class="text-xs lg:text-sm text-gray-200">3:30 PM</span>
                </div>
                <div
                  class="w-full flex justify-between p-4 bg-gray-100 hover:bg-gray-200 transition duration-200"
                >
                  <div class="flex flex-col justify-center">
                    <span class="xl:text-lg">Meeting with Laravel client</span>
                    <span class="flex items-start">
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        ></path>
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                      </svg>
                      <span class="text-xs lg:text-sm"> Zoom </span>
                    </span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="text-xs lg:text-sm bg-gray-300 p-2 rounded-lg text-center"
                      >3 days</span
                    >
                  </div>
                </div>
              </div>
              <!-- end::Task in calendar -->
    
              <!-- start::Task in calendar -->
              <div class="flex">
                <div
                  class="w-32 flex flex-col items-center justify-center px-2 bg-blue-500 text-gray-100"
                >
                  <span class="text-sm lg:text-base font-semibold">29 Sep</span>
                  <span class="text-xs lg:text-sm text-gray-200">10:00 AM</span>
                </div>
                <div
                  class="w-full flex justify-between p-4 bg-gray-100 hover:bg-gray-200 transition duration-200"
                >
                  <div class="flex flex-col justify-center">
                    <span class="xl:text-lg"
                      >Meeting with Tailwind CSS client</span
                    >
                    <span class="flex items-start">
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        ></path>
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                      </svg>
                      <span class="text-xs lg:text-sm"> Zoom </span>
                    </span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="text-xs lg:text-sm bg-gray-300 p-2 rounded-lg text-center"
                      >5 days</span
                    >
                  </div>
                </div>
              </div>
              <!-- end::Task in calendar -->
    
              <!-- start::Task in calendar -->
              <div class="flex">
                <div
                  class="w-32 flex flex-col items-center justify-center px-2 bg-blue-500 text-gray-100"
                >
                  <span class="text-sm lg:text-base font-semibold">30 Sep</span>
                  <span class="text-xs lg:text-sm text-gray-200">8:00 AM</span>
                </div>
                <div
                  class="w-full flex justify-between p-4 bg-gray-100 hover:bg-gray-200 transition duration-200"
                >
                  <div class="flex flex-col justify-center">
                    <span class="lg:text-lg">Laracon</span>
                    <span class="flex items-start">
                      <svg
                        class="w-4 h-4 mr-1"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                        ></path>
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                      </svg>
                      <span class="text-xs lg:text-sm"> Amsterdam </span>
                    </span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="text-xs lg:text-sm bg-gray-300 p-2 rounded-lg text-center"
                      >6 days</span
                    >
                  </div>
                </div>
              </div>
              <!-- end::Task in calendar -->
            </div>
            <!-- end::Schedule -->
    
            <!-- start::Activity -->
            <div
              class="w-full xl:w-1/3 bg-white rounded-lg shadow-xl px-4 overflow-y-hidden"
            >
              <h4 class="text-xl font-semibold p-6 capitalize">Activity</h4>
              <div class="relative h-full px-8 pt-2">
                <div
                  class="absolute h-full border border-dashed border-opacity-20 border-secondary"
                ></div>
    
                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                  <div class="w-1/12">
                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                  </div>
                  <div class="w-11/12">
                    <p class="text-sm">Server down for maintenance.</p>
                    <p class="text-xs text-gray-500">3 min ago</p>
                  </div>
                </div>
                <!-- end::Timeline item -->
    
                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                  <div class="w-1/12">
                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                  </div>
                  <div class="w-11/12">
                    <p class="text-sm">
                      <a href="#" class="text-primary font-bold"
                        >Harold Hobbs</a
                      >
                      make payment for order
                      <a href="#" class="text-primary font-bold">#OR7546</a>.
                    </p>
                    <p class="text-xs text-gray-500">15 min ago</p>
                  </div>
                </div>
                <!-- end::Timeline item -->
    
                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                  <div class="w-1/12">
                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                  </div>
                  <div class="w-11/12">
                    <p class="text-sm">
                      Invoice
                      <a href="#" class="text-primary font-bold">#4563</a> was
                      created.
                    </p>
                    <p class="text-xs text-gray-500">57 min ago</p>
                  </div>
                </div>
                <!-- end::Timeline item -->
    
                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                  <div class="w-1/12">
                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                  </div>
                  <div class="w-11/12">
                    <p class="text-sm">
                      <a href="#" class="text-primary font-bold"
                        >Cecilia Hendric</a
                      >
                      just confirmed email address.
                    </p>
                    <p class="text-xs text-gray-500">1 hour ago</p>
                  </div>
                </div>
                <!-- end::Timeline item -->
    
                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                  <div class="w-1/12">
                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                  </div>
                  <div class="w-11/12">
                    <p class="text-sm">
                      New order received
                      <a href="#" class="text-primary font-bold">#OR9653</a>.
                    </p>
                    <p class="text-xs text-gray-500">2 hours ago</p>
                  </div>
                </div>
                <!-- end::Timeline item -->
    
                <!-- start::Timeline item -->
                <div class="flex items-center w-full my-6 -ml-1.5">
                  <div class="w-1/12">
                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                  </div>
                  <div class="w-11/12">
                    <p class="text-sm">
                      <a href="#" class="text-primary font-bold"
                        >Jane Stillman</a
                      >
                      canceled order
                      <a href="#" class="text-primary font-bold">#OR7451</a>.
                    </p>
                    <p class="text-xs text-gray-500">2 hours ago</p>
                  </div>
                </div>
                <!-- end::Timeline item -->
              </div>
            </div>
            <!-- end::Activity -->
          </div>
          <!-- end::Activities -->
    
          <!-- start::Table -->
          <div
            class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar"
          >
            <h4 class="text-xl font-semibold">Recent transactions</h4>
            <table class="w-full my-8 whitespace-nowrap">
              <thead class="bg-secondary text-gray-100 font-bold">
                <td></td>
                <td class="py-2 pl-2">Order ID</td>
                <td class="py-2 pl-2">Customer Name</td>
                <td class="py-2 pl-2">Price</td>
                <td class="py-2 pl-2">Status</td>
                <td class="py-2 pl-2">Date</td>
                <td class="py-2 pl-2">View Details</td>
              </thead>
              <tbody class="text-sm">
                <tr
                  class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR7546</td>
                  <td class="py-3 pl-2 capitalize">Harold Hobbs</td>
                  <td class="py-3 pl-2">$ 123.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Paid</span
                    >
                  </td>
                  <td class="py-3 pl-2">Sep 30, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-200 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR4359</td>
                  <td class="py-3 pl-2 capitalize">Shirley Williams</td>
                  <td class="py-3 pl-2">$ 745.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-indigo-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Shipped</span
                    >
                  </td>
                  <td class="py-3 pl-2">Sep 28, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR3654</td>
                  <td class="py-3 pl-2 capitalize">Timothy Reyes</td>
                  <td class="py-3 pl-2">$ 1344.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-yellow-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Pending</span
                    >
                  </td>
                  <td class="py-3 pl-2">Sep 27, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-200 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR7451</td>
                  <td class="py-3 pl-2 capitalize">Jane Stillman</td>
                  <td class="py-3 pl-2">$ 230.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-red-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Canceled</span
                    >
                  </td>
                  <td class="py-3 pl-2">Sep 24, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR1324</td>
                  <td class="py-3 pl-2 capitalize">Leon Blank</td>
                  <td class="py-3 pl-2">$ 511.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-indigo-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Shipped</span
                    >
                  </td>
                  <td class="py-3 pl-2">Sep 20, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-200 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR5331</td>
                  <td class="py-3 pl-2 capitalize">Cecilia Hendric</td>
                  <td class="py-3 pl-2">$ 2654.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Paid</span
                    >
                  </td>
                  <td class="py-3 pl-2">Sep 09, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR1874</td>
                  <td class="py-3 pl-2 capitalize">Suzanne Williams</td>
                  <td class="py-3 pl-2">$ 400.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-green-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Paid</span
                    >
                  </td>
                  <td class="py-3 pl-2">Aug 31, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-200 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR4963</td>
                  <td class="py-3 pl-2 capitalize">Gerland Falvin</td>
                  <td class="py-3 pl-2">$ 954.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-yellow-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Pending</span
                    >
                  </td>
                  <td class="py-3 pl-2">Aug 31, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR9452</td>
                  <td class="py-3 pl-2 capitalize">Crystal Reagle</td>
                  <td class="py-3 pl-2">$ 1365.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-red-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Canceled</span
                    >
                  </td>
                  <td class="py-3 pl-2">Aug 25, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
                <tr
                  class="bg-gray-200 hover:bg-primary hover:bg-opacity-20 transition duration-200"
                >
                  <td class="py-3 pl-2">
                    <input
                      type="checkbox"
                      class="rounded focus:ring-0 checked:bg-red-500 ml-2"
                    />
                  </td>
                  <td class="py-3 pl-2">#OR8563</td>
                  <td class="py-3 pl-2 capitalize">John Reeves</td>
                  <td class="py-3 pl-2">$ 164.00</td>
                  <td class="py-3 pl-2">
                    <span
                      class="bg-indigo-500 px-1.5 py-0.5 rounded-lg text-gray-100"
                      >Shipped</span
                    >
                  </td>
                  <td class="py-3 pl-2">July 20, 2021</td>
                  <td class="py-3 pl-2">
                    <a
                      href="#"
                      class="bg-primary hover:bg-opacity-90 px-2 py-1 mr-2 text-gray-100 rounded-lg"
                      >View Details</a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- end::Table -->
        </div> --}}
        <!-- end:Page content -->
      </div>
</body>
</html>
