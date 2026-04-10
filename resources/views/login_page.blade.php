<!DOCTYPE html>
<!-- ================= LOGIN PAGE ================= -->
<!-- Simpan sebagai: resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PMB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Login PMB</h2>
        <p class="text-gray-500 text-sm">Masuk untuk melanjutkan pendaftaran</p>
    </div>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="#">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" required
                   class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm">Ingat saya</span>
            </label>
            <a href="#" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
        </div>

        <!-- Button -->
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Login
        </button>
        <a href="/" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Kembali</a>
    </form>

    <div class="text-center mt-6">
        <p class="text-sm text-gray-600">Belum punya akun?</p>
        <a href="#" class="text-blue-600 font-semibold hover:underline">
            Daftar di sini
        </a>
    </div>
</div>

</body>
</html>

