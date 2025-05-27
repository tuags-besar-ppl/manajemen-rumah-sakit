<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Sistem Manajemen Rumah Sakit</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 bg-white p-8 flex items-center justify-center">
            <img src="{{ asset('uploads/login.png') }}" 
                 alt="Login Illustration" 
                 class="w-full max-w-md object-contain"
                 draggable="false" />
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-400 p-8 md:p-12">
            <div class="max-w-md mx-auto">
                <h1 class="text-4xl font-bold text-white text-center mb-8">
                    Selamat Datang
                </h1>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" 
                                   name="email" 
                                   placeholder="Email" 
                                   class="w-full pl-12 pr-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all"
                                   required 
                                   autofocus />
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" 
                                   name="password" 
                                   placeholder="Password" 
                                   class="w-full pl-12 pr-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all"
                                   required />
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full bg-white text-blue-600 py-3 px-6 rounded-lg font-semibold hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk
                    </button>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mt-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>
</html>
