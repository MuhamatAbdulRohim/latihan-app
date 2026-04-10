<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMB - Penerimaan Mahasiswa Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <h1 class="text-xl font-bold">PMB Kampus</h1>
        <div class="space-x-4">
            <a href="#home" class="hover:underline">Home</a>
            <a href="#about" class="hover:underline">Tentang</a>
            <a href="#program" class="hover:underline">Program</a>
            <a href="#contact" class="hover:underline">Kontak</a>
            <a href="/login" class="bg-white text-blue-600 px-3 py-1 rounded">Login</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section id="home" class="bg-blue-100 py-20">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-4">Penerimaan Mahasiswa Baru</h2>
        <p class="mb-6">Wujudkan masa depanmu bersama kami</p>
        <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg">Daftar Sekarang</a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16">
    <div class="container mx-auto text-center">
        <h3 class="text-2xl font-bold mb-4">Tentang PMB</h3>
        <p class="max-w-2xl mx-auto">
            Sistem Penerimaan Mahasiswa Baru (PMB) adalah platform digital untuk memudahkan calon mahasiswa dalam melakukan pendaftaran secara online.
        </p>
    </div>
</section>

<!-- Program Studi -->
<section id="program" class="bg-gray-100 py-16">
    <div class="container mx-auto">
        <h3 class="text-2xl font-bold text-center mb-8">Program Studi</h3>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <h4 class="font-bold">Teknik Informatika</h4>
                <p>Belajar pemrograman, AI, dan sistem informasi.</p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h4 class="font-bold">Sistem Informasi</h4>
                <p>Fokus pada pengelolaan data dan bisnis digital.</p>
            </div>
            <div class="bg-white p-6 rounded shadow">
                <h4 class="font-bold">Rekayasa Perangkat Lunak</h4>
                <p>Membangun aplikasi modern dan scalable.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 text-center">
    <h3 class="text-2xl font-bold mb-4">Siap Bergabung?</h3>
    <a href="#" class="bg-green-500 text-white px-6 py-3 rounded-lg">Daftar Sekarang</a>
</section>

<!-- Contact -->
<section id="contact" class="bg-blue-600 text-white py-10">
    <div class="container mx-auto text-center">
        <h4 class="text-xl font-bold">Kontak Kami</h4>
        <p>Email: info@kampus.ac.id</p>
        <p>WhatsApp: 0812-3456-7890</p>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <p>&copy; {{ date('Y') }} PMB Kampus. All rights reserved.</p>
</footer>

</body>
</html>
