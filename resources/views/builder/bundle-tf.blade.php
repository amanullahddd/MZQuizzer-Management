<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- start::Form Layouts -->
    <div class="bg-white p-4 grid-cols-2 gap-8 rounded-lg shadow-xl py-8 mt-12">
        <!-- start:: Horizontal Form Layout -->
        <div>
            <h4 class="text-xl capitalize">Design True or False Bundle Question</h4>
            <div class="mt-6">
                <form id="createForm" action="{{ route('builder.store_bundle_tf') }}" method="POST">
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
                        <label for="questions[{{ $i }}][answer]">Answer</label>
                        <div>
                            <label for="true_{{ $i }}">
                                <input
                                    type="radio"
                                    name="questions[{{ $i }}][answer]"
                                    id="true_{{ $i }}"
                                    value="0"
                                    class="ml-2 focus:ring-0"
                                    @if(old('questions.' . $i . '.answer') == '0') checked @else checked @endif
                                >
                                True
                            </label>
                            <label for="false_{{ $i }}">
                                <input
                                    type="radio"
                                    name="questions[{{ $i }}][answer]"
                                    id="false_{{ $i }}"
                                    value="1"
                                    class="ml-2 focus:ring-0"
                                    @if(old('questions.' . $i . '.answer') == '1') checked @endif
                                >
                                False
                            </label>
                        </div>
                        @error('questions.' . $i . '.answer')
                            <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="questions[{{ $i }}][whyWrong]">Why Wrong Answer is Wrong (Optional)</label>
                        <input
                            type="text"
                            name="questions[{{ $i }}][whyWrong]"
                            id="questions[{{ $i }}][whyWrong]"
                            value="{{ old('questions.' . $i . '.whyWrong') }}"
                            class="flex-1 py-1 border-gray-300 mt-1 rounded focus:border-gray-300 focus:outline-none focus:ring-0"
                            placeholder="Write the explanation (optional)"
                        >
                        @error('questions.' . $i . '.whyWrong')
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