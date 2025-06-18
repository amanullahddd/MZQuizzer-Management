<x-layout>
        <x-slot:title>{{ $title }}</x-slot:title>

        <!-- start::Custom Cards -->
        <div class="bg-white p-4 rounded-lg shadow-xl py-8 mt-12">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <h4 class="text-xl font-semibold">Spreadsheet Active</h4>
            </div>
            <!-- start::Buttons With Icons Download Bounce -->
            <a href="{{ route('spreadsheet.setActive') }}" class="flex space-x-2 items-center justify-center bg-blue-700 hover:bg-blue-800 rounded-sm px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                <span>Pilih Spreadsheet</span>
            </a>
            <!-- end::Buttons With Icons Download Bounce -->
            <!-- start::Stats Custom Cards -->
            <div class="mt-6">
                <p class="mb-2">Status</p>
                <div class="grid grid-cols-2">

                    <div class="h-24 flex items-center justify-between border border-gray-400 border-l-8 border-l-green-500 shadow-xl rounded-lg px-4">
                        <div>
                            <p class="uppercase text-sm text-green-500 font-bold">{{ $spreadsheet->title }}</p>
                            <p class="font-bold text-gray-800 text-lg">{{ $spreadsheet->description }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>

                </div>
            </div>
            <!-- end::Stats Custom Cards -->
        </div>
</x-layout>