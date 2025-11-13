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
    </style>
    @stack('styles')
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
                            <svg id="menu-open-icon" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                            <svg id="menu-close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

              
                    <ul class="hidden md:flex space-x-5 mt-1 items-center">
                        <li><a href="{{ url('/') }}#hero" class="nav-link hover:text-blue-600 transition-colors">Beranda</a></li>
                        
                        <!-- ============================================= -->
                        <!-- =========== INI LINK BARU UNTUK JADWAL =========== -->
                        <!-- ============================================= -->
                        <li><a href="{{ url('/') }}#jadwal-ibadah" class="nav-link hover:text-blue-600 transition-colors">Jadwal</a></li>
                        
                        <li><a href="{{ url('/') }}#berita" class="nav-link hover:text-blue-600 transition-colors">Berita</a></li>
                        <li><a href="{{ url('/') }}#kegiatan" class="nav-link hover:text-blue-600 transition-colors">Kegiatan</a></li>
                        <li><a href="{{ url('/') }}#media-sosial" class="nav-link hover:text-blue-600 transition-colors">Media Sosial</a></li>
                        
                        <li class="relative">
                            <button id="dropdown-btn" class="flex items-center gap-1 hover:text-blue-600 transition-colors">
                                Lainnya
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                          
                            <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 border border-gray-200
                                                        opacity-0 invisible transform -translate-y-2 transition-all duration-200 ease-out">
                                <a href="{{ route('berita.showAll') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Semua Berita</a>
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login Admin</a>
                            </div>
                        </li>
                        
                        <div class="flex items-center space-x-2 ml-4">
                            <img src="{{ asset('image/logo/logo_GKMI.png') }}" alt="Logo GKMI" class="h-10 w-auto">
                            <img src="{{ asset('image/logo/logo_myg.png') }}" alt="Logo MYG" class="h-10 w-auto">
                        </div>
                    </ul>

                   
                    <div id="mobile-menu" 
                        class="absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-xl md:hidden
                                opacity-0 invisible transform -translate-y-2 transition-all duration-300 ease-in-out">
                        <a href="{{ url('/') }}#hero" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Beranda</a>

                        <!-- ============================================= -->
                        <!-- =========== INI LINK BARU UNTUK JADWAL (MOBILE) =========== -->
                        <!-- ============================================= -->
                        <a href="{{ url('/') }}#jadwal-ibadah" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Jadwal</a>

                        <a href="{{ url('/') }}#berita" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Berita</a>
                        <a href="{{ url('/') }}#kegiatan" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Kegiatan</a>
                        <a href="{{ url('/') }}#media-sosial" class="nav-link mobile-menu-link block py-3 px-5 text-sm hover:bg-gray-100">Media Sosial</a>
                        
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
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} PERMATA MYG. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-open-icon');
            const closeIcon = document.getElementById('menu-close-icon');
            const menuLinks = document.querySelectorAll('.mobile-menu-link');

            const toggleMenu = () => {
                mobileMenu.classList.toggle('menu-open');
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
                const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
                menuBtn.setAttribute('aria-expanded', !isExpanded);
            };
            
            menuBtn.addEventListener('click', toggleMenu);

            menuLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (mobileMenu.classList.contains('menu-open')) {
                        toggleMenu();
                    }
                });
            });

            const allNavLinks = document.querySelectorAll('.nav-link');
            allNavLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    const isHomePage = window.location.pathname === '/' || window.location.pathname.endsWith('index.php') || window.location.pathname === '';
                    if (href.includes('#') && isHomePage) {
                        const targetId = href.substring(href.indexOf('#') + 1);
                        const targetElement = document.getElementById(targetId);
                        if(targetElement) {
                            e.preventDefault();
                            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    }
                });
            });

            const dropdownBtn = document.getElementById('dropdown-btn');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (dropdownBtn && dropdownMenu) {
                dropdownBtn.addEventListener('click', function(event) {
                    event.stopPropagation(); 
                    dropdownMenu.classList.toggle('opacity-0');
                    dropdownMenu.classList.toggle('invisible');
                    dropdownMenu.classList.toggle('-translate-y-2');
                });

                window.addEventListener('click', function(event) {
                    if (!dropdownMenu.contains(event.target) && !dropdownBtn.contains(event.target)) {
                        dropdownMenu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>