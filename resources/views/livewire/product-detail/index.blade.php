<div>
    {{-- The best athlete wants his opponent at his best. --}}

    {{-- produk --}}
    <div class="mt-32 mx-20 flex-col md:flex-row flex gap-4 justify-center">
        {{-- gambar --}}
        <div class="md:w-3/5 w-full rounded-lg shadow-lg">
            <img class="w-full h-auto rounded-lg" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />   
        </div>
   
        {{-- info produk --}}
        <div class="w-full sm:w-[80%] md:w-2/5 lg:w-[30%]">
            <div class="block p-6 rounded-lg shadow-sm bg-[#181818]">
                <span class="text-2xl font-extrabold text-red-500">
                    Rp {{ number_format($product->price, 2, ',', '.') }}
                </span>

                <div class="p-4 mt-4 bg-[#222] rounded-lg">
                    <p class="font-semibold text-white">  
                        {{ $product->merk->name }} {{ $product->name }} {{ $product->jenis->name }}
                    </p>

                    <div class="flex flex-wrap mt-4 gap-2">
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-tachometer-alt text-base text-red-500"></i>
                            <p class="text-sm text-white">{{ $product->description['top_speed'] }} km/h</p>
                        </div>
                        <span class="text-lg font-semibold text-red-500">•</span>
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-gas-pump text-base text-red-500"></i>
                            <p class="text-sm text-white">{{ $product->description['fuel_type'] }}</p>
                        </div>
                        <span class="text-lg font-semibold text-red-500">•</span>
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-cogs text-xl text-base text-red-500"></i>
                            <p class="text-sm text-white">{{ $product->description['transmission'] }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-map-marker text-base text-red-500"></i>
                        <p class="text-sm text-white">{{ $product->location }}</p>
                    </div>
                </div>  

                <div class="block mt-4">
                    <a href="{{ route('checkout', ['id' => $product->id]) }}" class="block text-center text-white font-medium rounded-lg text-sm w-full py-2.5 me-2 bg-gradient-to-b from-red-600 to-red-800 hover:from-red-500 hover:to-red-700">
                        Buy Now
                    </a>
                </div>

                </a>
            </div>
        </div>

    </div>

    {{-- detail produk --}}
    <div class="mt-16 mx-8 p-8 border-t border-red-600/50">
        <div class="text-center text-4xl font-bold relative w-full text-red-500">
            Product<span class="relative z-10 pt-2 text-white"> Summary</span>
        </div>

        <div x-data="{ tab: 'description' }" class="text-sm font-medium text-white/70 mt-4">
            <ul class="flex flex-wrap -mb-px justify-center text-center">
                <li class="me-2">
                    <button @click="tab = 'description'" :class="tab === 'description' ? 'text-red-600 border-b-2 border-red-600' : 'text-white/70 border-transparent'"
                    class="inline-block p-4 rounded-t-lg hover:text-white/90 hover:border-gray-300">
                        Description
                    </button >
                </li>
                <li class="me-2">
                    <button @click="tab = 'powertrain'" :class="tab === 'powertrain' ? 'text-red-600 border-b-2 border-red-600' : 'text-white/70 border-transparent'"
                    class="inline-block p-4 rounded-t-lg hover:text-white/90 hover:border-gray-300">
                        Powertrain
                    </button >
                </li>
                <li class="me-2">
                    <button @click="tab = 'dimensions'" :class="tab === 'dimensions' ? 'text-red-600 border-b-2 border-red-600' : 'text-white/70 border-transparent'"
                    class="inline-block p-4 rounded-t-lg hover:text-white/90 hover:border-gray-300">
                        Dimensions
                    </button >
                </li>
            </ul>

            <div id="defaultTabContent" class="mx-4 sm:mx-10 md:mx-16 lg:mx-20">
                <div x-show="tab === 'description'" class="p-4 rounded-lg md:p-8 mx-8 flex flex-wrap gap-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- merk --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-tag text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Brand</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->merk->name }}
                            </p>
                        </div>
                    </div>

                    {{-- name --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-car text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Variant</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->name }}
                            </p>
                        </div>
                    </div>

                    {{-- jenis --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-shapes text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Category</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->jenis->name }} 
                            </p>
                        </div>
                    </div>

                    {{-- condition --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Condition</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->condition === 'baru' ? 'New' : 'Second' }}
                            </p>
                        </div>
                    </div>

                    {{-- price --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-money-bill-wave text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Price</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-3xl font-extrabold text-red-700 capitalize">
                                {{ 'Rp ' . number_format($product->price >= 1000000000 ? $product->price / 1000000000 : $product->price / 1000000, 2) }}
                                {{ $product->price >= 1000000000 ? ' M' : ' Jt' }}
                            </p>
                        </div>
                    </div>

                    {{-- location --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-map-marker-alt text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Location</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->location }}
                            </p>
                        </div>
                    </div>
                </div>    

                <div x-show="tab === 'powertrain'" class="p-4 rounded-lg md:p-8 mx-8 flex flex-wrap gap-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- top speed --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-tachometer-alt text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Top Speed</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['top_speed'] }} 
                                <span class="text-xl font-semibold text-white/80">km/h</span>
                            </p>
                        </div>
                    </div>

                    {{-- engine --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-wrench text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Engine</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->description['engine'] }}
                            </p>
                        </div>
                    </div>

                    {{-- power --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-bolt text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Power</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['power'] }} 
                                <span class="text-xl font-semibold text-white/80">{{ $product->description['power_unit'] }}</span>
                            </p>
                        </div>
                    </div>

                    {{-- transmission --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-cogs text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Transmission</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->description['transmission'] }}
                            </p>
                        </div>
                    </div>

                    {{-- fuel type --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-cogs text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Fuel Type</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->description['fuel_type'] }}
                            </p>
                        </div>
                    </div>

                    {{-- fuel consumption --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-tint text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Fuel Consumption</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700 capitalize">
                                {{ $product->description['fuel_consumption'] }}
                                <span class="text-xl font-semibold text-white/80">L/100km</span>
                            </p>
                        </div>
                    </div>
                </div>    

                <div x-show="tab === 'dimensions'" class="p-4 rounded-lg md:p-8 mx-8 flex flex-wrap gap-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    {{-- seat capacity --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-users text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Seat Capacity</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['seat_capacity'] }} 
                                <span class="text-xl font-semibold text-white/80">Seats</span>
                            </p>
                        </div>
                    </div>

                    {{-- width --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-arrows-alt-h text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Width</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['width'] }} 
                                <span class="text-xl font-semibold text-white/80">mm</span>
                            </p>
                        </div>
                    </div>

                    {{-- length --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fas fa-ruler-horizontal text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Length</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['length'] }} 
                                <span class="text-xl font-semibold text-white/80">mm</span>
                            </p>
                        </div>
                    </div>

                    {{-- height --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-ruler-vertical text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Height</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['height'] }} 
                                <span class="text-xl font-semibold text-white/80">mm</span>
                            </p>
                        </div>
                    </div>

                    {{-- ground clearance --}}
                    <div class="items-center p-8 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)] bg-[#181818]">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-car-side text-xl text-red-600"></i> 
                            <h1 class="text-lg text-white font-medium">Ground Clearance</h1>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="text-4xl font-extrabold text-red-700">
                                {{ $product->description['ground_clearance'] }} 
                                <span class="text-xl font-semibold text-white/80">mm</span>
                            </p>
                        </div>
                    </div>
                </div>    
            </div>    
        </div>

    </div>
    


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>
    
</div>
