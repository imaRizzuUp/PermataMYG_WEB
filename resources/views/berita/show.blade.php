
@extends('layouts.main')

@section('title', 'Semua Berita')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        
      
        <div class="mt-7 mb-8 text-sm">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Home</a>
            <span class="text-gray-500 mx-2">></span>
            <span class="text-gray-700">Semua Berita</span>
        </div>

        <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Semua Berita</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($beritas as $berita)
 
                <a href="{{ route('berita.show', $berita) }}" class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="overflow-hidden">
              
                        <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                             src="{{ $berita->gambar ? asset('storage/'.$berita->gambar) : 'https://via.placeholder.com/400x200.png?text=Tanpa+Gambar' }}"
                             alt="Gambar untuk {{ $berita->judul }}">
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-gray-500 mb-2">{{ $berita->created_at->translatedFormat('d F Y') }}</p>
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 group-hover:text-blue-700 transition-colors">
                            {{ $berita->judul }}
                        </h3>
                        <p class="text-gray-600 text-base leading-relaxed">
                            {{ Str::limit($berita->isi, 120) }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-gray-500 text-xl">Belum ada berita yang dipublikasikan saat ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $beritas->links() }}
        </div>

    </div>
</section>
@endsection