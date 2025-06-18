<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
  
    @if (isset($success))
    <div id="alert-success"
    role="alert"
    class="mb-5 w-full flex items-center justify-between bg-green-100 px-6 py-2 rounded-lg border border-green-300">
      <div class="flex items-center space-x-6">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <div class="flex flex-col justify-center">
              <span class="text-green-600 font-bold">Success</span>
              <span class="text-sm text-green-600">{{ $success }}</span>
          </div>
      </div>
      <button 
      type="button"
        onclick="document.getElementById('alert-success').remove();"
       class="text-xl text-gray-400 hover:text-gray-500" title="Close">&#10005;</button>
  </div>
  @endif

 <div class="bg-white rounded-lg px-8 py-6 overflow-x-scroll custom-scrollbar">
    <div class="flex justify-between items-center border-b pb-4 mb-4">
      <h4 class="text-xl font-semibold">Created Question Design</h4>
      </div>
  
    <!-- start::Header Rounded Top -->
    <table id="data-table" class="w-full whitespace-nowrap my-4">
        <thead class="border-b border-gray-300 bg-gray-800 text-gray-100">
            @foreach(array_keys($question) as $header)
                <th class="p-2">
                    {{ $header }}
                </th>
            @endforeach
        </thead>
        <tbody>
            <tr class="border-b border-gray-200">
            @foreach($question as $value)
                {{-- @foreach($row as $value) --}}
                    <td class="p-2">
                        {{ $value }}
                    </td>
                {{-- @endforeach --}}
                @endforeach
            </tr>
            
        </tbody>
    </table>
    <!-- end::Header Rounded Top -->

    <div class="flex gap-2 ml-8 mt-6">
        <!-- start::Rounded Buttons Colors Secondary -->
        <a href="{{ url()->previous() }}" class="bg-secondary hover:bg-secondary-dark rounded-lg px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">Back</a>
        <!-- end::Rounded Buttons Colors Secondary -->

        <!-- start::Rounded Buttons Outline Colors Secondary -->
    <button id="copy-btn" class="border border-secondary hover:bg-secondary text-secondary hover:text-gray-100 rounded-lg px-6 py-1.5 hover:shadow-xl transition duration-150">Copy</button>
    <!-- end::Rounded Buttons Outline Colors Secondary -->
    </div>

    
</div>

<script>
    document.getElementById('copy-btn').addEventListener('click', function () {
        const table = document.getElementById('data-table');
        let clipboardText = "";
  
        // Loop through each row, skipping the header
        for (let i = 1; i < table.rows.length; i++) {
            let rowText = [];
            for (let j = 0; j < table.rows[i].cells.length; j++) {
                rowText.push(table.rows[i].cells[j].innerText);
            }
            clipboardText += rowText.join("\t") + "\n"; // Tab-separated values
        }
  
        // Check if navigator.clipboard is supported
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(clipboardText).then(function () {
                alert("Data copied to clipboard!");
            }).catch(function (error) {
                console.error("Failed to copy text: ", error);
            });
        } else {
            // Fallback: Create a temporary textarea element
            const textarea = document.createElement('textarea');
            textarea.value = clipboardText;
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                alert("Data copied to clipboard!");
            } catch (error) {
                console.error("Fallback copy failed: ", error);
            }
            document.body.removeChild(textarea);
        }
    });
  </script>

  </x-layout>