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
                        class="block w-full p-2 ps-10 placeholder-white/70 text-sm text-white text-center border-none rounded-lg backdrop-blur-lg bg-[rgba(0,0,0,0.5)] 
                        focus:bg-black/60 focus:ring-2 focus:ring-red-500/50 focus:border-red-500 focus:border-opacity-50 
                        hover:shadow-md hover:shadow-red-500/30 transition-shadow duration-200"
                        wire:model.live="search" placeholder="Search Car..." required />
                    </div>
                </form>    
            </div>

            {{-- tab --}}
            <div class="flex"> 
                <div class="flex items-center justify-center text-white hover:text-red-500 cursor-pointer" data-collapse-toggle="filter">
                    <div class="mr-2">Filter</div>
                    <i class="fa-solid fa-filter"></i>
                </div>
                <div class="mx-4 py-2 border-l-2 border-red-900"></div>
                <div class="flex items-center justify-center text-white hover:text-red-500 cursor-pointer" data-collapse-toggle="short">
                    <div class="mr-2">Short</div>
                    <i class="fa-solid fa-sort"></i>
                </div>
            </div>
        </div>

        {{-- hasil filter --}}
        <div class="border border-red-500 mt-4 px-4 py-2 flex gap-4 rounded-lg" >
            <div class="border-r border-red-500 pr-4 flex items-center justify-center text-white">Filter</div>

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
                        <span>{{ ($fuelType) }}</span>
                        <button wire:click="removeFilter('fuelType', '{{ $fuelType }}')" class="ml-2 text-white">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endforeach

                {{-- transmission --}}
                @foreach ($selected_transmission as $transmission)
                    <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                        <span>{{ ucfirst($transmission) }}</span>
                        <button wire:click="removeFilter('transmission', '{{ $transmission }}')" class="ml-2 text-white">
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

                {{-- sort by --}}
                @if ($selected_sortBy)
                    <div class="flex items-center bg-red-500 text-white rounded px-2 py-1">
                        <span>{{ $selected_sortBy }}</span> 
                        <button wire:click="removeFilter('sortBy')" class="ml-2 text-white">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

            </div>
        </div>

        {{-- filter --}}
        <div class="hidden mt-4 bg-black/40 backdrop-blur-md border border-red-500 rounded-lg p-4" id="filter">
            <div class="flex justify-between">
                <div class="text-xl text-white font-bold">
                    Filter By
                </div>

                <i class="fa-solid fa-x cursor-pointer text-white" data-collapse-toggle="filter"></i>
            </div>
            
            <div class="flex flex-wrap justify-start mt-4 gap-x-20 gap-y-4">
                {{-- merk --}}
                <div>
                    <div class="text-lg text-white">Brands</div>
    
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
                                        <span class="z-3 text-base text-white/70 pr-2">{{ $merk->name }}</span>
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
                    <div class="text-lg text-white">
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
                                        <span class="z-3 text-base text-white/70 pr-2">{{ $jenis->name }}</span>
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
                    <div class="text-lg text-white">
                        Condition
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        {{-- new --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_condition" value="baru" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">New</span>
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
                                    <span class="z-3 text-base text-white/70 pr-2">Second</span>
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
                    <div class="text-lg text-white">
                        Fuel Type
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        {{-- bensin --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_fuelType" value="bensin" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">Bensin</span>
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
                                    <span class="z-3 text-base text-white/70 pr-2">Solar</span>
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
                                    <span class="z-3 text-base text-white/70 pr-2">Listrik</span>
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
                                    <span class="z-3 text-base text-white/70 pr-2">Hybrid</span>
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
    
                {{-- transmission --}}
                <div>
                    <div class="text-lg text-white">
                        Transmission
                    </div>
    
                    <div class="flex gap-4 mt-2">
                        {{-- manual --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_transmission" value="manual" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">Manual</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Manual</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- automatic --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_transmission" value="automatic" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">Automatic</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Automatic</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- cvt --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_transmission" value="cvt" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">Continuously Variable Transmission</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Continuously Variable Transmission</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- dct --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_transmission" value="dct" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">Dual-Clutch</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Dual-Clutch</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
    
                        {{-- semi-automatic --}}
                        <label class="cursor-pointer relative">
                            <input type="checkbox" wire:model.live="selected_transmission" value="semi-automatic" class="peer sr-only" />
                            {{-- before --}}
                            <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                                <div class="flex items-center text-center justify-between p-2">
                                    <span class="z-3 text-base text-white/70 pr-2">Semi Automatic</span>
                                    <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                                </div>
                            </div>
                            {{-- after --}}
                            <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                                <div class="flex items-center justify-between p-2">
                                    <span class="text-base pr-2">Semi Automatic</span>
                                    <i class="fa-solid fa-check text-white-500"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
    
                {{-- harga --}}
                <div>
                    <div class="text-lg text-white">
                        Price
                    </div>
                    <form class="max-w-sm w-64 pt-2">
                        <select wire:model.live="selected_price" 
                        class="rounded-[8px] block w-full p-2 border border-red-500 bg-black/50 placeholder-gray-400 text-white/70 focus:border-red-500">
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
        </div>

        {{-- shorting --}}
        <div class="hidden mt-4 bg-black/40 backdrop-blur-md border border-red-500 rounded-lg p-4 grid gap-4" id="short">
            <div class="flex justify-between">
                <div class="text-xl text-white font-bold">
                    Short By
                </div>

                <i class="fa-solid fa-x cursor-pointer text-white" data-collapse-toggle="short"></i>
            </div>

            {{-- Price --}}
            <div class="flex justify-between border-b border-red-500/50 pb-4">
                <div class="text-lg text-white">Price</div>

                <div class="grid gap-2">
                    {{-- low - hight --}}
                    <label class="cursor-pointer relative">
                        <input type="radio" wire:model.live="selected_sortBy" name="sortBy" value="Price: Low to High" class="peer sr-only" />
                        {{-- before --}}
                        <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                            <div class="flex items-center text-center justify-between p-2">
                                <span class="z-3 text-base text-white/70 pr-2">Low to High</span>
                                <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                            </div>
                        </div>
                        {{-- after --}}
                        <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                            <div class="flex items-center justify-between p-2">
                                <span class="text-base pr-2">Low to High</span>
                                <i class="fa-solid fa-check text-white-500"></i>
                            </div>
                        </div>
                    </label>

                    {{-- hight- low --}}
                    <label class="cursor-pointer relative">
                        <input type="radio" wire:model.live="selected_sortBy" name="sortBy" value="Price: High to Low" class="peer sr-only" />
                        {{-- before --}}
                        <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                            <div class="flex items-center text-center justify-between p-2">
                                <span class="z-3 text-base text-white/70 pr-2">Hight to Low</span>
                                <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                            </div>
                        </div>
                        {{-- after --}}
                        <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                            <div class="flex items-center justify-between p-2">
                                <span class="text-base pr-2">Hight to Low</span>
                                <i class="fa-solid fa-check text-white-500"></i>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Newest --}}
            <div class="flex justify-between border-b border-red-500/50 pb-4">
                <div class="text-lg text-white">Newest</div>

                {{-- newest --}}
                <label class="cursor-pointer relative">
                    <input type="radio" wire:model.live="selected_sortBy" name="sortBy" value="Newest" class="peer sr-only" />
                    {{-- before --}}
                    <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                        <div class="flex items-center text-center justify-between p-2">
                            <span class="z-3 text-base text-white/70 pr-2">Newest</span>
                            <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                        </div>
                    </div>
                    {{-- after --}}
                    <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                        <div class="flex items-center justify-between p-2">
                            <span class="text-base pr-2">Newest</span>
                            <i class="fa-solid fa-check text-white-500"></i>
                        </div>
                    </div>
                </label>
            </div>

            {{-- Best Selling --}}
            <div class="flex justify-between">
                <div class="text-lg text-white">Best Selling</div>

                <label class="cursor-pointer relative">
                    <input type="radio" wire:model.live="selected_sortBy" name="sortBy" value="Best Selling" class="peer sr-only" />
                    {{-- before --}}
                    <div class="overflow-hidden opacity-100 rounded-lg border border-red-500 peer-checked:opacity-0">
                        <div class="flex items-center text-center justify-between p-2">
                            <span class="z-3 text-base text-white/70 pr-2">Best Selling</span>
                            <i class="fa-solid fa-check text-white-500 opacity-0"></i>
                        </div>
                    </div>
                    {{-- after --}}
                    <div class="absolute top-0 r-0 opacity-0 rounded-lg border border-red-500 peer-checked:opacity-100 checked peer-checked:bg-red-500 peer-checked:text-white">
                        <div class="flex items-center justify-between p-2">
                            <span class="text-base pr-2">Best Selling</span>
                            <i class="fa-solid fa-check text-white-500"></i>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        
        {{-- product --}}
        <div class="flex flex-wrap justify-start mt-8 mx-8 gap-4"> 
            @foreach ($products as $index => $product)
                <div class="w-full max-w-sm bg-[#181818] rounded-[12px] shadow-sm">

                    {{-- label & image --}}
                    <div class="relative">
                        <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded z-10 
                                {{ $product->condition === 'baru' ? 'bg-green-600' : 'bg-yellow-500' }}">
                            {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                        </span>
                        <div class="overflow-hidden rounded-t-[12px]">
                            <img class="rounded-t-[12px] p-1 w-full h-48 object-cover transition-transform duration-300 ease-in-out transform hover:scale-105" 
                            src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}"  alt="product image" />
                        </div>
                    </div>    
                    
                    {{-- info --}}
                    <div class="p-4">
                        {{-- mekr --}}
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

        {{-- pagination --}}
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</div>
