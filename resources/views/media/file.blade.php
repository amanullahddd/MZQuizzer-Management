<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Advance Table Filters -->
    <div x-data="{ filter: false }" class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar">
      <div class="border-b pb-4 mb-4">
        <h4 class="text-xl font-semibold">Filemedias Table</h4>

        <div class="flex justify-between items-center">
            <div class="text-gray-700 text-base">
            Pastikan data selalu terbarui dengan melakukan sinkronisasi secara berkala.
            </div>
            <!-- start::Buttons With Icons Ping -->
            <button 
            @click="window.dispatchEvent(new CustomEvent('open-confirm-modal', { 
                detail: { 
                    title: 'Sinkronisasi Questionmedias!', 
                    message: 'Apakah Anda yakin melanjutkan proses sinkronisasi?', 
                    url: '{{ route('media.synchroFile') }}', 
                    method: 'GET', 
                    buttonText: 'Sync' 
                }
            }))"
            class="relative flex items-center justify-center border border-purple-500 text-purple-500 rounded-sm px-6 py-1.5 hover:shadow-xl transition duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M4 10l6-6m10 10l-6 6"></path></svg>
                <span class="ml-2">Sinkronisasi</span>
                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                </span>
            </button>
        </div>
        </div>
    
      <div class="mt-8 mb-3 flex flex-col md:flex-row items-start md:items-center md:justify-between">
          <div class="flex items-center justify-center space-x-4">
              <form class="relative flex items-center">
                  <input 
                      type="search"
                      name="input_search_without_btn" 
                      id="input_search_without_btn" 
                      class="flex-1 py-0.5 pl-10 border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300" 
                      placeholder="Search..."
                  >
                  <span class="absolute left-2 bg-transparent flex items-center justify-center" @click="show = !show">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                  </span>
              </form>
              <button 
                  @click="filter = !filter"
                  class="text-primary hover:text-primary-dark font-semibold hover:underline"
              >Filters</button>
          </div>
          <div class="mt-4 md:mt-0">
              <form>
                  <label>Order By:</label>
                  <select class="text-sm py-0.5 ml-1">
                      <option></option>
                      <option>Name</option>
                      <option>Name DESC</option>
                      <option>Price</option>
                      <option>Price DESC</option>
                  </select>
              </form>
          </div>
      </div>
      <div 
          x-show="filter"
          x-collapse.duration.300ms
      >
          <div class="mb-2 py-4 bg-gray-200 px-8 rounded-lg">
              <h5 class="underline">Filter Results</h5>
              <form class="py-2">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 my-4">
                      <input 
                          type="text" 
                          name="order_id" 
                          class="flex-1 py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                          placeholder="Order ID"
                      >
                      <input 
                          type="text" 
                          name="customer_name" 
                          class="flex-1 py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                          placeholder="Customer Name"
                      >
                      <div class="w-full">
                          <label class="mr-2">Status:</label>
                          <select class="flex-1 py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0">
                              <option></option>
                              <option>Pending</option>
                              <option>Shipped</option>
                              <option>Paid</option>
                              <option>Canceled</option>
                          </select>
                      </div>
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 my-4">
                      <input 
                          type="number" 
                          name="min_price" 
                          class="flex-1 py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                          placeholder="Min Price"
                      >
                      <input 
                          type="number" 
                          name="max_price" 
                          class="flex-1 py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                          placeholder="Max Price"
                      >
                  </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 my-4">
                      <div>
                          <label class="mr-2">From Date:</label>
                          <input 
                          type="date" 
                          name="from_date" 
                          class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                          >
                      </div>
                      <div>
                          <label class="mr-2">To Date:</label>
                          <input 
                          type="date" 
                          name="to_date" 
                          class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                          >
                      </div>
                  </div>
  
                  <button class="bg-primary hover:bg-primary-dark rounded-lg px-8 py-1 text-gray-100 hover:shadow-xl transition duration-150 mt-8 text-sm">Filter</button>
              </form>
          </div>
      </div>

      <table class="w-full whitespace-nowrap mb-8">
          <thead class="bg-secondary text-gray-100 font-bold">
              <td class="py-2 pl-2">
                  #
              </td>
              <td class="py-2 pl-2">
                  Name
              </td>
              <td class="py-2 pl-2">
                  Type
              </td>
              <td class="py-2 pl-2 text-center">
                  Preview
              </td>
              <td class="py-2 pl-2">
                  Action
              </td>
          </thead>
          <tbody class="text-sm">
            @forelse ($filemedias as $filemedia)
            <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
              <td class="py-3 pl-2">
                {{ $loop->iteration }}
              </td>
              <td class="py-3 pl-2">
                  {{ $filemedia->name }}
              </td>
              <td class="py-3 pl-2">
                  {{ $filemedia->type }}
              </td>
                @php
                    $filePath = public_path("uploads/{$filemedia->type}/{$filemedia->name}");
                    $lastModified = file_exists($filePath) ? filemtime($filePath) : time();
                @endphp
              <td class="py-3 pl-2 justify-items-center">
                @if ($filemedia->type === 'image')
                    <img src="{{ asset('uploads/image/' . $filemedia->name) }}?v={{ $lastModified }}" alt="Image Preview" width="100">
                @elseif ($filemedia->type === 'audio')
                    <audio controls>
                        <source src="{{ asset('uploads/audio/' . $filemedia->name) }}?v={{ $lastModified }}" type="audio/mpeg">
                        Your browser does not support the audio tag.
                    </audio>
                @else
                    <span>Data Not Found</span>
                @endif
              </td>
              <td class="py-3 pl-2 flex items-center space-x-2">
                  <button 
                        @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: { 
                            id: {{ $filemedia->id }},
                            name: '{{ $filemedia->name }}',
                            type: '{{ $filemedia->type }}',
                            active: '{{ $filemedia->active }}',
                            } }))" 
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary hover:text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                </button>
                  <a href="{{ route('media.editFile', $filemedia->name) }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500 hover:text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                      </svg>
                  </a>
                  <!-- Tombol Delete -->
                <button 
                @click="window.dispatchEvent(new CustomEvent('open-confirm-modal', { 
                    detail: { 
                        title: 'Konfirmasi Proses Delete!', 
                        message: 'Apakah Anda yakin ingin menghapus data ini?', 
                        url: '{{ route('media.destroy', $filemedia->id) }}', 
                        method: 'DELETE', 
                        buttonText: 'Delete' 
                    }
                }))">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500 hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
              </td>
          </tr>
  
            @empty
            <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
              <td class="py-3 pl-2">
                  Data not found.
              </td>
          </tr>
            @endforelse
              
          </tbody>
      </table>
  </div>
  <!-- end::Advance Table Filters -->

