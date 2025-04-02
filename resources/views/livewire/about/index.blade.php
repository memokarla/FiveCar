<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    {{-- <div>
        <label for="relative" class="cursor-pointer">
            <input type="checkbox" id="relative" class="peer sr-only" />
            <div class="overflow-hidden rounded-lg shadow-md ring ring-transparent grayscale peer-checked:grayscale-0">
                <div>
                    <img src="gintama.mylove"
                    alt="home one" class="h-28 w-48 object-cover peer-checked:hidden" />
                </div>
            </div>
        </label>
    </div> --}}

    <div class="mb-8">
        {{-- desc, nilai --}}
        <div class="relative w-full h-[300px] lg:h-[400px]">
            <input type="checkbox" id="card-toggle" class="peer sr-only" />
        
            <label for="card-toggle" class="absolute w-full h-full flex items-center justify-center text-white shadow-lg cursor-pointer z-10">
                <img src="{{ asset('images/carOff.png') }}" class="w-full h-full object-cover" style="object-position: 50% 60%;" alt="">
                
                {{-- deskripsi --}}
                <div class="absolute">
                    <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-center">
                        Introduction to <span class="text-red-900">FiveCar</span>
                    </div>
                    <div class="text-xs sm:text-sm lg:text-base pt-2 max-w-md mx-auto text-center">
                        Platform e-commerce FiveCar menyediakan mobil berkualitas, baik baru maupun bekas, dengan harga kompetitif dan layanan pelanggan profesional.
                    </div>
                </div>
    
                {{-- nilai-nilai --}}
                <div class="absolute flex justify-center bottom-0 transform translate-y-[50%] z-10 rounded-lg grid grid-cols-4 px-4">
                    <div class="bg-[#FF4C4C] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg rounded-l-lg flex items-center justify-center">
                        <p class="text-center">Integritas</p>
                    </div>
                    <div class="bg-[#FF1A1A] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg flex items-center justify-center">
                        <p class="text-center">Kualitas</p>
                    </div>
                    <div class="bg-[#B30000] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg flex items-center justify-center">
                        <p class="text-center">Kepuasan Pelanggan</p>
                    </div>
                    <div class="bg-[#3D0000] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg rounded-r-lg flex items-center justify-center">
                        <p class="text-center">Inovasi dalam Layanan</p>
                    </div>
                </div>
            </label>
    
            <label for="card-toggle" class="absolute w-full h-full flex items-center justify-center text-white shadow-lg peer-checked:z-20 z-0">
                {{-- Card Belakang --}}
                <img src="{{ asset('images/carOn.png') }}" class="w-full h-full object-cover" style="object-position: 50% 60%;" alt="">
                
                {{-- deskripsi --}}
                <div class="absolute">
                    <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-center">
                        Introduction to <span class="text-red-900">FiveCar</span>
                    </div>
                    <div class="text-xs sm:text-sm lg:text-base pt-2 max-w-md mx-auto text-center">
                        Platform e-commerce FiveCar menyediakan mobil berkualitas, baik baru maupun bekas, dengan harga kompetitif dan layanan pelanggan profesional.
                    </div>
                </div>
    
                {{-- nilai-nilai --}}
                <div class="absolute flex justify-center bottom-0 transform translate-y-[50%] z-10 rounded-lg grid grid-cols-4 px-4">
                    <div class="bg-[#FF4C4C] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg rounded-l-lg flex items-center justify-center">
                        <p class="text-center">Integritas</p>
                    </div>
                    <div class="bg-[#FF1A1A] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg flex items-center justify-center">
                        <p class="text-center">Kualitas</p>
                    </div>
                    <div class="bg-[#B30000] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg flex items-center justify-center">
                        <p class="text-center">Kepuasan Pelanggan</p>
                    </div>
                    <div class="bg-[#3D0000] text-xs sm:text-sm lg:text-base text-white py-1 sm:py-1.5 lg:py-2.5 px-2 sm:px3 lg:px-4 shadow-lg max-w-lg rounded-r-lg flex items-center justify-center">
                        <p class="text-center">Inovasi dalam Layanan</p>
                    </div>
                </div>
            </label>       
        </div>  
    
        {{-- misi visi --}}
        <div class="flex flex-col md:flex-row justify-around mt-12 mx-8 py-8 rounded-lg shadow-lg">
            <div class="w-full md:w-[50%] text-center">
                <div class="font-bold text-xl lg:text-2xl">
                    Misi
                </div>
                <div class="list-none mt-2 text-sm lg:text-base">
                    <li>Menyediakan mobil impian bagi setiap pelanggan.</li>
                    <li>Menyediakan proses pembelian yang transparan, cepat, dan nyaman.</li>
                    <li>Memastikan kualitas produk dan layanan yang terbaik.</li>
                </div>
            </div>

            <div class="border-l border-2 border-red-900 my-4 mx-4 lg:my-0"></div>

            <div class="w-full md:w-[50%] text-center">
                <div class="font-bold text-xl lg:text-2xl">
                    Visi
                </div>
                <div class="list-none mt-2 text-sm lg:text-base">
                    <li>Menjadi platform e-commerce mobil terpercaya.</li>
                    <li>Memudahkan pelanggan mendapatkan kendaraan berkualitas dengan harga terbaik.</li>
                    <li>Memberikan pengalaman berbelanja yang menyenangkan dan tanpa hambatan.</li>
                </div>
            </div>
        </div>

        {{-- keunggulan --}}
        <div class="flex flex-wrap items-center pt-8 justify-center gap-2 lg:gap-12 mx-8">
            <div class="block flex justify-center p-6 rounded-lg text-center gap-4 bg-gray-500/20 w-full lg:w-[300px]"> 
                <i class="fas fa-shipping-fast text-base md:text-lg lg:text-xl text-red-900"></i> 
                <h5 class="text-sm md:text-base lg:text-lg font-bold tracking-tight text-red-900">Pengiriman Cepat</h5>
            </div>

            <div class="block flex justify-center p-6 rounded-lg text-center gap-4 bg-gray-500/20 w-full lg:w-[300px]"> 
                <i class="fas fa-tags text-base md:text-lg lg:text-xl text-red-900"></i> 
                <h5 class="text-sm md:text-base lg:text-lg font-bold tracking-tight text-red-900">Harga Kompetitif</h5>
            </div>

            <div class="block flex justify-center p-6 rounded-lg text-center gap-4 bg-gray-500/20 w-full lg:w-[300px]"> 
                <i class="fas fa-headset text-base md:text-lg lg:text-xl text-red-900"></i> 
                <h5 class="text-sm md:text-base lg:text-lg font-bold tracking-tight text-red-900">Dukungan Pelanggan 24/7</h5>
            </div>
        </div>

        <div class="border-b border-red-500/50 mx-8 pt-12"></div>

        {{-- team --}}
        <div class="text-center pt-8">
            <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-center">
                <span class="text-red-900">Team</span> Members
            </div>

            <div class="flex flex-wrap items-center justify-center pt-5 gap-2 lg:gap-8 mx-12 lg:mx-0">

                {{-- UI/UX Designer --}}
                <div class="relative w-full sm:w-[250px] md:w-[250px] lg:w-[250px]">
                    <div class="bg-gradient-to-b from-red-500 to-black py-24 lg:py-28 rounded-lg">
                        <i class="fas fa-laptop-code text-3xl md:text-4xl lg:text-5xl text-white"></i> 
                    </div>

                    <div class="bg-white rounded-lg shadow-lg px-4 py-2.5 mx-3 transform translate-y-[-50%]">
                        <div class="text-sm lg:text-lg font-bold">Marcellinus Christo</div>
                        <div class="text-xsm lg:text-sm font-semibold">UI/UX Designer</div>
                    </div>
                </div>

                {{-- Database Administrator --}}
                <div class="relative w-full sm:w-[250px] md:w-[250px] lg:w-[250px]">
                    <div class="bg-gradient-to-b from-red-500 to-black py-24 lg:py-28 rounded-lg">
                        <i class="fas fa-database text-3xl md:text-4xl lg:text-5xl text-white"></i> 
                    </div>

                    <div class="bg-white rounded-lg shadow-lg px-4 py-2.5 mx-3 transform translate-y-[-50%]">
                        <div class="text-sm lg:text-lg font-bold">Farcha Amalia</div>
                        <div class="text-xsm lg:text-sm font-semibold">Database Administrator</div>
                    </div>
                </div>

                {{-- Programmer --}}
                <div class="relative w-full sm:w-[250px] md:w-[250px] lg:w-[250px]">
                    <div class="bg-gradient-to-b from-red-500 to-black py-24 lg:py-28 rounded-lg">
                        <i class="fas fa-code text-3xl md:text-4xl lg:text-5xl text-white"></i> 
                    </div>

                    <div class="bg-white rounded-lg shadow-lg px-4 py-2.5 mx-3 transform translate-y-[-50%]">
                        <div class="text-sm lg:text-lg font-bold">Angelina Thithis</div>
                        <div class="text-xsm lg:text-sm font-semibold">Programmer</div>
                    </div>
                </div>

                {{-- Network Engineer --}}
                <div class="relative w-full sm:w-[250px] md:w-[250px] lg:w-[250px]">
                    <div class="bg-gradient-to-b from-red-500 to-black py-24 lg:py-28 rounded-lg">
                        <i class="fas fa-network-wired text-3xl md:text-4xl lg:text-5xl text-white"></i> 
                    </div>

                    <div class="bg-white rounded-lg shadow-lg px-4 py-2.5 mx-3 transform translate-y-[-50%]">
                        <div class="text-sm lg:text-lg font-bold">Abu Bakar Tsabit</div>
                        <div class="text-xsm lg:text-sm font-semibold">Network Engineer</div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</div>
