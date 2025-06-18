<!-- Start:: Dynamic Confirmation Modal -->
<div 
    x-data="{ 
        showModal: false, 
        title: '', 
        message: '', 
        actionUrl: '', 
        method: 'POST', 
        buttonText: '' 
    }" 
    @open-confirm-modal.window="
        showModal = true; 
        title = $event.detail.title; 
        message = $event.detail.message; 
        actionUrl = $event.detail.url; 
        method = $event.detail.method || 'POST'; 
        buttonText = $event.detail.buttonText || 'Konfirmasi';
    " 
    x-show="showModal" 
    x-transition.opacity
    x-transition:enter.duration.100ms
    x-transition:leave.duration.300ms
    x-cloak
    class="fixed top-0 left-0 z-50 bg-black bg-opacity-70 h-screen w-full flex items-center justify-center"
>
    <div 
        @click.away="showModal = false" 
        class="relative w-3/4 sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4 bg-white p-10 rounded-lg shadow-xl"
    >
        <span 
            @click="showModal = false"
            class="absolute right-2 top-1 text-xl cursor-pointer hover:text-gray-600" 
            title="Close"
        >
            &#x2715
        </span>
        <h2 class="text-center text-lg font-bold mb-4" x-text="title"></h2>
        <p class="text-center text-lg p-4" x-text="message"></p>
        <div class="flex items-center justify-center space-x-4 mt-6">
            <template x-if="method === 'GET'">
                <button 
                    @click="window.location.href = actionUrl; showModal = false;"
                    class="bg-green-500 hover:bg-green-600 w-20 py-1 text-gray-100 rounded transition duration-150"
                    x-text="buttonText"></button>
            </template>
            <template x-if="method !== 'GET'">
                <form :action="actionUrl" method="POST">
                    @csrf
                    <input type="hidden" name="_method" :value="method">
                    <button 
                        type="submit" 
                        class="bg-green-500 hover:bg-green-600 w-20 py-1 text-gray-100 rounded transition duration-150"
                        x-text="buttonText"></button>
                </form>
            </template>
            <button 
                @click="showModal = false" 
                class="bg-red-500 hover:bg-red-600 w-20 py-1 text-gray-100 rounded transition duration-150">
                Batal
            </button>
        </div>
    </div>
</div>
<!-- End:: Dynamic Confirmation Modal -->
