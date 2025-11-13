@extends('layouts.main')

@section('content')

{{-- Pastikan Anda telah menyertakan Tailwind CSS CDN di file layouts/main.blade.php Anda --}}
{{-- Contoh: <script src="https://cdn.tailwindcss.com"></script> --}}

<div class="bg-gray-50">


    <!-- ============================================ -->
    <!-- Misi & Visi Section -->
    <!-- ============================================ -->
    <section id="mission" class="mt-7 py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Misi Kami</h2>
            <p class="text-xl italic text-gray-600 max-w-3xl mx-auto">
                "Kami, Permata Maranatha, berkomitmen untuk membentuk mahasiswa dan profesional muda menjadi pribadi yang bertumbuh dalam iman Kristus, saling melayani, dan berdampak positif bagi dunia, sambil menantikan kedatangan Tuhan Yesus."
            </p>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- Sejarah Komunitas (Timeline) Section -->
    <!-- ============================================ -->
    <section id="history" class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-16">Perjalanan Bersama Kami</h2>
            <div class="relative wrap overflow-hidden p-10 h-full">
                <!-- Garis Vertikal di Tengah -->
                <div class="border-2-2 absolute border-opacity-20 border-gray-700 h-full border" style="left: 50%"></div>

                <!-- Item Timeline Kanan -->
                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-indigo-600 shadow-xl w-8 h-8 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">1</h1>
                    </div>
                    <div class="order-1 bg-white rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <h3 class="font-bold text-gray-800 text-xl">2018 - Awal Terbentuk</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-600 text-opacity-100">Permata Maranatha didirikan dengan visi untuk menyatukan mahasiswa dan profesional muda dalam iman dan persekutuan.</p>
                    </div>
                </div>

                <!-- Item Timeline Kiri -->
                <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-indigo-600 shadow-xl w-8 h-8 rounded-full">
                        <h1 class="mx-auto text-white font-semibold text-lg">2</h1>
                    </div>
                    <div class="order-1 bg-white rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <h3 class="font-bold text-gray-800 text-xl">2020 - Pertumbuhan Rohani</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-600 text-opacity-100">Melalui studi Alkitab dan doa bersama, kami bertumbuh dalam pengenalan akan Kristus dan melayani lebih dari 100 anggota.</p>
                    </div>
                </div>

                <!-- Item Timeline Kanan -->
                <div class="mb-8 flex justify-between items-center w-full right-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-indigo-600 shadow-xl w-8 h-8 rounded-full">
                        <h1 class="mx-auto font-semibold text-lg text-white">3</h1>
                    </div>
                    <div class="order-1 bg-white rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <h3 class="font-bold text-gray-800 text-xl">2022 - Perluasan Pelayanan</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-600 text-opacity-100">Jangkauan pelayanan kami diperluas ke berbagai kampus dan lingkungan kerja, dengan tim yang lebih solid.</p>
                    </div>
                </div>

                <!-- Item Timeline Kiri -->
                <div class="mb-8 flex justify-between flex-row-reverse items-center w-full left-timeline">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center order-1 bg-indigo-600 shadow-xl w-8 h-8 rounded-full">
                        <h1 class="mx-auto text-white font-semibold text-lg">4</h1>
                    </div>
                    <div class="order-1 bg-white rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <h3 class="font-bold text-gray-800 text-xl">Masa Depan</h3>
                        <p class="text-sm leading-snug tracking-wide text-gray-600 text-opacity-100">Terus menjadi terang dan garam dunia, mengembangkan pemimpin Kristen masa depan, dan setia menanti Maranatha.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================ -->
    <!-- Tim Kami Section (Tetap dikomentari, tapi saya ubah isinya) -->
    <!-- ============================================ -->
    {{-- <section id="team" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Pemimpin Pelayanan Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Anggota Tim 1 -->
                <div class="text-center group">
                    <div class="relative inline-block">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Nama Anggota Tim" class="rounded-full w-40 h-40 object-cover mx-auto border-4 border-white shadow-lg group-hover:border-indigo-500 transition-all duration-300">
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Ariel Tonglo</h3>
                    <p class="text-gray-500">Ketua PERMATA<br> Sektor Minahasa Tomohon</p>
                </div>
                <!-- Anggota Tim 2 -->
                <div class="text-center group">
                     <div class="relative inline-block">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026702d" alt="Nama Anggota Tim" class="rounded-full w-40 h-40 object-cover mx-auto border-4 border-white shadow-lg group-hover:border-indigo-500 transition-all duration-300">
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Solagratia Lumansik</h3>
                    <p class="text-gray-500">Wa. Ketua PERMATA<br> Sektor Minahasa Tomohon</p>
                </div>
                <!-- Anggota Tim 3 (Contoh jika ada posisi lain yang lebih umum di komunitas) -->
                <div class="text-center group">
                     <div class="relative inline-block">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026706d" alt="Nama Anggota Tim" class="rounded-full w-40 h-40 object-cover mx-auto border-4 border-white shadow-lg group-hover:border-indigo-500 transition-all duration-300">
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Nama Anggota</h3>
                    <p class="text-gray-500">Koordinator Bidang Pendidikan</p>
                </div>
                <!-- Anggota Tim 4 (Contoh jika ada posisi lain yang lebih umum di komunitas) -->
                <div class="text-center group">
                     <div class="relative inline-block">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026708d" alt="Nama Anggota Tim" class="rounded-full w-40 h-40 object-cover mx-auto border-4 border-white shadow-lg group-hover:border-indigo-500 transition-all duration-300">
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-gray-800">Nama Anggota</h3>
                    <p class="text-gray-500">Bendahara Umum</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ============================================ -->
    <!-- Nilai-Nilai Kami Section -->
    <!-- ============================================ -->
    <section id="values" class="py-16 md:py-24">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-12">Nilai-Nilai Kristiani Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <!-- Nilai 1: Integritas dalam Kristus -->
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                    <!-- SVG Icon for Integrity -->
                    <div class="flex items-center justify-center h-20 w-20 rounded-full bg-indigo-100 mx-auto mb-6">
                        <svg class="w-10 h-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 20.944A12.02 12.02 0 0012 21a12.02 12.02 0 009-8.056z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Integritas dalam Kristus</h3>
                    <p class="text-gray-600">Kami menjunjung tinggi kejujuran dan keteladanan yang mencerminkan karakter Kristus dalam setiap aspek hidup.</p>
                </div>
                <!-- Nilai 2: Pertumbuhan Rohani & Inovasi -->
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                    <!-- SVG Icon for Growth/Innovation (I've kept the innovation icon, but the text emphasizes spiritual growth) -->
                    <div class="flex items-center justify-center h-20 w-20 rounded-full bg-indigo-100 mx-auto mb-6">
                        <svg class="w-10 h-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Pertumbuhan Rohani & Relevansi</h3>
                    <p class="text-gray-600">Kami senantiasa mencari cara baru untuk bertumbuh dalam iman dan menyampaikan Injil secara relevan bagi generasi kini.</p>
                </div>
                <!-- Nilai 3: Persekutuan dan Pelayanan -->
                <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform duration-300">
                    <!-- SVG Icon for Collaboration (changed text to emphasize fellowship and service) -->
                    <div class="flex items-center justify-center h-20 w-20 rounded-full bg-indigo-100 mx-auto mb-6">
                        <svg class="w-10 h-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Persekutuan & Pelayanan</h3>
                    <p class="text-gray-600">Kami percaya pada kekuatan kebersamaan dalam persekutuan dan melayani sesama dengan kasih Kristus.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection