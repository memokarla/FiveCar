<div>
    {{-- Stop trying to control. --}}

    {{-- carousel --}}
    <div id="default-carousel" class="top-0 left-0 w-screen h-screen z-0" data-carousel="slide">

        <!-- Carousel wrapper -->
        <div class="relative h-screen overflow-hidden"> 
            @foreach ($headers as $index => $header)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ Str::startsWith($header->image, 'images/') ? asset($header->image) : asset('storage/' . $header->image) }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                </div>
            @endforeach
        </div>

        {{-- form search --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg z-30">     
            <form class="max-w-md mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium text-white-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 z-50">
                        <svg class="w-4 h-4" xmlxmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" 
                    class="block w-full p-2 ps-10 placeholder-white/70 text-sm text-white text-center border-none rounded-lg backdrop-blur-lg bg-[rgba(0,0,0,0.5)] shadow-lg shadow-red-500/50 focus:ring-0 focus:bg-black/60 focus:ring-4 focus:ring-red-500/50 focus:border-red-500 focus:border-opacity-50 hover:shadow-red-500/50 transition-all duration-300 rounded-[80px]" 
                    wire:model.live="search" placeholder="Search Car..." required />
                </div>
            </form>    
        </div>

        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full p-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
        
    </div>

    {{-- category --}}
    <div class="flex gap-8 bg-[#1E1E1E] mx-12 mt-8 p-4 rounded-lg items-center justify-center">
        <!-- Tombol Previous -->
        <button 
            class="px-2 py-1 bg-white/30 rounded-full text-black"
            onclick="document.getElementById('jenisContainer').scrollBy({ left: -150, behavior: 'smooth' });">
            &lt;
        </button>

        <!-- Container Jenis -->
        <div id="jenisContainer"
            class="flex gap-2 overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide"
            style="-ms-overflow-style: none; scrollbar-width: none;">
            @foreach ($jenis as $category)
                <!-- <div class="block max-w-sm shadow-sm rounded-[12px] overflow-hidden"> -->
                <div class="flex-none w-36 snap-center text-center">
                    <a href="/product?category[0]={{ $category->id }}" class="flex-none snap-center">
                        <!-- <img src="{{ asset('storage/' . $category->image) }}"  -->
                        <img src="{{ Str::startsWith($category->image, 'images/') ? asset($category->image) : asset('storage/' . $category->image) }}" 
                            class="w-auto h-20 object-contain rounded-[12px] border-2 border-gray-500/50 transition-transform duration-300 ease-in-out transform hover:scale-105 bg-white">
                    </a>
                    <p class="text-base text-center text-white">{{ $category->name }}</p>
                </div>
            @endforeach
        </div>

        <!-- Tombol Next -->
        <button 
            class="px-2 py-1 bg-white/30 rounded-full text-black"
            onclick="document.getElementById('jenisContainer').scrollBy({ left: 150, behavior: 'smooth' });">
            &gt;
        </button>
    </div>
    
    {{-- merk --}}
    <div class="flex gap-8 bg-[#1E1E1E] mx-12 mt-8 p-4 rounded-lg items-center justify-center">
        <!-- Tombol Previous -->
        <button 
            class="px-2 py-1 bg-white/30 rounded-full text-black"
            onclick="document.getElementById('merkContainer').scrollBy({ left: -150, behavior: 'smooth' });">
            &lt;
        </button>

        <!-- Container Merk -->
        <div id="merkContainer"
            class="flex gap-2 overflow-x-auto snap-x snap-mandatory scroll-smooth scrollbar-hide"
            style="-ms-overflow-style: none; scrollbar-width: none;">
            @foreach ($merks as $merk)
                <div class="flex-none w-36 snap-center text-center">
                    <a href="/product?brand[0]={{ $merk->id }}" class="flex-none snap-center">
                        <!-- <img src="{{ asset('storage/' . $merk->image) }}"  -->
                        <img src="{{ Str::startsWith($merk->image, 'images/') ? asset($merk->image) : asset('storage/' . $merk->image) }}" 
                            class="w-36 h-24 object-contain rounded-[12px] border-2 border-gray-500/50 transition-transform duration-300 ease-in-out transform hover:scale-105 bg-white">
                    </a>
                    <p class="text-base text-center text-white">{{ $merk->name }}</p>
                </div>
            @endforeach
        </div>

        <!-- Tombol Next -->
        <button 
            class="px-2 py-1 bg-white/30 rounded-full text-black"
            onclick="document.getElementById('merkContainer').scrollBy({ left: 150, behavior: 'smooth' });">
            &gt;
        </button>
    </div>

    {{-- produk terlaris --}}
    {{-- <div class="w-screen bg-gradient-to-b from-gray-900 to-red-800 mt-4"> --}}
    <div class="mx-12 rounded-lg bg-[#181818] mt-8">
        {{-- tulisan --}}
        <div class="flex items-center justify-between px-8 pt-6 pb-4 top-0 z-10 text-white">
            <div class="text-2xl font-medium">Best Selling Product</div>
            <a href="product?sortBy=Best+Selling" class="text-sm font-medium flex items-center space-x-1">
                <span>View More</span>
                <i class="fas fa-arrow-right text-base"></i>
            </a>
        </div>

        {{-- card --}}
        <div class="w-full overflow-x-auto p-4 pb-8">
            <div class="flex space-x-4 w-max gap-2 px-4"> 
                @foreach ($products->take(8) as $index => $product)
                    {{-- <div class="w-full max-w-sm bg-gradient-to-b from-black to-gray-900 rounded-[12px] shadow-sm"> --}}
                    <div class="w-full max-w-sm bg-[#222] rounded-[12px] shadow-lg shadow-black/30">

                        {{-- label & image --}}
                        <div class="relative">
                            {{-- <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded 
                                  {{ $product->condition === 'baru' ? 'bg-green-600' : 'bg-yellow-500' }}"> --}}
                            <span class="absolute top-2 left-2 text-white text-xs font-bold px-2 py-1 rounded z-10
                            {{ $product->condition === 'baru' ? 'bg-green-500/80' : 'bg-yellow-400/80' }}">                              
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </span>
                            <div class="overflow-hidden rounded-t-[12px]">
                                <img class="rounded-t-[12px] p-1 w-full h-48 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" 
                                src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" 
                                alt="product image" />
                            </div>
                        </div>    
                        
                        {{-- info --}}
                        <div class="p-4">
                            {{-- merk --}}
                            <div>
                                <h5 class="text-xl font-semibold tracking-tight text-white">{{ $product->merk->name }} {{ $product->name }}</h5>
                                <p class="text-white/60">{{ $product->jenis->name }}</p>
                            </div>

                            {{-- desc --}}
                            <div class="flex items-center mt-2.5 mb-5 py-4 px-6 border-b border-t border-white/10">
                                <div class="flex justify-between w-full text-gray-300">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-tachometer-alt text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['top_speed'] }} km/h</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-gas-pump text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['fuel_type'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-cogs text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['transmission'] }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- price --}}
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-extrabold text-[#ff4d4d]">
                                    {{ 'Rp ' . number_format($product->price >= 1000000000 ? $product->price / 1000000000 : $product->price / 1000000, 2) }}
                                    {{ $product->price >= 1000000000 ? ' M' : ' Jt' }}
                                </span>                            
                                <a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="text-white bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 font-medium rounded-lg text-xs px-3.5 py-2.5 text-center">View Detail</a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- new --}}
    <div class="mx-12 rounded-lg bg-[#181818] mt-8">
        {{-- tulisan --}}
        <div class="flex items-center justify-between px-8 pt-6 pb-4 top-0 z-10 text-white">
            <div class="text-2xl font-medium">Popular New Car</div>
            <a href="product?sortBy=Best+Selling&condition[0]=baru" class="text-sm font-medium flex items-center space-x-1">
                <span>View More</span>
                <i class="fas fa-arrow-right text-base"></i>
            </a>
        </div>

        {{-- card --}}
        <div class="w-full overflow-x-auto p-4 pb-8">
            <div class="flex space-x-4 w-max gap-2 px-4"> 
                @foreach ($products->filter(fn($product) => $product->condition === 'baru')->take(8) as $index => $product)
                <div class="w-full max-w-sm bg-[#222] rounded-[12px] shadow-lg shadow-black/30">

                        {{-- label & image --}}
                        <div class="relative">
                            <span class="absolute top-2 left-2 text-white text-xs font-bold px-2 py-1 rounded z-10
                            {{ $product->condition === 'baru' ? 'bg-green-500/80' : 'bg-yellow-400/80' }}">                              
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </span>
                            <div class="overflow-hidden rounded-t-[12px]">
                                <img class="rounded-t-[12px] p-1 w-full h-48 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" 
                                src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" 
                                alt="product image" />
                            </div>
                        </div>    
                        
                        {{-- info --}}
                        <div class="p-4">
                            {{-- merk --}}
                            <div>
                                <h5 class="text-xl font-semibold tracking-tight text-white">{{ $product->merk->name }} {{ $product->name }}</h5>
                                <p class="text-white/60">{{ $product->jenis->name }}</p>
                            </div>

                            {{-- desc --}}
                            <div class="flex items-center mt-2.5 mb-5 py-4 px-6 border-b border-t border-white/20">
                                <div class="flex justify-between w-full text-gray-300">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-tachometer-alt text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['top_speed'] }} km/h</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-gas-pump text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['fuel_type'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-cogs text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['transmission'] }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- price --}}
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-extrabold text-red-500">
                                    {{ 'Rp ' . number_format($product->price >= 1000000000 ? $product->price / 1000000000 : $product->price / 1000000, 2) }}
                                    {{ $product->price >= 1000000000 ? ' M' : ' Jt' }}
                                </span>                            
                                <a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="text-white bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 font-medium rounded-lg text-xs px-3.5 py-2.5 text-center">View Detail</a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- second --}}
    <div class="mx-12 rounded-lg bg-[#181818] mt-8">
        {{-- tulisan --}}
        <div class="flex items-center justify-between px-8 pt-6 pb-4 top-0 z-10 text-white">
            <div class="text-2xl font-medium">Popular Second Car</div>
            <a href="product?sortBy=Best+Selling&condition[0]=second" class="text-sm font-medium flex items-center space-x-1">
                <span>View More</span>
                <i class="fas fa-arrow-right text-base"></i>
            </a>
        </div>

        {{-- card --}}
        <div class="w-full overflow-x-auto p-4 pb-8">
            <div class="flex space-x-4 w-max gap-2 px-4"> 
                @foreach ($products->filter(fn($product) => $product->condition === 'bekas')->take(8) as $index => $product)
                <div class="w-full max-w-sm bg-[#222] rounded-[12px] shadow-lg shadow-black/30">

                        {{-- label & image --}}
                        <div class="relative">
                            <span class="absolute top-2 left-2 text-white text-xs font-bold px-2 py-1 rounded z-10
                            {{ $product->condition === 'baru' ? 'bg-green-500/80' : 'bg-yellow-400/80' }}">                              
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </span>
                            <div class="overflow-hidden rounded-t-[12px]">
                                <img class="rounded-t-[12px] p-1 w-full h-48 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" 
                                src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" 
                                alt="product image" />
                            </div>
                        </div>    
                        
                        {{-- info --}}
                        <div class="p-4">
                            {{-- merk --}}
                            <div>
                                <h5 class="text-xl font-semibold tracking-tight text-white">{{ $product->merk->name }} {{ $product->name }}</h5>
                                <p class="text-white/60">{{ $product->jenis->name }}</p>
                            </div>

                            {{-- desc --}}
                            <div class="flex items-center mt-2.5 mb-5 py-4 px-6 border-b border-t border-white/20">
                                <div class="flex justify-between w-full text-gray-300">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-tachometer-alt text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['top_speed'] }} km/h</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-gas-pump text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['fuel_type'] }}</p>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-cogs text-xl pb-1.5"></i>
                                        <p class="text-sm">{{ $product->description['transmission'] }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- price --}}
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-extrabold text-red-500">
                                    {{ 'Rp ' . number_format($product->price >= 1000000000 ? $product->price / 1000000000 : $product->price / 1000000, 2) }}
                                    {{ $product->price >= 1000000000 ? ' M' : ' Jt' }}
                                </span>                            
                                <a href="{{ route('product-detail', ['slug' => $product->slug]) }}" class="text-white bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700 font-medium rounded-lg text-xs px-3.5 py-2.5 text-center">View Detail</a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</div>