<!-- Start:: Pre-Submit Confirmation Modal -->
<div 
x-data="{ showConfirmModal: false, formId: '', title: '', message: '' }" 
@open-pre-submit-modal.window="
    showConfirmModal = true;
    formId = $event.detail.formId;
    title = $event.detail.title;
    message = $event.detail.message;
" 
x-show="showConfirmModal" 
x-transition.opacity
x-transition:enter.duration.100ms
x-transition:leave.duration.300ms
x-cloak
class="fixed top-0 left-0 z-50 bg-black bg-opacity-70 h-screen w-full flex items-center justify-center"
>
<div 
    @click.away="showConfirmModal = false" 
    class="relative w-3/4 sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4 bg-white p-10 rounded-lg shadow-xl"
>
    <span 
        @click="showConfirmModal = false"
        class="absolute right-2 top-1 text-xl cursor-pointer hover:text-gray-600" 
        title="Close"
    >
        &#x2715
    </span>
    <h2 class="text-center text-lg font-bold mb-4" x-text="title"></h2>
    <p class="text-center text-lg p-4" x-text="message"></p>
    <div class="flex items-center justify-center space-x-4 mt-6">
        <button 
            @click="document.getElementById(formId).submit(); showConfirmModal = false;" 
            class="bg-green-500 hover:bg-green-600 w-20 py-1 text-gray-100 rounded transition duration-150"
        >
            Continue
        </button>
        <button 
            @click="showConfirmModal = false" 
            class="bg-red-500 hover:bg-red-600 w-20 py-1 text-gray-100 rounded transition duration-150">
            Cancel
        </button>
    </div>
</div>
</div>
<!-- End:: Pre-Submit Confirmation Modal -->