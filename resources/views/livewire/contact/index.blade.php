<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="mt-32 mx-12 md:mx-32 2 mb-8">
        <div class="flex flex-col md:flex-row justify-center gap-4">
            {{-- form --}}
            <div class="p-4 bg-[#181818] shadow-lg space-y-4 rounded-lg md:w-[70%] w-full">
                {{-- name --}}
                <div class="w-full">
                    <form class="w-full">
                        <div class="">
                            <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                            <input wire:model='name' type="text" id="name" 
                            class="text-sm rounded-lg block w-full p-2.5 bg-[#222] text-white border-none
                            focus:ring-red-500 focus:border-red-500
                                    @error('name') border-red-600 @enderror" 
                            required />
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
    
                {{-- email phone --}}
                <div class="flex w-full">
                    <form class="w-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 w-full">
                            {{-- email --}}
                            <div class="">
                                <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                                <input wire:model='email' type="email" id="email" 
                                class="text-sm rounded-lg block w-full p-2.5 bg-[#222] text-white border-none
                                focus:ring-red-500 focus:border-red-500
                                        @error('email') border-red-600 @enderror" 
                                required />
                                @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
    
                            {{-- phone --}}
                            <div class="">
                                <label for="phone" class="block mb-2 text-sm font-medium text-white">Phone</label>
                                <input wire:model='phone' type="text" id="phone" 
                                class="text-sm rounded-lg block w-full p-2.5 bg-[#222] text-white border-none
                                focus:ring-red-500 focus:border-red-500
                                        @error('phone') border-red-600 @enderror" 
                                required />
                                @error('phone')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
        
                {{-- message --}}
                <div class="w-full">
                    <div class="w-full">
                        <label for="message" class="block mb-2 text-sm font-medium text-white">Message</label>
                        <textarea  wire:model="message" id="message" rows="4"
                        class="text-sm rounded-lg block w-full p-2.5 bg-[#222] text-white border-none
                        focus:ring-red-500 focus:border-red-500
                                @error('message') border-red-600 @enderror" 
                        required></textarea>
                        @error('message')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
    
                {{-- button --}}
                <div class="flex justify-start">
                    <button wire:click="placeContact" 
                        class="text-center text-white bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 font-medium rounded-lg text-sm py-2.5 px-6">
                        Send  Message
                    </button>
                </div>
    
                {{-- message --}}
                @if (session()->has('message'))
                    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 rounded-lg shadow-sm text-white/70 bg-[#222]" role="alert">
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 rounded-lg bg-green-800 text-green-200">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">{{ session('message') }}</div>
                        <button wire:click="dismissToast" type="button" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 inline-flex items-center justify-center h-8 w-8 text-gray-500 hover:text-white bg-[#181818] hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            {{-- location --}}
            <div class="block w-full md:w-[30%]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.1587982564147!2d110.38934107412027!3d-7.772980277107354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a583a61290129%3A0x668d51a34b3a7ee8!2sSMK%20Negeri%202%20Depok%20-%20Sleman!5e0!3m2!1sid!2sid!4v1743495523443!5m2!1sid!2sid"
                class="w-full h-full rounded-lg" 
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        {{-- info --}}
        <div class="flex flex-wrap justify-center lg:gap-6 pt-6">   
            {{-- telp --}}
            <div class="block p-6 rounded-lg text-center w-full md:w-[30%]">
                <i class="fas fa-phone-alt text-base md:text-lg lg:text-xl text-red-500"></i> 
                <h5 class="text-sm md:text-base lg:text-lg font-bold tracking-tight text-red-500">Phone</h5>
                <p class="font-normal text-white text-sm md:text-base lg:text-base">(+62) 8123-4567-890</p>
            </div>

            <div class="border-l border-red-500"></div>

            {{-- email --}} 
            <div class="block p-6 rounded-lg text-center w-full md:w-[30%]">
                <i class="fas fa-envelope text-base md:text-lg lg:text-xl text-red-500"></i> 
                    <h5 class="text-sm md:text-base lg:text-lg font-bold tracking-tight text-red-500">Email</h5>
                <p class="font-normal text-white text-sm md:text-base lg:text-base">admin@example.com</p>
            </div>

            <div class="border-l border-red-500"></div>

            {{-- loc --}}
            <div class="block p-6 rounded-lg text-center w-full md:w-[30%]">
                <i class="fas fa-map-marker-alt text-base md:text-lg lg:text-xl text-red-500"></i> 
                <h5 class="text-sm md:text-base lg:text-lg font-bold tracking-tight text-red-500">Address</h5>
                <p class="font-normal text-white text-sm md:text-base lg:text-base">SMK N 2 Depok</p>
            </div>
        </div>        
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</div>