<!-- start:: Basic Info Modal -->
<div
x-data="{ showModal: false, detail: {} }"
@open-modal.window="showModal = true; detail = $event.detail"
x-show="showModal" 
x-transition.opacity
x-transition:enter.duration.100ms
x-transition:leave.duration.300ms
x-cloak
class="fixed top-0 left-0 z-50 bg-black bg-opacity-70 h-screen w-full flex items-center justify-center"
>
<!-- start::Green Color Header Cards -->
    <div
    @click.away="showModal = false"
     class="border border-gray-300 bg-white shadow-xl">
        <div class="w-full h-12 bg-green-500 text-gray-100 font-bold flex items-center justify-between px-2">
            <span class="mx-2" x-text="detail.name"></span>
            <button
            @click="showModal = false"
             class="font-bold hover:text-primary-dark" title="close">&#x2715</button>
        </div>
        <div class="p-8 rounded-lg shadow-xl">

            <!-- Container to display the content -->
            <div id="fileContent" class="justify-items-center">
                <!-- Default content or loading indicator can be placed here -->
            </div>
            
            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="type">
                    <span class="font-bold text-green-600">Type</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.type"
                        class="text-sm bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  ></span>
                </div>
            </div>
            
            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="active">
                    <span class="font-bold text-green-600">Active</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.active"
                        class="text-sm bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  ></span>
                </div>
            </div>
        </div>
    </div>
<!-- end::Green Color Header Cards -->
</div>
<!-- end:: Basic Info Modal -->

<x-route-confirm></x-route-confirm>

<script>
    function openModal(id, name, type, active) {
        // Update Alpine.js data
        Alpine.store('modalData', { showModal: true, detail: { id, name, type, active } });

        // Update content directly
        updateContent(type, name);
    }

    function updateContent(type, name) {
        let content = '';

        if (type === 'image') {
            content = `<img src="/uploads/image/${name}" alt="Image Preview" width="100">`;
        } else if (type === 'audio') {
            content = `
                <audio controls>
                    <source src="/uploads/audio/${name}" type="audio/mpeg">
                    Your browser does not support the audio tag.
                </audio>`;
        } else {
            content = '<span>Data Not Found</span>';
        }

        document.getElementById('fileContent').innerHTML = content;
    }
  
    document.addEventListener('alpine:init', () => {
        Alpine.store('modalData', {
            showModal: false,
            detail: {},
        });
    });

    // Listen for the custom event and update content
    window.addEventListener('open-modal', (event) => {
        const { id, name, type, active } = event.detail;
        openModal(id, name, type, active);
    });
</script>

  
  </x-layout>