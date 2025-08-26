<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- start::Form Layouts -->
    <div class="bg-white p-4 grid-cols-2 gap-8 rounded-lg shadow-xl py-8 mt-12">
        <!-- start:: Horizontal Form Layout -->
        <div>
            <h4 class="text-xl capitalize">Design Multiple Choice Bundle Question</h4>
            <div class="mt-6">
                <form id="createForm" action="{{ route('builder.store_bundle_mc') }}" method="POST">
                    @csrf <!-- Token untuk keamanan CSRF -->

                    @foreach (range(1, $questionAmount) as $i)
                <div class="mb-6 border-b py-4">
                    <h5 class="text-lg font-semibold mb-2">Question {{ $i }}</h5>
                    <div class="flex flex-col my-4">
                        <label for="questions[{{ $i }}][text]">Question Text</label>
                        <input
                            type="text"
                            name="questions[{{ $i }}][text]"
                            id="questions[{{ $i }}][text]"
                            value="{{ old('questions.' . $i . '.text') }}"
                            class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
                            placeholder="Write your question"
                        >
                        @error('questions.' . $i . '.text')
                            <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="questions[{{ $i }}][answer]">Correct Answer</label>
                        <input
                            type="text"
                            name="questions[{{ $i }}][answer]"
                            id="questions[{{ $i }}][answer]"
                            value="{{ old('questions.' . $i . '.answer') }}"
                            class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
                            placeholder="Write the correct answer for the question"
                        >
                        @error('questions.' . $i . '.answer')
                            <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col my-4">
    <label for="questions[{{ $i }}][answer_2]" class="block text-gray-700 text-sm font-medium mb-1">Choice Option 2</label>
    <input
        name="questions[{{ $i }}][answer_2]"
        id="questions[{{ $i }}][answer_2]"
        value="{{ old('questions.' . $i . '.answer_2') }}"
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
        placeholder="Write the choice option 2 for the question"
    >
    @error('questions.' . $i . '.answer_2')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4 p-4 border border-gray-200 rounded-lg bg-gray-50"> {{-- Tambahan styling untuk membedakan blok --}}
    <label for="questions[{{ $i }}][why_a2]" class="block text-gray-700 text-sm font-bold mb-1">Why Choice Option 2 is Wrong</label> {{-- Label lebih tebal --}}
    <textarea
        name="questions[{{ $i }}][why_a2]"
        id="questions[{{ $i }}][why_a2]"

        rows="3" {{-- Mengatur tinggi textarea --}}
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0 resize-y" {{-- resize-y agar bisa diresize vertikal --}}
        placeholder="Write the explanation (opsional)"
    >{{ old('questions.' . $i . '.why_a2') }}</textarea> {{-- Value di dalam tag textarea --}}
    @error('questions.' . $i . '.why_a2')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4">
    <label for="questions[{{ $i }}][answer_3]" class="block text-gray-700 text-sm font-medium mb-1">Choice Option 3</label>
    <input
        name="questions[{{ $i }}][answer_3]"
        id="questions[{{ $i }}][answer_3]"
        value="{{ old('questions.' . $i . '.answer_3') }}"
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
        placeholder="Write the choice option 3 for the question (opsional)"
    >
    @error('questions.' . $i . '.answer_3')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4 p-4 border border-gray-200 rounded-lg bg-gray-50"> {{-- Tambahan styling untuk membedakan blok --}}
    <label for="questions[{{ $i }}][why_a3]" class="block text-gray-700 text-sm font-bold mb-1">Why Choice Option 3 is Wrong</label> {{-- Label lebih tebal --}}
    <textarea
        name="questions[{{ $i }}][why_a3]"
        id="questions[{{ $i }}][why_a3]"
        rows="3" {{-- Mengatur tinggi textarea --}}
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0 resize-y" {{-- resize-y agar bisa diresize vertikal --}}
        placeholder="Write the explanation (opsional)"
    >{{ old('questions.' . $i . '.why_a3') }}</textarea> {{-- Value di dalam tag textarea --}}
    @error('questions.' . $i . '.why_a3')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4">
    <label for="questions[{{ $i }}][answer_4]" class="block text-gray-700 text-sm font-medium mb-1">Choice Option 4</label>
    <input
        name="questions[{{ $i }}][answer_4]"
        id="questions[{{ $i }}][answer_4]"
        value="{{ old('questions.' . $i . '.answer_4') }}"
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
        placeholder="Write the choice option 4 for the question (opsional)"
    >
    @error('questions.' . $i . '.answer_4')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4 p-4 border border-gray-200 rounded-lg bg-gray-50"> {{-- Tambahan styling untuk membedakan blok --}}
    <label for="questions[{{ $i }}][why_a4]" class="block text-gray-700 text-sm font-bold mb-1">Why Choice Option 4 is Wrong</label> {{-- Label lebih tebal --}}
    <textarea
        name="questions[{{ $i }}][why_a4]"
        id="questions[{{ $i }}][why_a4]"
        rows="3" {{-- Mengatur tinggi textarea --}}
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0 resize-y" {{-- resize-y agar bisa diresize vertikal --}}
        placeholder="Write the explanation (opsional)"
    >{{ old('questions.' . $i . '.why_a4') }}</textarea> {{-- Value di dalam tag textarea --}}
    @error('questions.' . $i . '.why_a4')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4">
    <label for="questions[{{ $i }}][answer_5]" class="block text-gray-700 text-sm font-medium mb-1">Choice Option 5</label>
    <input
        name="questions[{{ $i }}][answer_5]"
        id="questions[{{ $i }}][answer_5]"
        value="{{ old('questions.' . $i . '.answer_5') }}"
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
        placeholder="Write the choice option 5 for the question (opsional)"
    >
    @error('questions.' . $i . '.answer_5')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>

<div class="flex flex-col my-4 p-4 border border-gray-200 rounded-lg bg-gray-50"> {{-- Tambahan styling untuk membedakan blok --}}
    <label for="questions[{{ $i }}][why_a5]" class="block text-gray-700 text-sm font-bold mb-1">Why Choice Option 5 is Wrong</label> {{-- Label lebih tebal --}}
    <textarea
        name="questions[{{ $i }}][why_a5]"
        id="questions[{{ $i }}][why_a5]"
        rows="3" {{-- Mengatur tinggi textarea --}}
        class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0 resize-y" {{-- resize-y agar bisa diresize vertikal --}}
        placeholder="Write the explanation (opsional)"
    >{{ old('questions.' . $i . '.why_a5') }}</textarea> {{-- Value di dalam tag textarea --}}
    @error('questions.' . $i . '.why_a5')
        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
    @enderror
</div>
                </div>
            @endforeach

            @if(isset($defaultValues))
                @foreach ($defaultValues as $key => $value)
                    <input type="hidden" name="defaults[{{ $key }}]" value="{{ $value }}">
                @endforeach
            @endif

                    <div class="flex gap-2 ml-24 mt-6">
                        <button type="reset" class="bg-secondary bg-opacity-20 hover:bg-opacity-40 rounded-lg px-6 py-1.5 text-secondary hover:shadow-xl transition duration-150">Reset</button>

                        <button type="button"
                            @click="window.dispatchEvent(new CustomEvent('open-pre-submit-modal', { 
                            detail: { 
                                formId: 'createForm', 
                                title: 'Konfirmasi Proses Create!', 
                                message: 'Apakah Anda yakin ingin menambahkan data bundle ini?' 
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

</x-layout>