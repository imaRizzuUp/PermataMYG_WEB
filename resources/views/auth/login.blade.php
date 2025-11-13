<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin | PERMATA MYG</title>

   
    <script src="https://cdn.tailwindcss.com"></script>

    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    
    <div class="min-h-screen flex items-center justify-center px-4">
        
        <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8 space-y-6">
            
          
            <div class="text-center">
                <a href="{{ route('home') }}">
                    
                    <img class="mx-auto h-16 w-auto" src="{{ asset('image/logo/logo_permatamyg.png') }}" alt="Logo PERMATA MYG">
                </a>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Login Admin
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Selamat datang kembali! Masuk untuk melanjutkan.
                </p>
            </div>

        
            <form method="POST" action="{{ route('autentikasi') }}" class="space-y-6">
                @csrf

                @if (session('status'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif
                
              
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Alamat Email
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="contoh@permatamyg.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

               
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                               placeholder="••••••••">
                    </div>
                    @error('password')
                         <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

           
                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                        Masuk
                    </button>
                </div>
            </form>

       
            <p class="text-center text-sm text-gray-500">
                Bukan Admin? 
                <a href="{{ route('home') }}" class="font-medium text-blue-600 hover:text-blue-700">
                    Kembali ke Beranda
                </a>
            </p>

        </div>
    </div>

</body>
</html>