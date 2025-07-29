<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Form Layouts -->
    <div class="bg-white p-8 rounded-lg shadow-xl mt-12">
        <!-- start:: Horizontal Form Layout -->
        <div>
            <h4 class="text-xl capitalize">Tambahkan Data Spreadsheet Baru</h4>
            <div class="mt-6">
                <form id="createForm" action="{{ route('spreadsheet.store') }}" method="POST">
                    @csrf <!-- Token untuk keamanan CSRF -->

                    <div class="flex items-start my-4">
                        <label class="w-20 me-5 leading-6" for="title">Title</label>
                        <div class="flex-1 ml-4">
                            <input 
                                type="text" 
                                name="title" 
                                id="title"
                                value="{{ old('title') }}"
                                class="block w-full py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Document Title"
                            >
                            @error('title')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                        </div>
                    </div>
                    
                    <div class="flex items-start my-4">
                        <label class="w-20 me-5 leading-6" for="description">Description</label>
                        <div class="flex-1 ml-4">
                            <input 
                                name="description" 
                                id="description"
                                value="{{ old('description') }}"
                                class="block w-full py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Document Description"
                            >
                            @error('description')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                        </div>
                    </div>
                    
                    <div class="flex items-start my-4">
                        <label class="w-20 me-5 leading-6" for="documentId">Document ID</label>
                        <div class="flex-1 ml-4">
                            <input 
                                type="text" 
                                name="documentId" 
                                id="documentId"
                                value="{{ old('documentId') }}"
                                class="block w-full py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Document Id"
                            >
                            @error('documentId')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                        </div>
                    </div>
                    
                    <div class="flex items-start my-4">
                        <label class="w-20 me-5 leading-6" for="apiKey">Api Key</label>
                        <div class="flex-1 ml-4">
                            <input 
                                type="text" 
                                name="apiKey" 
                                id="apiKey"
                                value="{{ old('apiKey') }}"
                                class="block w-full py-1 border-gray-300 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Api Key"
                            >
                            @error('apiKey')
                            <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <input type="hidden" name="token" value="{{ random_int(100000, 999999) }}">
                    <input type="hidden" name="active" value="0">

                    <div class="flex gap-2 ml-24 mt-6">
                        <a href="{{ route('spreadsheet.index') }}" class="bg-secondary bg-opacity-20 hover:bg-opacity-40 rounded-lg px-6 py-1.5 text-secondary hover:shadow-xl transition duration-150">Cancel</a>

                        <button type="button" 
                        @click="window.dispatchEvent(new CustomEvent('open-pre-submit-modal', { 
                            detail: { 
                                formId: 'createForm', 
                                title: 'Konfirmasi Proses Create!', 
                                message: 'Apakah Anda yakin ingin menambahkan data ini?' 
                            }
                        }))"
                        class="bg-primary hover:bg-primary-dark rounded-lg px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::Horizontal Form Layout -->
    </div>

<!-- start::Confirmation Modal -->
    <x-form-confirm></x-form-confirm>
<!-- end::Confirmation Modal -->
  </x-layout>