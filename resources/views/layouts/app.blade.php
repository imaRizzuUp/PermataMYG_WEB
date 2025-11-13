<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'PERMATA' }}</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <script>
        (() => {
            const getStoredTheme = () => localStorage.getItem('theme');
            const setStoredTheme = theme => localStorage.setItem('theme', theme);
            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme();
                if (storedTheme) { return storedTheme; }
                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            };
            const setTheme = theme => {
                let effectiveTheme = theme;
                if (theme === 'auto') {
                    effectiveTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                document.documentElement.setAttribute('data-bs-theme', effectiveTheme);
            };
            setTheme(getPreferredTheme());
        })();
    </script>
    
    
    <style>
        :root {
            --primary-color: #4f46e5; --bs-body-bg: #f8f9fa; --element-bg: #ffffff; --bs-body-color: #1f2937; --text-secondary: #6b7280; --border-color: #e5e7eb; --hover-bg: #f3f4f6; --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05);
        }
        [data-bs-theme="dark"] {
            --primary-color: #6366f1; --bs-body-bg: #111827; --element-bg: #1f2937; --bs-body-color: #f9fafb; --text-secondary: #9ca3af; --border-color: #374151; --hover-bg: #374151; --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2); --bs-offcanvas-bg: var(--element-bg); --bs-offcanvas-border-color: var(--border-color); --bs-btn-close-color: #fff; --bs-btn-outline-secondary-color: #adb5bd; --bs-btn-outline-secondary-border-color: #6c757d; --bs-btn-outline-secondary-hover-bg: #6c757d; --bs-btn-outline-secondary-hover-color: #fff; --bs-btn-outline-secondary-active-bg: #5c636a; --bs-btn-outline-secondary-active-color: #fff;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bs-body-bg); color: var(--bs-body-color); }
        @media (min-width: 992px) {
            body { display: flex; min-height: 100vh; }
            .main-content-wrapper { flex-grow: 1; overflow-x: hidden; }
        }
        .solid-white-bg { background-color: var(--element-bg); }
        .sidebar-desktop { border-right: 1px solid var(--border-color); }
        .top-navbar { border-bottom: 1px solid var(--border-color); }
        .card { border: 1px solid var(--border-color); box-shadow: var(--shadow); border-radius: 1rem; }
        .sidebar-brand, .sidebar-mobile-brand { color: var(--bs-body-color); }
        .nav-link { color: var(--text-secondary); }
        .sidebar-desktop .nav-link:hover, .sidebar-mobile .nav-link:hover { color: var(--primary-color); background-color: var(--hover-bg); }
        .nav-link.active { color: #ffffff; background-color: var(--primary-color); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        [data-bs-theme="dark"] .nav-link.active { box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); }
        .sidebar-mobile .offcanvas-header { border-bottom: 1px solid var(--border-color); }
        .sidebar-desktop { width: 260px; flex-shrink: 0; padding: 1rem; }
        .sidebar-brand { font-size: 1.5rem; font-weight: 700; padding: 1rem 0.5rem; }
        .sidebar-desktop .nav-link { font-size: 1rem; font-weight: 500; padding: 12px 20px; margin-bottom: 8px; border-radius: 0.75rem; transition: all 0.2s ease-in-out; }
        .sidebar-desktop .nav-link .bi, .sidebar-mobile .nav-link .bi { margin-right: 15px; font-size: 1.2rem; }
        .sidebar-mobile .nav-link { font-size: 1.1rem; font-weight: 500; padding: 1rem 1.25rem; border-radius: 0.75rem; margin-bottom: 4px; transition: all 0.2s ease-in-out; }
        .sidebar-mobile-brand { font-size: 1.5rem; font-weight: 700; }
        .top-navbar { position: sticky; top: 0; z-index: 1020; }
        .avatar-initials { display: inline-flex; align-items: center; justify-content: center; font-weight: 600; color: #fff; background-color: var(--primary-color); width: 40px; height: 40px; }
        .sidebar-logo { max-height: 40px; margin-right: 10px; }
        .theme-switcher-container { position: relative; display: inline-flex; background-color: var(--hover-bg); border-radius: 0.85rem; padding: 5px; }
        .theme-btn { border: none; background: transparent; color: var(--text-secondary); font-weight: 500; padding: 6px 16px; cursor: pointer; position: relative; z-index: 1; transition: color 0.3s ease; }
        .theme-btn.active { color: #fff; }
        [data-bs-theme="dark"] .theme-btn.active { color: var(--bs-body-color); }
        .theme-slider { position: absolute; top: 5px; left: 5px; height: calc(100% - 10px); background-color: var(--primary-color); border-radius: 0.75rem; z-index: 0; transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }
    </style>
    @stack('styles')
</head>
<body>
    @auth
        <nav class="sidebar-desktop d-none d-lg-flex flex-column solid-white-bg">
            <div>
                <div class="sidebar-brand d-flex align-items-center justify-content-center">
                    <img src="{{ asset('image/logo/logo_permatamyg.png') }}" alt="PERMATA Logo" class="sidebar-logo">
                </div>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('statistik.index') ? 'active' : '' }}" href="{{ route('statistik.index') }}"><i class="bi bi-bar-chart-line-fill"></i>Statistik</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('anggota.index') ? 'active' : '' }}" href="{{ route('anggota.index') }}"><i class="bi bi-person-lines-fill"></i>Anggota Terdaftar</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('daftaradmin') ? 'active' : '' }}" href="{{ route('daftaradmin') }}"><i class="bi bi-people-fill"></i>Daftar Admin</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}"><i class="bi bi-newspaper"></i>Daftar Berita</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('jadwal-ibadah.index') ? 'active' : '' }}" href="{{ route('jadwal-ibadah.index') }}"><i class="bi bi-calendar-check-fill"></i>Jadwal Ibadah</a></li>
                </ul>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start sidebar-mobile" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
            <div class="offcanvas-header"><h5 class="offcanvas-title sidebar-mobile-brand d-flex align-items-center" id="mobileSidebarLabel"><img src="{{ asset('image/logo/logo_permatamyg.png') }}" alt="PERMATA Logo" class="sidebar-logo"></h5><button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button></div>
            <div class="offcanvas-body p-2">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('statistik.index') ? 'active' : '' }}" href="{{ route('statistik.index') }}"><i class="bi bi-bar-chart-line-fill"></i>Statistik</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('anggota.index') ? 'active' : '' }}" href="{{ route('anggota.index') }}"><i class="bi bi-person-lines-fill"></i>Anggota Terdaftar</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('daftaradmin') ? 'active' : '' }}" href="{{ route('daftaradmin') }}"><i class="bi bi-people-fill"></i>Daftar Admin</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita.index') ? 'active' : '' }}" href="{{ route('berita.index') }}"><i class="bi bi-newspaper"></i>Daftar Berita</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('jadwal-ibadah.index') ? 'active' : '' }}" href="{{ route('jadwal-ibadah.index') }}"><i class="bi bi-calendar-check-fill"></i>Jadwal Ibadah</a></li>
                </ul>
            </div>
        </div>
    @endauth

    <div class="main-content-wrapper">
        <header class="top-navbar p-3 solid-white-bg">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                {{-- Gunakan @auth untuk mencegah error jika tamu mengakses halaman --}}
                @auth
                    <button class="btn d-lg-none p-0 border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar"><i class="bi bi-list fs-2"></i></button>
                    <h5 class="d-none d-lg-block mb-0 fw-bold">{{ $title ?? 'Dashboard' }}</h5>
                    <h5 class="d-lg-none mb-0 fw-bold">{{ $title ?? 'PERMATA' }}</h5>
                    <div class="ms-auto d-flex align-items-center">
                        <div class="avatar-initials rounded-circle">{{ auth()->user()->initials }}</div>
                        <div class="dropdown" id="settingsDropdown">
                            <button class="btn btn-link nav-link p-0 ms-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Pengaturan"><i class="bi bi-gear-fill fs-4"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="min-width: 250px;">
                                <li>
                                    <div class="px-3 py-2">
                                        {{-- =============================================== --}}
                                        {{-- === INI PERUBAHAN UTAMA YANG ANDA BUTUHKAN === --}}
                                        {{-- =============================================== --}}
                                        <strong class="d-block">{{ auth()->user()->anggota->nama ?? 'Nama Anggota' }}</strong>
                                        {{-- =============================================== --}}
                                        <small class="text-muted">{{ auth()->user()->jabatan }}</small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item fw-medium d-flex align-items-center" href="#"><i class="bi bi-person-circle me-2"></i> Akun Settings</a></li> {{-- PERBAIKI href JIKA ROUTE SUDAH ADA --}}
                                <li><h6 class="dropdown-header mt-2">Pilih Tema</h6></li>
                                <li>
                                    <div class="px-3 py-1">
                                        <div class="theme-switcher-container">
                                            <div class="theme-slider"></div>
                                            <button type="button" class="theme-btn" data-bs-theme-value="light" title="Tema Terang"><i class="bi bi-sun-fill"></i></button>
                                            <button type="button" class="theme-btn" data-bs-theme-value="dark" title="Tema Gelap"><i class="bi bi-moon-stars-fill"></i></button>
                                            <button type="button" class="theme-btn" data-bs-theme-value="auto" title="Tema Sistem"><i class="bi bi-circle-half"></i></button>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item text-danger fw-medium d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-main').submit();"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </header>
        
        <main class="container-fluid p-3 p-lg-4">
            @yield('konten')
        </main>
    </div>

    @auth
        <form id="logout-form-main" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    @endauth
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek jika elemen-elemen ini ada sebelum menambahkan event listener
            // Ini untuk mencegah error jika layout digunakan oleh tamu yang tidak memiliki dropdown
            const settingsDropdown = document.getElementById('settingsDropdown');
            if (settingsDropdown) {
                const getStoredTheme = () => localStorage.getItem('theme');
                const setStoredTheme = theme => localStorage.setItem('theme', theme);
                const getPreferredTheme = () => {
                    const storedTheme = getStoredTheme();
                    if (storedTheme) return storedTheme;
                    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                };
                const setTheme = theme => {
                    let effectiveTheme = theme;
                    if (theme === 'auto') {
                        effectiveTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    }
                    document.documentElement.setAttribute('data-bs-theme', effectiveTheme);
                };

                const themeSlider = document.querySelector('.theme-slider');
                const themeButtons = document.querySelectorAll('.theme-btn');

                function moveThemeSlider(targetButton) {
                    if (!targetButton) return;
                    const targetRect = targetButton.getBoundingClientRect();
                    const containerRect = targetButton.parentElement.getBoundingClientRect();
                    themeSlider.style.width = `${targetRect.width}px`;
                    themeSlider.style.transform = `translateX(${targetRect.left - containerRect.left}px)`;
                }

                function initializeThemeUI() {
                    const currentTheme = getPreferredTheme();
                    themeButtons.forEach(btn => btn.classList.remove('active'));
                    const activeBtn = document.querySelector(`.theme-btn[data-bs-theme-value="${currentTheme}"]`);
                    if (activeBtn) {
                        activeBtn.classList.add('active');
                    }
                }

                themeButtons.forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value');
                        setStoredTheme(theme);
                        setTheme(theme);
                        initializeThemeUI();
                        moveThemeSlider(toggle);
                    });
                });

                settingsDropdown.addEventListener('show.bs.dropdown', () => {
                    setTimeout(() => {
                        const activeBtn = document.querySelector('.theme-btn.active');
                        moveThemeSlider(activeBtn);
                    }, 10); 
                });

                initializeThemeUI();
                
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (getStoredTheme() === 'auto') {
                        setTheme('auto');
                        initializeThemeUI();
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>