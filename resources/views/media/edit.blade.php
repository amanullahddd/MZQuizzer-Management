<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- start::Form Layouts -->
    <div class="bg-white p-8 rounded-lg shadow-xl py-8 mt-12">
        <!-- start:: Horizontal Form Layout -->
        <div>
            <h4 class="text-xl capitalize">Edit Data Media File</h4>
            <p class="text-xl font-semibold">Q : {{ $question->question }}</p>

            <div class="mt-6">
                <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token untuk keamanan CSRF -->

                    <input type="hidden" name="questionmedia_id" value="{{ $question->id }}">
                    @if($question->image) 
                        <input type="hidden" name="image" value="1">
                    @endif
                    @if($question->audio) 
                        <input type="hidden" name="audio" value="1">
                    @endif

                    <div class="flex items-center gap-4 my-4">
                        <!-- Input File -->
                        <div class="w-1/2">
                            <label class="block mb-2 font-medium text-gray-900 dark:text-white" for="imageFile">
                                Upload Image
                            </label>
                            <input accept="image/*" 
                                onchange="previewFile(this, 'imagePreview')" 
                                @if(!$question->image) disabled @endif
                                class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                       dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="image_help" 
                                id="imageFile" 
                                name="imageFile" 
                                type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">
                                SVG, PNG, JPG or GIF (MAX. 800x400px).
                            </p>
                            @error('imageFile')
                                <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Image Preview -->
                        <div class="w-1/2 flex justify-center">
                            <img id="imagePreview" src="/img/logo-only-cons-black.png" 
                                 alt="Image preview" 
                                 class="hidden w-64 h-auto rounded-lg border border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div class="flex items-center gap-4 my-4">
                        <!-- Input File -->
                        <div class="w-1/2">
                            <label class="block mb-2 font-medium text-gray-900 dark:text-white" for="audioFile">Upload Audio</label>
                            <input accept="audio/*" @if(!$question->audio) disabled @endif
                            class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="audio_help" id="audioFile" name="audioFile" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="audio_help">OGG, WAV, MP3 (MAX. 1MB).</p>
                            @error('audioFile')
                                <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Audio Preview -->
                        <div class="w-1/2 flex justify-center">
                            <audio 
                                id="audioPreview" 
                                controls
                                style="display: none"
                                class="w-3/4 rounded-lg border border-gray-300 shadow-sm">
                            </audio>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 ml-32 mt-6">
                        <a href="{{ route('media.question', $question->sheetname->slug) }}" class="bg-secondary bg-opacity-20 hover:bg-opacity-40 rounded-lg px-6 py-1.5 text-secondary hover:shadow-xl transition duration-150">Cancel</a>
                        <button type="submit" class="bg-primary hover:bg-primary-dark rounded-lg px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::Horizontal Form Layout -->

    </div>

    <x-preview-file></x-preview-file>

  </x-layout>