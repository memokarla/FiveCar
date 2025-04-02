<div>
    {{-- Stop trying to control. --}}

    {{-- carousel --}}
    <div id="default-carousel" class="top-0 left-0 w-screen h-screen z-0" data-carousel="slide">

        <!-- Carousel wrapper -->
        <div class="relative h-screen overflow-hidden"> 
            @foreach ($headers as $index => $header)
                {{-- $headers adalah kumpulan data (misalnya dari database). 
                $index adalah angka indeks dari setiap item dalam loop, dimulai dari 0.
                $header mewakili satu baris data dari $headers pada setiap iterasi. --}}
                
                <div>
                    <div duration-700 ease-in-out data-carousel-item>
                        <img src="{{ asset('storage/' . $header->image) }}"
                            {{-- asset('storage/...') -> Mengambil URL dari file yang ada di storage/app/public/
                            $header->image -> Nama file gambar yang diambil dari database. --}}
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    </div>
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
    <div class="flex mt-4 gap-4 w-screen bg-red-500 p-4 items-center justify-center">
        @foreach ($jenis as $category)
            <div class="block max-w-sm shadow-sm rounded-[12px]">
                <a href="/product?category[0]={{ $category->id }}" class="">
                    <img class="w-full h-24 object-cover rounded-[12px] border-2 border-gray-500/50" src="{{ asset('storage/' . $category->image) }}" alt="category image" />
                </a>
                <p class="text-base text-center text-white">{{ $category->name }}</p>
            </div>    
        @endforeach
    </div>
    
    {{-- merk --}}
    <div class="flex mt-4 gap-4 w-screen bg-red-500 p-4 items-center justify-center">
        @foreach ($merks as $merk)
            <div class="block max-w-sm shadow-sm rounded-[12px]">
                <a href="/product?brand[0]={{ $merk->id }}" class="">
                    <img class="w-24 h-24 object-cover rounded-[12px] border-2 border-gray-500/50" src="{{ asset('storage/' . $merk->image) }}" alt="merk image" />
                </a>
                <p class="text-base text-center text-white">{{ $merk->name }}</p>
            </div>    
        @endforeach
    </div>

    {{-- produk terlaris --}}
    <div class="w-screen bg-gradient-to-b from-gray-900 to-red-800 mt-4">
        {{-- tulisan --}}
        <div class="flex items-center justify-between px-8 pt-6 pb-4 top-0 z-10 text-white">
            <div class="text-2xl font-medium">Best Selling Product</div>
            <a href="#" class="text-sm font-medium flex items-center space-x-1">
                <span>View More</span>
                <i class="fas fa-arrow-right text-base"></i>
            </a>
        </div>

        {{-- card --}}
        <div class="w-full overflow-x-auto pb-4 pl-2 pr-4">
            <div class="flex space-x-4 w-max pl-2 pr-4"> 
                @foreach ($products->take(8) as $index => $product)
                    <div class="w-full max-w-sm bg-gradient-to-b from-black to-gray-900 rounded-[12px] shadow-sm">

                        {{-- label & image --}}
                        <div class="relative">
                            <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded 
                                  {{ $product->condition === 'baru' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </span>
                            <div>
                                <img class="rounded-t-[12px] p-1 w-full h-48 object-cover" src="{{ asset('storage/' . $product->image) }}" alt="product image" />
                            </div>
                        </div>    
                        
                        {{-- info --}}
                        <div class="p-4">
                            {{-- merk --}}
                            <div>
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->merk->name }} {{ $product->name }}</h5>
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

    {{-- new --}}
    <div class="w-screen bg-gradient-to-b from-gray-900 to-red-800 mt-4">
        {{-- tulisan --}}
        <div class="flex items-center justify-between px-8 pt-6 pb-4 top-0 z-10 text-white">
            <div class="text-2xl font-medium">Popular New Car</div>
            <a href="#" class="text-sm font-medium flex items-center space-x-1">
                <span>View More</span>
                <i class="fas fa-arrow-right text-base"></i>
            </a>
        </div>

        {{-- card --}}
        <div class="w-full overflow-x-auto pb-4 pl-2 pr-4">
            <div class="flex space-x-4 w-max pl-2 pr-4"> 
                @foreach ($products->filter(fn($product) => $product->condition === 'baru')->take(8) as $index => $product)
                    <div class="w-full max-w-sm bg-gradient-to-b from-black to-gray-900 rounded-[12px] shadow-sm">

                        {{-- label & image --}}
                        <div class="relative">
                            <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded
                                  {{ $product->condition === 'baru' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </span>
                            <div>
                                <img class="rounded-t-[12px] p-1 w-full h-48 object-cover" src="{{ asset('storage/' . $product->image) }}" alt="product image" />
                            </div>
                        </div>    
                        
                        {{-- info --}}
                        <div class="p-4">
                            {{-- merk --}}
                            <div>
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->merk->name }} {{ $product->name }}</h5>
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
    <div class="w-screen bg-gradient-to-b from-gray-900 to-red-800 mt-4">
        {{-- tulisan --}}
        <div class="flex items-center justify-between px-8 pt-6 pb-4 top-0 z-10 text-white">
            <div class="text-2xl font-medium">Popular Second Car</div>
            <a href="#" class="text-sm font-medium flex items-center space-x-1">
                <span>View More</span>
                <i class="fas fa-arrow-right text-base"></i>
            </a>
        </div>

        {{-- card --}}
        <div class="w-full overflow-x-auto pb-4 pl-2 pr-4">
            <div class="flex space-x-4 w-max pl-2 pr-4"> 
                @foreach ($products->filter(fn($product) => $product->condition === 'bekas')->take(8) as $index => $product)
                    <div class="w-full max-w-sm bg-gradient-to-b from-black to-gray-900 rounded-[12px] shadow-sm">

                        {{-- label & image --}}
                        <div class="relative">
                            <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded
                                  {{ $product->condition === 'baru' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </span>
                            <div>
                                <img class="rounded-t-[12px] p-1 w-full h-48 object-cover" src="{{ asset('storage/' . $product->image) }}" alt="product image" />
                            </div>
                        </div>    
                        
                        {{-- info --}}
                        <div class="p-4">
                            {{-- merk --}}
                            <div>
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->merk->name }} {{ $product->name }}</h5>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</div>