<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Advance Table Filters -->
    <div x-data="{ filter: false }" class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <a class="flex space-x-2 items-center justify-center px-4 py-1.5 transition duration-150 text-blue-500 hover:underline" href="{{ route('sheetname.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Back</span>
                </a>
                <h4 class="text-xl font-semibold">Set Sheetnames Active</h4>
            </div>
        <div class="flex justify-between items-center py-2">
            <div class="text-gray-700 text-base">
            Lakukan sinkronisasi secara berkala untuk dokumen <span class="text-lg font-semibold">{{ $spreadsheet->title }}</span>.
            </div>
            <!-- start::Buttons With Icons Ping -->
            <button 
            @click="window.dispatchEvent(new CustomEvent('open-confirm-modal', { 
                detail: { 
                    title: 'Sinkronisasi untuk dokumen {{ $spreadsheet->title }}!', 
                    message: 'Apakah Anda yakin melanjutkan proses sinkronisasi?', 
                    url: '{{ route('sheetname.synchroSingle', $spreadsheet->slug) }}', 
                    method: 'GET', 
                    buttonText: 'Sync' 
                }
            }))"
            class="relative flex items-center justify-center border border-purple-500 text-purple-500 rounded-sm px-6 py-1.5 hover:shadow-xl transition duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M4 10l6-6m10 10l-6 6"></path></svg>
                <span>Synchronize</span>
                <span class="flex absolute h-3 w-3 top-0 right-0 -mt-1 -mr-1">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                </span>
            </button>
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
      <form id="updateForm" action="{{ route('sheetname.update') }}" method="POST">
        @csrf

        <input type="hidden" name="spreadsheet_id" value="{{ $spreadsheet->id }}">

    <table class="w-full whitespace-nowrap mb-8">
        <thead class="bg-secondary text-gray-100 font-bold">
            <td class="py-2 pl-2">
                #
            </td>
            <td class="py-2 pl-2">
                Name
            </td>
            <td class="py-2 pl-2">
                Action
            </td>
        </thead>
        <tbody class="text-sm">
          @forelse ($sheetnames as $sheetname)
          @php
        // Cek apakah sheet sudah terdaftar di database dan active = true
        $isActive = $sheetname->active ?? false;
    @endphp
          <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
            <td class="py-3 pl-2">
              {{ $loop->iteration }}
            </td>
            <td class="py-3 pl-2 capitalize">
                {{ $sheetname->name }}
            </td>
            <td class="py-3 pl-2 flex items-center space-x-2">
                <input type="checkbox" 
               name="active[]" 
               value="{{ $sheetname->name }}" 
               class="rounded focus:ring-0 ml-2 checked:bg-green-500" 
               @if($isActive) checked @endif>
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

    <!-- Footer Card -->
    <div class="flex justify-end border-t pt-4 mt-4">
        <!-- start::Buttons With Icons Edit -->
        <button type="button"
        @click="window.dispatchEvent(new CustomEvent('open-pre-submit-modal', { 
            detail: { 
                formId: 'updateForm', 
                title: 'Konfirmasi Proses Update!', 
                message: 'Apakah data yang akan diubah sudah sesuai?' 
            }
        }))"
        class="flex space-x-2 items-center justify-center bg-yellow-500 hover:bg-yellow-600 rounded-sm px-4 py-1.5 text-gray-100 text-sm hover:shadow-xl transition duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <span>Update</span>
        </button>
        <!-- end::Buttons With Icons Edit -->
    </div>
    </form>
  </div>
  <!-- end::Advance Table Filters -->

  <x-form-confirm></x-form-confirm>
  <x-route-confirm></x-route-confirm>

  </x-layout>