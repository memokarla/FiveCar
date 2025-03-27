<div>
    {{-- Stop trying to control. --}}

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
        <div x-data="{ open: false }" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-lg z-30">     
            <form class="max-w-md mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium text-white-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" 
                    class="block w-full p-2 ps-10 text-sm text-white text-center border-none rounded-lg backdrop-blur-lg bg-black/5 focus:ring-0 focus:bg-black/30 rounded-[80px]" 
                    placeholder="Search Car..." required 
                    @click="open = !open" />
                </div>
            </form>    
            
            {{-- filter search --}}
            <div x-show="open" class="px-4 mt-2 rounded-[8px] backdrop-blur-lg bg-red-500/30 transition-all duration-300">
                {{-- atas --}}
                <div class="flex pt-4 gap-4 justify-between w-full">
                    {{-- Brands --}}
                    <form class="max-w-sm w-32">
                        {{-- <label for="">Brands</label> --}}
                        <select wire:model="byMerks" class="rounded-[8px] block w-full p-2 bg-white/70 placeholder-gray-400 text-gray focus:ring-0 focus:border-none">
                            <option selected>Brands</option>
                            @foreach ($products as $brands)
                                <option value="{{ $brands->id }}">{{ $brands->merk->name }}</option>
                            @endforeach
                        </select>
                    </form>  

                    {{-- Category --}}
                    <form class="max-w-sm w-32">
                        {{-- <label for="">Category</label> --}}
                        <select wire:model="byJenis" class="rounded-[8px] block w-full p-2 bg-white/70 placeholder-gray-400 text-gray focus:ring-0 focus:border-none">
                            <option selected>Category</option>
                            @foreach ($jenis as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </form>

                    {{-- Price --}}
                    <form class="max-w-sm w-64">
                        <select class="rounded-[8px] block w-full p-2 bg-white/70 placeholder-gray-400 text-gray focus:ring-0 focus:border-none">
                            <option selected>Price</option>
                            <option value="">< Rp 150 Juta</option>
                            <option value="">Rp 150 Juta - Rp 300 Juta</option>
                            <option value="">Rp 300 Juta - Rp 600 Juta</option>
                            <option value="">Rp 600 Juta - Rp 1 M</option>
                            <option value="">> Rp 1 M</option>
                            
                        </select>
                    </form>
                </div>

                {{-- bawah --}}
                <div class="flex pt-2 justify-between w-full">
                    {{-- Condition --}}
                    <div class="items-center pt-2 pr-4">
                        @foreach ($conditions as $condition)
                            <input id="condition-{{ $condition }}" type="radio" value="{{ $condition }}" name="condition" class="w-4 h-4 text-red-600 bg-white focus:ring-red-600 ring-offset-gray-800 border-gray-600">
                            <label for="condition-{{ $condition }}" class="ms-2 text-sm font-medium text-gray-900 pr-4">{{ ucfirst($condition) }}</label>
                        @endforeach
                    </div>

                    {{-- button --}}
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-0">Reset</button>
                </div>

            </div>
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

    {{-- table --}}
    <div class="w-screen pt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3">
                        brand
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        condition
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $product->merk->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->jenis->name }}
                        </td>
                        <td class="px-6 py-4">
                            Rp {{ $product->price }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->condition }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>
</div>
