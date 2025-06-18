<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Advance Table Filters -->
    <div x-data="{ filter: false }" class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar">
      <div class="flex justify-between items-center border-b pb-4 mb-4">
        <h4 class="text-xl font-semibold">Spreadsheets Table</h4>
        </div>
    <!-- start::Buttons With Icons Add -->
    <a href="{{ route('spreadsheet.create') }}" class="flex space-x-2 items-center justify-center bg-green-500 hover:bg-green-600 rounded-sm px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        <span>Add New Spreadsheet</span>
    </a>
    <!-- end::Buttons With Icons Add -->
    
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
                  Title
              </td>
              <td class="py-2 pl-2">
                  Description
              </td>
              <td class="py-2 pl-2">
                  Action
              </td>
          </thead>
          <tbody class="text-sm">
            @forelse ($spreadsheets as $spreadsheet)
            <tr class="bg-gray-100 hover:bg-primary hover:bg-opacity-20 transition duration-200">
              <td class="py-3 pl-2">
                {{ $loop->iteration }}
              </td>
              <td class="py-3 pl-2 capitalize">
                  {{ $spreadsheet->title }}
              </td>
              <td class="py-3 pl-2">
                  {{ $spreadsheet->description }}
              </td>
              <td class="py-3 pl-2 flex items-center space-x-2">
                  <button 
                        @click="window.dispatchEvent(new CustomEvent('open-modal', { detail: { 
                            id: {{ $spreadsheet->id }},
                            title: '{{ $spreadsheet->title }}',
                            slug: '{{ $spreadsheet->slug }}',
                            description: '{{ $spreadsheet->description }}',
                            documentId: '{{ $spreadsheet->documentId }}',
                            apiKey: '{{ $spreadsheet->apiKey }}',
                            token: '{{ $spreadsheet->token }}',
                            } }))" 
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary hover:text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                </button>
                  <a href="{{ route('spreadsheet.edit', $spreadsheet->slug) }}">
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
                        url: '{{ route('spreadsheet.destroy', $spreadsheet->id) }}', 
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
            <span class="mx-2" x-text="detail.title"></span>
            <button
            @click="showModal = false"
             class="font-bold hover:text-primary-dark" title="close">&#x2715</button>
        </div>
        <div class="p-8 rounded-lg shadow-xl">
            
            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="slug">
                    <span class="font-bold text-green-600">Slug</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.slug"
                        class="text-sm bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  ></span>
                </div>
            </div>
            
            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="description">
                    <span class="font-bold text-green-600">Description</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.description"
                        class="text-sm bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  ></span>
                </div>
            </div>
            
            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="apiKey">
                    <span class="font-bold text-green-600">API Key</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.apiKey"
                        class="text-sm bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  ></span>
                </div>
            </div>

            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="apiKey">
                    <span class="font-bold text-green-600">Token</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.token"
                        class="text-sm bg-gray-200 hover:bg-gray-500 text-gray-500 hover:text-gray-200 px-2 py-1 rounded-lg transition duration-200 cursor-default"
                  ></span>
                </div>
            </div>

            <div class="flex items-start my-4">
                <label class="w-20 me-5 leading-6" for="documentId">
                    <span class="font-bold text-green-600">Document ID</span>
                </label>
                <div class="flex-1 ml-4">
                    <span x-text="detail.documentId"
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
  
  </x-layout>