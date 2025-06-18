<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Form Layouts -->
    <div class="bg-white p-4 grid-cols-2 gap-8 rounded-lg shadow-xl py-8 mt-12">
        <!-- start:: Horizontal Form Layout -->
        <div>
            <h4 class="text-xl capitalize">Design True or False Question</h4>
            <div class="mt-6">
                <form id="createForm" action="{{ route('builder.store_truefalse') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token untuk keamanan CSRF -->

                    <div class="flex flex-col my-4">
                        <label for="question">Question</label>
                            <input 
                                type="text" 
                                name="question" 
                                id="question"
                                value="{{ old('question') }}"
                                class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Write your question"
                            >
                            @error('question')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="time">Time Limit (in seconds)</label>
                            <input 
                                type="number" 
                                name="time" 
                                id="time"
                                value="{{ old('time') }}"
                                class="bflex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Time limit to answer the question (opsional)"
                            >
                            @error('time')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                        </div>
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="encode">Encode Question and Answer</label>
                            <label for="encode_0">
                                <input 
                                    type="radio" 
                                    name="encode" 
                                    id="encode_0"
                                    value="0" 
                                    class="ml-2 focus:ring-0"
                                    checked
                                >
                                Do not encode</label>
                            <label for="encode_1">
                                <input 
                                    type="radio" 
                                    name="encode" 
                                    id="encode_1"
                                    value="1" 
                                    class="ml-2 focus:ring-0" 
                                >
                                Encode</label>
                                
                            
                            @error('encode')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="image">Image</label>
                            <label for="image_0">
                                <input 
                                    type="radio" 
                                    name="image" 
                                    id="image_0"
                                    value="0" 
                                    class="ml-2 focus:ring-0"
                                    checked
                                >
                                No Image</label>
                            <label for="image_1">
                                <input 
                                    type="radio" 
                                    name="image" 
                                    id="image_1"
                                    value="1" 
                                    class="ml-2 focus:ring-0" 
                                >
                                Has Image</label>
                            @error('image')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex items-center gap-4 my-4">
                        <!-- Input File -->
                        <div class="w-1/2">
                            <label class="block mb-2 font-medium text-gray-900 dark:text-white" for="imageFile">
                                Upload Image
                            </label>
                            <input accept="image/*" 
                                onchange="previewFile(this, 'imagePreview')" 
                                class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                       dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="image_help" 
                                id="imageFile" 
                                name="imageFile"
                                disabled
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
                    
                    <div class="flex flex-col my-4">
                        <label for="audio">Audio</label>
                            <label for="audio_0">
                                <input 
                                    type="radio" 
                                    name="audio" 
                                    id="audio_0"
                                    value="0" 
                                    class="ml-2 focus:ring-0"
                                    checked
                                >
                                No Audio</label>
                            <label for="audio_1">
                                <input 
                                    type="radio" 
                                    name="audio" 
                                    id="audio_1"
                                    value="1" 
                                    class="ml-2 focus:ring-0" 
                                >
                                Has Audio</label>
                            @error('audio')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex items-center gap-4 my-4">
                        <!-- Input File -->
                        <div class="w-1/2">
                            <label class="block mb-2 font-medium text-gray-900 dark:text-white" for="audioFile">Upload Audio</label>
                            <input accept="audio/*"
                            class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="audio_help" id="audioFile" name="audioFile" disabled type="file">
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

                    <div class="flex flex-col my-4">
                        <label for="answer">Answer</label>
                            <label for="true">
                                <input 
                                    type="radio" 
                                    name="answer" 
                                    id="true"
                                    value="0" 
                                    class="ml-2 focus:ring-0"
                                    checked
                                >
                                True</label>
                            <label for="false">
                                <input 
                                    type="radio" 
                                    name="answer" 
                                    id="false"
                                    value="1" 
                                    class="ml-2 focus:ring-0" 
                                >
                               False</label>
                                
                            @error('answer')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="whyWrong">Why Wrong Answer is Wrong</label>
                            <input 
                                name="whyWrong" 
                                id="whyWrong" 
                                value="{{ old('whyWrong') }}"
                                class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="Write the explanation (opsional)"
                            >
                            @error('whyWrong')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="standards">Standards</label>
                            <input 
                                type="text" 
                                name="standards" 
                                id="standards"
                                value="{{ old('standards') }}"
                                class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0" 
                                placeholder="For user readability (opsional)"
                            >
                            @error('standards')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>
                    
                    <div class="flex flex-col my-4">
                        <label for="scope">Scope of the Reward/Penalty Effect</label>
                            <label for="member">
                                <input 
                                    type="radio" 
                                    name="scope" 
                                    id="member"
                                    value="0" 
                                    class="ml-2 focus:ring-0"
                                    checked
                                >
                                All Party Member</label>
                            <label for="leader">
                                <input 
                                    type="radio" 
                                    name="scope" 
                                    id="leader"
                                    value="1" 
                                    class="ml-2 focus:ring-0" 
                                >
                               Only Leader</label>
                                
                            @error('scope')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <!-- start::Rounded Select -->
                            <label for="reward_type">Reward Type</label>
                            <select
                                name="reward_type"
                                id="reward_type"
                                class="mt-2 py-1 border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 rounded-lg
                                 "
                            >
                                <option value="None">None</option>
                                <option value="Gold">Gold</option>
                                <option value="HP">HP</option>
                                <option value="MP">MP</option>
                                <option value="XP">XP</option>
                                <option value="TP">TP</option>
                                <option value="Item">Item</option>
                                <option value="Weapon">Weapon</option>
                                <option value="Armor">Armor</option>
                                <option value="Skill">Learn Skill</option>
                                <option value="MHP">+ Max HP</option>
                                <option value="MMP">+ Max MP</option>
                                <option value="ATK">+ ATK</option>
                                <option value="DEF">+ DEF</option>
                                <option value="AddState">Add State</option>
                                <option value="RemoveState">Remove State</option>
                                <option value="Enemy">Enemy Troop</option>
                            </select>
                        <!-- end::Rounded Select -->
                            @error('reward_type')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="reward_id">Reward ID</label>
                            <input 
                                type="number" 
                                name="reward_id" 
                                id="reward_id"
                                min="0"
                                value="{{ old('reward_id') }}"
                                class="flex-1 py-1 border-green-500 mt-1 rounded focus:border-green-500 focus:outline-none focus:ring-0" 
                                placeholder="Pick ID from RPG Maker MZ Database"
                            >
                            @error('reward_id')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="reward_amount">Reward Amount</label>
                            <input 
                                type="number" 
                                name="reward_amount" 
                                id="reward_amount"
                                value="{{ old('reward_amount') }}"
                                class="flex-1 py-1 border-green-500 mt-1 rounded focus:border-green-500 focus:outline-none focus:ring-0" 
                                placeholder="Amount of reward you get"
                            >
                            @error('reward_amount')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <!-- start::Rounded Select -->
                            <label for="penalty_type">Penalty Type</label>
                            <select
                                name="penalty_type"
                                id="penalty_type"
                                class="mt-2 py-1 border-red-500 focus:outline-none focus:ring-0 focus:border-red-500 rounded-lg
                                 "
                            >
                                <option value="None">None</option>
                                <option value="Gold">Gold</option>
                                <option value="HP">HP</option>
                                <option value="MP">MP</option>
                                <option value="XP">XP</option>
                                <option value="TP">TP</option>
                                <option value="Item">Item</option>
                                <option value="Weapon">Weapon</option>
                                <option value="Armor">Armor</option>
                                <option value="Skill">Learn Skill</option>
                                <option value="MHP">+ Max HP</option>
                                <option value="MMP">+ Max MP</option>
                                <option value="ATK">+ ATK</option>
                                <option value="DEF">+ DEF</option>
                                <option value="AddState">Add State</option>
                                <option value="RemoveState">Remove State</option>
                                <option value="Enemy">Enemy Troop</option>
                            </select>
                        <!-- end::Rounded Select -->
                            @error('penalty_type')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="penalty_id">Penalty ID</label>
                            <input 
                                type="number" 
                                name="penalty_id" 
                                id="penalty_id"
                                min="0"
                                value="{{ old('penalty_id') }}"
                                class="flex-1 py-1 border-red-500 mt-1 rounded focus:border-red-500 focus:outline-none focus:ring-0" 
                                placeholder="Pick ID from RPG Maker MZ Database"
                            >
                            @error('penalty_id')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="penalty_amount">Penalty Amount</label>
                            <input 
                                type="number" 
                                name="penalty_amount" 
                                id="penalty_amount"
                                value="{{ old('penalty_amount') }}"
                                class="flex-1 py-1 border-red-500 mt-1 rounded focus:border-red-500 focus:outline-none focus:ring-0" 
                                placeholder="Amount of penalty you get"
                            >
                            @error('penalty_amount')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex gap-2 ml-24 mt-6">
                        <button type="reset"  class="bg-secondary bg-opacity-20 hover:bg-opacity-40 rounded-lg px-6 py-1.5 text-secondary hover:shadow-xl transition duration-150">Reset</button>

                        <button type="button"
                        @click="window.dispatchEvent(new CustomEvent('open-pre-submit-modal', { 
                            detail: { 
                                formId: 'createForm', 
                                title: 'Konfirmasi Proses Create!', 
                                message: 'Apakah Anda yakin ingin menambahkan data ini?' 
                            }
                        }))"
                        class="bg-primary hover:bg-primary-dark rounded-lg px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::Vertical Form Layout -->
    </div>

    <!-- start::Confirmation Modal -->
  <x-form-confirm></x-form-confirm>
  <!-- end::Confirmation Modal -->


<x-input-disabled></x-input-disabled>
<x-preview-file></x-preview-file>

</x-layout>