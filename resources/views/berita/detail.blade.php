
@extends('layouts.main') 


@section('title', $berita->judul)

@section('content')
<main class="pt-16 pb-16 lg:pt-24 lg:pb-24 bg-white">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
        <article class="mx-auto w-full max-w-3xl format format-sm sm:format-base lg:format-lg">
            
            <header class="mt-4 mb-4 lg:mb-6 not-format">
             
                <div class="mt-4 mb-6 text-sm">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Home</a>
                    <span class="text-gray-500 mx-2">></span>
                    <a href="{{ route('berita.showAll') }}" class="text-blue-600 hover:underline">Berita</a>
                    <span class="text-gray-500 mx-2">></span>
                    <span class="text-gray-700">{{ Str::limit($berita->judul, 30) }}</span>
                </div>
                
               
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">
                    {{ $berita->judul }}
                </h1>
                
              
                <p class="text-base text-gray-500">
                    <time pubdate datetime="{{ $berita->created_at->toIso8601String() }}">
                        Dipublikasikan pada {{ $berita->created_at->translatedFormat('l, d F Y') }}
                    </time>
                </p>
            </header>

           
            @if($berita->gambar)
                <figure class="my-8">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar untuk {{ $berita->judul }}" class="w-full rounded-lg shadow-lg">
                </figure>
            @endif

            
            <div class="prose max-w-none text-lg text-gray-800 leading-relaxed">
              
                {!! nl2br(e($berita->isi)) !!}
            </div>
        </article>
    </div>
</main>


<aside class="py-8 lg:py-12 bg-gray-50 border-t border-gray-200">
    <div class="px-4 mx-auto max-w-screen-xl">
        <h2 class="mb-8 text-2xl font-bold text-gray-900">Baca Juga Berita Lainnya</h2>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($beritaLain as $item)
                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md">
                    <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900 hover:text-blue-700">
                        <a href="{{ route('berita.show', $item) }}">{{ $item->judul }}</a>
                    </h2>
                    <p class="mb-5 font-light text-gray-500">{{ Str::limit($item->isi, 100) }}</p>
                    <a href="{{ route('berita.show', $item) }}" class="font-medium text-blue-600 hover:underline">
                        Baca selengkapnya &rarr;
                    </a>
                </article>
            @empty
                <p class="col-span-full text-center text-gray-500">Tidak ada berita lain untuk ditampilkan.</p>
            @endforelse
        </div>
    </div>
</aside>
@endsection