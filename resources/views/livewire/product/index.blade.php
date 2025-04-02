<div>
    {{-- Do your work, then step back. --}}
    
    <div class="mt-32 mx-4 md:mx-12 mb-8">
        {{-- search, tab filter and short --}}
        <div class="flex justify-between">
            {{-- form search --}}
            <div class="w-[40%] md:w-[30%]">     
                <form class="">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-white-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 z-50">
                            <svg class="w-4 h-4" xmlxmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="search" id="default-search" 
                        class="block w-full p-2 ps-10 placeholder-white/70 text-sm text-white text-center border-none rounded-lg backdrop-blur-lg bg-[rgba(0,0,0,0.5)] shadow-lg shadow-red-500/50 
                        focus:ring-0 focus:bg-black/60 focus:ring-4 focus:ring-red-500/50 focus:border-red-500 focus:border-opacity-50 hover:shadow-red-500/50 rounded-[80px]" 
                        wire:model.live="search" placeholder="Search Car..." required />
                    </div>
                </form>    
            </div>

            {{-- tab --}}
            <div class="flex"> 
                <button class="flex items-center justify-center cursor-pointer" data-collapse-toggle="filter">
                    <div class="mr-2">Filter</div>
                    <i class="fa-solid fa-filter"></i>
                </button>
                <div class="mx-4 py-2 border-l-2 border-red-900"></div>
                <div class="flex items-center justify-center cursor-pointer" data-collapse-toggle="short">
                    <div class="mr-2">Short</div>
                    <i class="fa-solid fa-sort"></i>
                </div>
            </div>
        </div>

        {{-- hasil filter --}}
        <div class="border border-red-500 mt-4 px-4 py-2 flex gap-4 rounded-lg" >
            <div class="border-r pr-4 flex items-center justify-center">Filter</div>

            <div class="flex gap-2 flex-wrap">
                {{-- merk --}}
                @foreach ($selected_merks as $merkId)
                    @php
                        $merk = $merks->firstWhere('id', $merkId);
                    @endphp
                    @if ($merk)
                        <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                            <span>{{ $merk->name }}</span>
                            <button wire:click="removeFilter('merk', {{ $merk->id }})" class="ml-2 text-white">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    @endif
                @endforeach

                {{-- jenis --}}
                @foreach ($selected_jenis as $jenisId)
                    @php
                        $jenisItem = $jenis->firstWhere('id', $jenisId);
                    @endphp
                    @if ($jenisItem)
                        <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                            <span>{{ $jenisItem->name }}</span>
                            <button wire:click="removeFilter('jenis', {{ $jenisItem->id }})" class="ml-2 text-white">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    @endif
                @endforeach

                {{-- konidis --}}
                @foreach ($selected_condition as $condition)
                    <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                        <span>
                            {{ $condition === 'baru' ? 'New' : 'Second' }}
                        </span>
                        <button wire:click="removeFilter('condition', '{{ $condition }}')" class="ml-2 text-white">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endforeach

                {{-- fuel type --}}
                @foreach ($selected_fuelType as $fuelType)
                    <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                        <span>{{ ucfirst($fuelType) }}</span>
                        <button wire:click="removeFilter('fuelType', '{{ $fuelType }}')" class="ml-2 text-white">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endforeach

                {{-- price --}}
                @if ($selected_price)
                    <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                        <span>{{ $selected_price }}</span>
                        <button wire:click="removeFilter('price')" class="ml-2 text-white">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

            </div>
        </div>

        {{-- filter --}}
        <div class="hidden flex justify-between mt-4 bg-pink-300 rounded-lg p-4" id="filter">
            <div class="flex flex-wrap justify-start gap-x-20 gap-y-4">
                {{-- merk --}}
                <div>
                    <div class="text-xl font-bold">
                        Brands
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        @foreach ($merks as $merk)
                            <label for="{{ $merk->slug }}" class="cursor-pointer relative">
                                <input type="checkbox" wire:model.live="selected_merks" 
                                        id="{{ $merk->slug }}" 
                                        value="{{ $merk->id }}"
                                        class="peer sr-only" />
                                {{-- before --}}
                                <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                    <div class="flex items-center text-center justify-between p-2">
                                        <span class="z-3 text-base pr-2">{{ $merk->name }}</span>
                                        <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                    </div>
                                </div>
                                {{-- after --}}
                                <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                    <div class="flex items-center justify-between p-2">
                                        <span class="text-base pr-2">{{ $merk->name }}</span>
                                        <i class="fa-solid fa-check text-white-500"></i>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
    
                {{-- jenis --}}
                <div>
                    <div class="text-xl font-bold">
                        Category
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        @foreach ($jenis as $jenis)
                            <label for="{{ $jenis->slug }}" class="cursor-pointer relative">
                                <input type="checkbox" wire:model.live="selected_jenis" 
                                        id="{{ $jenis->slug }}" 
                                        value="{{ $jenis->id }}"
                                        class="peer sr-only" />
                                {{-- before --}}
                                <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                    <div class="flex items-center text-center justify-between p-2">
                                        <span class="z-3 text-base pr-2">{{ $jenis->name }}</span>
                                        <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                    </div>
                                </div>
                                {{-- after --}}
                                <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                    <div class="flex items-center justify-between p-2">
                                        <span class="text-base pr-2">{{ $jenis->name }}</span>
                                        <i class="fa-solid fa-check text-white-500"></i>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
    
                {{-- kondisi --}}
                <div>
                    <div class="text-xl font-bold">
                        Condition
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        {{-- new --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_condition" value="baru" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base pr-2">New</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">New</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- second --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_condition" value="bekas" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base pr-2">Second</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Second</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
    
                {{-- fuel type --}}
                <div>
                    <div class="text-xl font-bold">
                        Fuel Type
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        {{-- bensin --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_fuelType" value="bensin" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base pr-2">Bensin</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Bensin</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- solar --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_fuelType" value="solar" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base pr-2">Solar</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Solar</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- listrik --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_fuelType" value="listrik" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base pr-2">Listrik</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Listrik</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- hybrid --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_fuelType" value="hybrid" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base pr-2">Hybrid</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Hybrid</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
    
                {{-- harga --}}
                <div>
                    <div class="text-xl font-bold">
                        Price
                    </div>
                    <form class="max-w-sm w-64 pt-2">
                        <select wire:model.live="selected_price" 
                        class="rounded-[8px] block w-full p-2 border border-red-500 bg-transparent placeholder-gray-400 text-gray focus:border-red-500">
                            <option selected>Price</option>
                            <option value="< Rp 150 Juta">< Rp 150 Juta</option>
                            <option value="Rp 150 Juta - Rp 300 Juta">Rp 150 Juta - Rp 300 Juta</option>
                            <option value="Rp 300 Juta - Rp 600 Juta">Rp 300 Juta - Rp 600 Juta</option>
                            <option value="Rp 600 Juta - Rp 1 M">Rp 600 Juta - Rp 1 M</option>
                            <option value="Rp 1 M">> Rp 1 M</option>
                        </select>
                    </form>
                </div>            
            </div>

            <i class="fa-solid fa-x cursor-pointer" data-collapse-toggle="filter"></i>
        </div>

        {{-- shorting --}}
        <div class="hidden flex justify-between mt-4 bg-yellow-300 rounded-lg p-4" id="short">
            <div class="gap-y-4">
                <div class="text-xl font-bold">
                    Short By
                </div>

                <form class="max-w-sm w-64 pt-2">
                    <select wire:model.live="selected_sortBy"  
                    class="rounded-[8px] block w-full p-2 border border-red-500 bg-transparent placeholder-gray-400 text-gray focus:border-red-500">
                        <option value="default">Sort By</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="newest">Newest</option>
                    </select>
                </form>
            </div>

            <i class="fa-solid fa-x cursor-pointer" data-collapse-toggle="short"></i>
        </div>
        
        {{-- product --}}
        <div class="flex flex-wrap justify-start mt-8 mx-8 gap-4"> 
            @foreach ($products as $index => $product)
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
                        {{-- mekr --}}
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

        {{-- pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>

    </div>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</div>
