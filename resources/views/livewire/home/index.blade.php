{{-- <div>
    A good traveler has no fixed plans and is not intent upon arriving.
</div> --}}

<div>
    
    {{-- carousel mulai --}}
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-[90vh] overflow-hidden"> <!-- Tinggi 90% dari viewport height (dinamis).  -->
            @foreach($headers as $index => $header) 
            {{-- $headers adalah kumpulan data (misalnya dari database).
                 $index adalah angka indeks dari setiap item dalam loop, dimulai dari 0.
                 $header mewakili satu baris data dari $headers pada setiap iterasi. --}}
                <div class="{{ $index === 0 ? '' : 'hidden' }}
                    {{-- Jika $index === 0, class kosong (''), artinya slide pertama tetap terlihat -> duration-700 ease-in-out
                         Jika bukan slide pertama, class hidden ditambahkan, menyembunyikan slide lainnya sampai ditampilkan oleh carousel. -> hidden duration-700 ease-in-out
                    --}}
                    duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage/' . $header->image) }}" 
                                {{-- asset('storage/...') → Mengambil URL dari file yang ada di storage/app/public/
                                     $header->image → Nama file gambar yang diambil dari database. --}}
                         class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                </div>
            @endforeach
        </div>      

        {{-- Card --}}
        <div class="absolute z-30 bottom-10 left-1/2 -translate-x-1/2 bg-white/20 w-fit flex items-center gap-2 rounded-lg px-2 py-2">
                    {{-- absolute → posisi elemen secara absolut (tidak akan mengikuti alur normal dokumen, sehingga bisa menumpuk elemen lain)
                    z-30 → itu z-index, makin besar angkar, ia akan dprioritaskan alias dipalingdepankan
                    bottom-10 → memberi jarak 10px dari bawah
                    left-1/2 → meletakkan sudut kiri elemen pada 50% dari lebar induknya
                    -translate-x-1/2 → agar elemen benar-benar rata tengah secara horizontal
                    bg-white/20 → background putih dengan opacity 20%
                    w-fit → untuk width otomatis yang menyesuaikan lebar kontennya
                    flex → mengubah elemen menjadi flex container
                    items-center → agar kontennya berada di tengah secara vertikal
                    gap-2 → tu jarak antar kontennya
                    rounded-lg → agar ujung tiap konten sedikit melengkung
                    px-2 → padding vertikal
                    py-2 → padding horizontal --}}

            <!-- Tombol Previous -->
            <button class="px-2 py-1 bg-white/30 rounded-full text-black" onclick="document.getElementById('merkContainer').scrollBy({ left: -150, behavior: 'smooth' });">&lt;</button>
                    {{-- px-2 py-1 → Padding dalam tombol (horizontal: 2, vertical: 1).
                    bg-white/30 → Latar belakang putih dengan opacity 30%.
                    rounded-full → Membuat tombol berbentuk bulat.
                    text-black → Warna teks hitam. --}}
                    {{-- document.getElementById('merkContainer') → Ambil elemen dengan id="merkContainer".
                    .scrollBy({ left: -150, behavior: 'smooth' }) → Geser elemen ke kiri 150px dengan efek smooth scroll.
                    left: -150 → Geser ke kiri (negatif = ke kiri, positif = ke kanan).
                    behavior: 'smooth' → Efek perpindahan yang halus. --}}

                <!-- Container Merk -->
                <div id="merkContainer" 
                     class="flex gap-2 overflow-x-auto max-w-[520px] snap-x snap-mandatory scroll-smooth scrollbar-hide"
                        {{-- overflow-x-auto → Mengaktifkan scroll horizontal jika konten melebihi lebar container.
                        max-w-[520px] → Membatasi lebar maksimum container hingga 520px.
                        snap-x → Mengaktifkan snapping pada sumbu horizontal saat di-scroll.
                        snap-mandatory → Memastikan elemen harus berhenti di titik snap yang ditentukan.
                        scrollbar-hide → Menyembunyikan scrollbar. --}}
                     style="-ms-overflow-style: none; scrollbar-width: none;">
                        {{-- Menyembunyikan scrollbar di Internet Explorer/Edge dan Firefox. --}}
                    @foreach ($merks as $merk) 
                        <a href="" class="flex-none w-24 aspect-square p-2 snap-center">
                                        {{-- flex-none → Mencegah elemen anak menyusut dalam flex container.
                                        w-24 → Menetapkan lebar elemen anak menjadi 24 unit (1 unit = 4px).
                                        aspect-square → Membuat elemen anak berbentuk persegi dengan tinggi = lebar.
                                        p-2 → Menambahkan padding 2 unit (0.5rem) di dalam elemen anak.
                                        snap-center → Memastikan elemen anak berhenti di tengah viewport saat di-scroll. --}}
                            <img src="{{ asset('storage/' . $merk->image) }}" class="w-full h-full object-cover rounded-lg">
                                                                                {{-- w-full → Membuat gambar mengisi seluruh lebar elemen induknya.
                                                                                h-full → Membuat gambar mengisi seluruh tinggi elemen induknya.
                                                                                object-cover → Memastikan gambar menutupi seluruh elemen tanpa merubah aspek rasio. --}}
                        </a>
                    @endforeach
                </div>

            <!-- Tombol Next -->
            <button class="px-2 py-1 bg-white/30 rounded-full text-black" onclick="document.getElementById('merkContainer').scrollBy({ left: 150, behavior: 'smooth' });">&gt;</button>
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            @foreach($headers as $index => $header)
                <button type="button" class="w-3 h-3 rounded-full" 
                    aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                    data-carousel-slide-to="{{ $index }}">
                    {{-- aria-current → Menandai tombol aktif (jika true, berarti ini slide yang sedang ditampilkan).
                         aria-label → Memberi label aksesibilitas untuk screen reader (misal: "Slide 1", "Slide 2").
                         data-carousel-slide-to="{{ $index }}" → Dapat diklik untuk pindah slide  --}}
                </button>
            @endforeach
        </div>    

        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
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
    {{-- carousel selesai --}}

    {{-- product --}}
    <div class="relative w-full z-50 top-6">
        <!-- Carousel -->
        <div class="w-full h-[400px] bg-gray-300 relative"></div>
    
        <!-- Banner Putih -->
        <div class="absolute top-[-40px] left-1/2 -translate-x-1/2 w-[90%] bg-white rounded-2xl shadow-lg p-6 z-50">
            <h2 class="text-lg font-bold">Jelajahi Semua Kendaraan</h2>
            <div class="flex gap-4 overflow-x-auto">
                <!-- Card Kendaraan -->
                <div class="w-64 bg-white border rounded-lg shadow p-4">
                    <img src="mobil.jpg" class="w-full rounded-lg">
                    <h3 class="mt-2 font-bold">Lamborghini Urus</h3>
                    <p>Rp 9.75 Miliar</p>
                </div>
            </div>
        </div>
    </div>
    
        



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.0/flowbite.min.js"></script>

</div>







            