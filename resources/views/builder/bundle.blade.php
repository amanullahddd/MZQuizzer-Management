<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    
    <!-- start::Form Layouts -->
    <div class="bg-white p-4 grid-cols-2 gap-8 rounded-lg shadow-xl py-8 mt-12">
        <!-- start:: Horizontal Form Layout -->
        <div>
            <h4 class="text-xl capitalize">Design Question Bundle</h4>
            <div class="mt-6">
                <form id="createForm" action="{{ route("builder.store_default") }}" method="POST">
                    @csrf <!-- Token untuk keamanan CSRF -->

                    <div class="flex flex-col my-4">
                        <!-- start::Rounded Select -->
                            <label for="quest_type">Question Type</label>
                            <select
                                name="quest_type"
                                id="quest_type"
                                class="mt-2 py-1 border-green-500 focus:outline-none focus:ring-0 focus:border-green-500 rounded-lg
                                 "
                            >
                                <option value="tf">True or False</option>
                                <option value="mc">Multiple Choice</option>
                                <option value="sa">Short Answer</option>
                            </select>
                        <!-- end::Rounded Select -->
                            @error('quest_type')
                        <p class="text-sm text-red-600 font-bold mt-2">{{ $message }}</p>
                    @enderror
                    </div>

                    <div class="flex flex-col my-4">
                        <label for="quest_amount">Question Amount</label>
                            <input 
                                type="number" 
                                name="quest_amount" 
                                id="quest_amount"
                                min="1"
                                max="20"
                                value="{{ old('quest_amount') }}"
                                class="flex-1 py-1 border-green-500 mt-1 rounded focus:border-green-500 focus:outline-none focus:ring-0" 
                                placeholder="How many questions in a bundle (20 max)"
                            >
                            @error('quest_amount')
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
                        <label for="encode">Encode Question and Answer (coming soon)</label>
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
                                    disabled 
                                >
                                Encode</label>
                            @error('encode')
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

                        <button type="submit"
                        class="bg-primary hover:bg-primary-dark rounded-lg px-6 py-1.5 text-gray-100 hover:shadow-xl transition duration-150">Next</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::Vertical Form Layout -->
    </div>

</x-layout>