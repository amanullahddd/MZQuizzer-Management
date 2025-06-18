<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Advance Table Filters -->
    <div x-data="{ filter: false }" class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar">
      <div class="flex justify-between items-center border-b pb-4 mb-4">
        <a class="flex space-x-2 items-center justify-center px-4 py-1.5 transition duration-150 text-blue-500 hover:underline" href="{{ route('media.sheetname', $sheetname->spreadsheet->slug) }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        <span>Back</span>
        </a>
        <h4 class="text-xl font-semibold">Question Medias Table</h4>
    </div>
    <div class="flex justify-between items-center py-2">
        <div class="text-gray-700 text-base">
        Lakukan sinkronisasi secara berkala untuk sheet <span class="text-lg font-semibold">{{ $sheetname->name }}</span>.
        </div>
        <!-- start::Buttons With Icons Ping -->
        <button 
        @click="window.dispatchEvent(new CustomEvent('open-confirm-modal', { 
            detail: { 
                title: 'Sinkronisasi untuk sheet {{ $sheetname->name }}!', 
                message: 'Apakah Anda yakin melanjutkan proses sinkronisasi?', 
                url: '{{ route('media.synchroQuestSingleSheet', $sheetname->slug) }}', 
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

    <table class="w-full whitespace-nowrap mb-8">
        <thead class="bg-secondary text-gray-100 font-bold text-center">
            <td class="py-2 pl-2">
                #
            </td>
            <td class="py-2 pl-2">
                GUID
            </td>
            <td class="py-2 pl-2">
                Question
            </td>
            <td class="py-2 pl-2">
                Image
            </td>
            <td class="py-2 pl-2">
                IMG Preview
            </td>
            <td class="py-2 pl-2">
                Audio
            </td>
            <td class="py-2 pl-2">
                AUD Preview
            </td>
            <td class="py-2 pl-2">
                Action
            </td>
        </thead>
        <tbody class="text-sm">
          @forelse ($questions as $question)

          <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
            <td class="py-3 pl-2">
              {{ $loop->iteration }}
            </td>
            <td class="py-3 pl-2 capitalize truncate max-w-[100px]">
                {{ $question->guid }}
            </td>
            <td class="py-3 pl-2 truncate max-w-[200px]">
                {{ $question->question }}
            </td>
            <td class="py-3 pl-2">
                <input type="checkbox" 
               name="image" 
               value="{{ $question->image }}" 
               class="rounded focus:ring-0 ml-2 checked:bg-green-500"
               disabled
               @if($question->image) checked @endif>
            </td>
            <td class="py-3 pl-2 justify-items-center text-center">
                @php
                    $image = $question->filemedias->where('type', 'image')->first();
                @endphp
                @if ($image)
                @php
                    $filePath = public_path("uploads/{$image->type}/{$image->name}");
                    $lastModified = file_exists($filePath) ? filemtime($filePath) : time();
                @endphp
                    <img src="{{ asset('uploads/image/' . $image->name) }}?v={{ $lastModified }}" alt="Image Preview" width="50">
                @elseif ($question->image)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class=" text-sm text-yellow-600">Warning</span>
                @else
                    <span>None.</span>
                @endif
            </td>
            <td class="py-3 pl-2">
                <input type="checkbox" 
               name="audio" 
               value="{{ $question->audio }}" 
               class="rounded focus:ring-0 ml-2 checked:bg-green-500"
               disabled
               @if($question->audio) checked @endif>
            </td>
            <td class="py-3 pl-2 justify-items-center text-center">
                @php
                    $audio = $question->filemedias->where('type', 'audio')->first();
                @endphp
                @if ($audio)
                    @php
                        $filePath = public_path("uploads/{$audio->type}/{$audio->name}");
                        $lastModified = file_exists($filePath) ? filemtime($filePath) : time();
                    @endphp
                    <audio controls>
                        <source src="{{ asset('uploads/audio/' . $audio->name) }}?v={{ $lastModified }}" type="audio/mpeg">
                        Your browser does not support the audio tag.
                    </audio>
                    @elseif ($question->audio)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class=" text-sm text-yellow-600">Warning</span>
                @else
                    <span>None.</span>
                @endif
            </td>
            <td class="py-3 pl-2">
                <a href="{{ route('media.edit', $question->guid) }}" class="flex items-center bg-primary hover:bg-opacity-90 max-w-min px-2 py-1 mr-2 text-gray-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 animate-bounce" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span>Update File</span>
                </a>
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

  <x-route-confirm></x-route-confirm>

  </x-layout>