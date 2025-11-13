{{-- Lupakan @extends, karena semua kode sudah ada di sini --}}

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERMATA MYG - Sektor Minahasa Tomohon</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
  
        #mobile-menu.menu-open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .slider-container {
            transition: transform 0.7s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="fixed top-0 left-0 right-0 z-50 p-4">
        <div class="container mx-auto max-w-6xl">
            <div class="relative">
                <nav class="bg-white/80 backdrop-blur-md rounded-full shadow-lg px-6 py-3 flex justify-between items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('image/logo/logo_permatamyg.png') }}" alt="Logo PERMATA MYG" class="h-10 w-auto">
                        <span class="font-bold text-lg hidden sm:block"></span>
                    </a>

                    <div class="md:hidden">
                        <button id="menu-btn" class="focus:outline-none" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
                            <svg id="menu-open-icon" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                            <svg id="menu-close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <ul class="hidden md:flex space-x-5 mt-1 items-center">
                        <li><a href="#hero" class="nav-link hover:text-blue-600 transition-colors">Beranda</a></li>
                        <li><a href="#jadwal-ibadah" class="nav-link hover:text-blue-600 transition-colors">Jadwal</a></li>
                        <li><a href="#berita" class="nav-link hover:text-blue-600 transition-colors">Berita</a></li>
                        <li><a href="#kegiatan" class="nav-link hover:text-blue-600 transition-colors">Kegiatan</a></li>
                        <li><a href="#media-sosial" class="nav-link hover:text-blue-600 transition-colors">Media Sosial</a></li>
                        <li class="relative">
                            <button id="dropdown-btn" class="flex items-center gap-1 hover:text-blue-600 transition-colors">Lainnya <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg></button>
                            <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 border border-gray-200 opacity-0 invisible transform -translate-y-2 transition-all duration-200 ease-out">
                                <a href="{{ route('berita.showAll') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Semua Berita</a>
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login Admin</a>
                            </div>
                        </li>
                        <div class="flex items-center space-x-2 ml-4">
                            <img src="{{ asset('image/logo/logo_GKMI.png') }}" alt="Logo GKMI" class="h-10 w-auto">
                            <img src="{{ asset('image/logo/logo_myg.png') }}" alt="Logo MYG" class="h-10 w-auto">
                        </div>
                    </ul>

                    <div id="mobile-menu" class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-xl md:hidden opacity-0 invisible transform -translate-y-2 transition-all duration-300 ease-in-out">
                        <a href="#hero" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Beranda</a>
                        <a href="#jadwal-ibadah" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Jadwal</a>
                        <a href="#berita" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Berita</a>
                        <a href="#kegiatan" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Kegiatan</a>
                        <a href="#media-sosial" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Media Sosial</a>
                        <div class="border-t border-gray-100">
                            <a href="{{ route('berita.showAll') }}" class="block py-3 px-5 text-sm text-gray-800 font-medium hover:bg-gray-100">Semua Berita</a>
                            <a href="{{ route('login') }}" class="block py-3 px-5 text-sm text-gray-800 font-medium hover:bg-gray-100">Login Admin</a>
                        </div>
                        <div class="flex items-center space-x-2 p-4 border-t border-gray-100">
                            <img src="{{ asset('image/logo/logo_GKMI.png') }}" alt="Logo GKMI" class="h-8 w-auto"> 
                            <img src="{{ asset('image/logo/logo_myg.png') }}" alt="Logo MYG" class="h-8 w-auto">
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <main>
        {{-- ======================================================= --}}
        {{-- =========== SEMUA SECTION-MU ADA DI SINI =========== --}}
        {{-- ======================================================= --}}
        
        <section id="hero" class="relative h-screen w-full overflow-hidden">
            <div id="slider-container" class="slider-container h-full w-full flex">
                <img class="h-full w-full flex-shrink-0 object-cover object-center" src="{{ asset('image/slide_foto/slide1.jpg') }}" alt="Gambar 1">
                <img class="h-full w-full flex-shrink-0 object-cover object-center" src="{{ asset('image/slide_foto/slide2.jpg') }}" alt="Gambar 2">
                <img class="h-full w-full flex-shrink-0 object-cover object-center" src="{{ asset('image/slide_foto/slide3.jpg') }}" alt="Gambar 3">
                <img class="h-full w-full flex-shrink-0 object-cover object-center" src="{{ asset('image/slide_foto/slide4.jpg') }}" alt="Gambar 4">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end items-start text-left text-white p-8 md:p-12">
                <h1 class="text-5xl md:text-7xl font-bold drop-shadow-lg">PERMATA MYG</h1>
                <p class="mt-4 max-w-2xl text-lg md:text-xl drop-shadow-md">Persekutuan Mahasiswa dan Profesional Muda Maranatha, Sektor Minahasa Tomohon</p>
                <a href="#jadwal-ibadah" class="mt-2 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-colors duration-300">Lihat Jadwal</a>
            </div>
        </section>

        <section id="misi-nilai" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4 text-gray-800">Misi Pelayanan Kami</h2>
                <p class="max-w-3xl mx-auto mb-12 text-gray-600">Kami berkomitmen untuk menjadi wadah pertumbuhan rohani dan persekutuan yang berlandaskan pada nilai-nilai Kristiani yang teguh.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                        <div class="mb-4 inline-block p-4 bg-blue-100 text-blue-600 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Mempererat Persekutuan</h3>
                        <p class="text-gray-500">Membangun komunitas yang solid dan saling mendukung di antara mahasiswa dan profesional muda Kristiani.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                        <div class="mb-4 inline-block p-4 bg-green-100 text-green-600 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Pertumbuhan Rohani</h3>
                        <p class="text-gray-500">Mendorong diskusi Firman Tuhan yang relevan untuk memperkuat iman dan menumbuhkan karakter Kristus dalam kehidupan sehari-hari.</p>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                        <div class="mb-4 inline-block p-4 bg-red-100 text-red-600 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg></div>
                        <h3 class="text-xl font-semibold mb-2 text-gray-900">Pelayanan & Kesaksian</h3>
                        <p class="text-gray-500">Mendorong setiap anggota untuk melayani Tuhan dan menjadi saksi Kristus di lingkungan studi, kerja, dan masyarakat.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="jadwal-ibadah" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Jadwal Ibadah Mendatang</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($jadwalIbadahs as $jadwal)
                        <div class="bg-white rounded-lg shadow-lg flex overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                            <div class="bg-blue-600 text-white p-4 flex flex-col items-center justify-center w-24 flex-shrink-0 text-center">
                                <span class="text-4xl font-bold leading-none">{{ \Carbon\Carbon::parse($jadwal->tanggal_ibadah)->format('d') }}</span>
                                <span class="text-md uppercase font-semibold">{{ \Carbon\Carbon::parse($jadwal->tanggal_ibadah)->format('M') }}</span>
                                <span class="text-xs">{{ \Carbon\Carbon::parse($jadwal->tanggal_ibadah)->format('Y') }}</span>
                            </div>
                            <div class="p-4 flex flex-col justify-center">
                                <h4 class="font-bold text-lg text-gray-900">{{ $jadwal->nama_ibadah }}</h4>
                                <p class="text-gray-500 text-sm mt-1 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/></svg> {{ $jadwal->lokasi_ibadah }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-10 bg-white rounded-lg shadow-md"><p class="text-gray-500 text-lg">Saat ini belum ada jadwal ibadah yang akan datang.</p></div>
                    @endforelse
                </div>
            </div>
        </section>

        <section id="berita" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Berita Terkini</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($beritas as $berita)
                        <a href="{{ route('berita.show', $berita) }}" class="block bg-gray-50 rounded-lg shadow-lg overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                            <div class="overflow-hidden"><img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $berita->gambar ? asset('storage/'.$berita->gambar) : 'https://via.placeholder.com/400x200.png?text=Tanpa+Gambar' }}" alt="{{ $berita->judul }}"></div>
                            <div class="p-6">
                                <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->format('d M Y') }}</p>
                                <h3 class="text-xl font-semibold mb-2 text-blue-700 group-hover:text-blue-800 transition-colors">{{ $berita->judul }}</h3>
                                <p class="text-gray-600">{{ Str::limit($berita->isi, 100) }}</p>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-10"><p class="text-gray-500 text-lg">Saat ini belum ada berita terbaru.</p></div>
                    @endforelse
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('berita.showAll') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-colors duration-300">Lihat Semua Berita</a>
                </div>
            </div>
        </section>

        <section id="kegiatan" class="py-20 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mt-5 mb-12">Kegiatan Kami</h2>
                <div class="flex flex-col md:flex-row-reverse items-center gap-8 mb-16">
                    <div class="md:w-1/2"><img src="{{ asset('image/kegiatan_foto/fellowship.jpg') }}" alt="fellowship" class="rounded-lg shadow-lg w-full"></div>
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-semibold mb-4 text-blue-700">Fellowship</h3>
                        <p class="text-gray-600 leading-relaxed">Melakukan fellowship secara rutin untuk mempererat hubungan antar anggota. Kegiatan ini meliputi diskusi, sharing pengalaman, dan kegiatan sosial yang membangun solidaritas serta rasa kebersamaan.</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-8 mb-16">
                    <div class="md:w-1/2"><img src="{{ asset('image/kegiatan_foto/ibadah.jpg') }}" alt="Ibadah" class="rounded-lg shadow-lg w-full"></div>
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-semibold mb-4 text-blue-700">Ibadah</h3>
                        <p class="text-gray-600 leading-relaxed">Ibadah rutin setiap 1 bulan sekali yang dirancang khusus untuk mahasiswa dan profesional muda. Ibadah ini menekankan pada pujian, penyembahan, dan pengajaran yang relevan dengan kehidupan sehari-hari.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="media-sosial" class="py-20 bg-gray-800 text-white">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-4">Terhubung Dengan Kami</h2>
                <p class="max-w-2xl mx-auto mb-10 text-gray-300">Ikuti kami di media sosial dan bergabunglah dengan komunitas kami untuk mendapatkan informasi terbaru seputar kegiatan, jadwal, dan pengumuman penting lainnya.</p>
                <div class="mb-12">
                    <p class="mb-4 text-lg text-gray-200">Mari masuk ke dalam Komunitas Whatsapp..</p>
                    <a href="https://chat.whatsapp.com/CaoEk6nqnU3BRt5BEZoVQR" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-green-500 hover:bg-green-600 transition-colors duration-300 text-white font-bold py-4 px-8 rounded-full shadow-lg transform hover:scale-105"><span>Gabung Grup WhatsApp</span></a>
                </div>
                <div>
                    <p class="mb-6 text-gray-400">dan juga ikuti kami di platform lain:</p>
                    <div class="flex items-center justify-center space-x-6">
                        <a href="https://www.instagram.com/permatasynergy/" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors duration-300"><span class="sr-only">Instagram</span><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="..."></path></svg></a>
                        <a href="https://www.facebook.com/profile.php?id=61565703287059&locale=id_ID" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors duration-300"><span class="sr-only">Facebook</span><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="..."></path></svg></a>
                        <a href="#" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-white transition-colors duration-300"><span class="sr-only">YouTube</span><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="..."></path></svg></a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} PERMATA MYG. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script untuk Header Bar (Mobile Menu, Dropdown, Smooth Scroll)
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-open-icon');
            const closeIcon = document.getElementById('menu-close-icon');
            const menuLinks = document.querySelectorAll('.mobile-menu-link');
            const toggleMenu = () => { mobileMenu.classList.toggle('menu-open'); openIcon.classList.toggle('hidden'); closeIcon.classList.toggle('hidden'); const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true'; menuBtn.setAttribute('aria-expanded', !isExpanded); };
            menuBtn.addEventListener('click', toggleMenu);
            menuLinks.forEach(link => { link.addEventListener('click', () => { if (mobileMenu.classList.contains('menu-open')) { toggleMenu(); } }); });
            const allNavLinks = document.querySelectorAll('.nav-link');
            allNavLinks.forEach(link => { link.addEventListener('click', function(e) { const href = this.getAttribute('href'); const targetId = href.substring(href.lastIndexOf('#') + 1); const targetElement = document.getElementById(targetId); if(targetElement) { e.preventDefault(); targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' }); } }); });
            const dropdownBtn = document.getElementById('dropdown-btn');
            const dropdownMenu = document.getElementById('dropdown-menu');
            if (dropdownBtn && dropdownMenu) {
                dropdownBtn.addEventListener('click', function(event) { event.stopPropagation(); dropdownMenu.classList.toggle('opacity-0'); dropdownMenu.classList.toggle('invisible'); dropdownMenu.classList.toggle('-translate-y-2'); });
                window.addEventListener('click', function(event) { if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) { dropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2'); } });
            }

            // Script untuk Image Slider di Hero Section
            const sliderContainer = document.getElementById('slider-container');
            if(sliderContainer) {
                const slides = sliderContainer.querySelectorAll('img');
                const totalSlides = slides.length;
                let currentIndex = 0;
                function showNextSlide() { currentIndex = (currentIndex + 1) % totalSlides; sliderContainer.style.transform = `translateX(-${currentIndex * 100}%)`; }
                setInterval(showNextSlide, 3000);
            }
        });
    </script>
</body>
</html>