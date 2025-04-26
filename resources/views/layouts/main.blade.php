<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vaccination Infantile')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="bg-[#4A90E2] py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <!-- Logo -->
            <a href="{{ route('welcome') }}" class="logo text-white text-3xl font-semibold hover:text-gray-300 cursor-pointer transition duration-300 ease-in-out">
                Vaccination Infantile
            </a>

            <!-- Navbar -->
            <nav class="hidden md:flex space-x-6">
                <ul class="flex space-x-6">
                    <li><a href="#features" class="text-white hover:text-gray-300">Fonctionnalités</a></li>
                    <li><a href="#conditions" class="text-white hover:text-gray-300">Conditions</a></li>
                    <li><a href="#importance" class="text-white hover:text-gray-300">Importance</a></li>
                    <li><a href="#vaccins" class="text-white hover:text-gray-300">Vaccin</a></li>
                    <ul class="flex space-x-6">
                        @auth
                        @if(auth()->user()->is_pediatrician)
                        <li><a href="{{ route('meddash') }}" class="text-white bg-red-600 hover:bg-red-700 hover:text-gray-300 font-semibold px-4 py-2 rounded-full transition duration-300 ease-in-out">Dashboard</a></li>
                        @else
                        <li><a href="{{ route('pardash') }}" class="text-white bg-green-600 hover:bg-green-700 hover:text-gray-300 font-semibold px-4 py-2 rounded-full transition duration-300 ease-in-out">Dashboard</a></li>
                        @endif

                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-white bg-gray-600 hover:bg-gray-700 hover:text-gray-300 font-semibold px-4 py-2 rounded-full transition duration-300 ease-in-out">Logout</button>
                            </form>
                        </li>
                        @else
                        <li><a href="{{ route('login') }}" class="bg-white text-[#4A90E2] px-4 py-2 rounded-full hover:bg-gray-100">Login</a></li>
                        @endauth
                    </ul>
                </ul>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-[#4A90E2] text-white py-4">
            <ul class="space-y-4 px-4">
                <li><a href="#accueil" class="block hover:text-gray-300">Accueil</a></li>
                <li><a href="#features" class="block hover:text-gray-300">Fonctionnalités</a></li>
                <li><a href="#conditions" class="block hover:text-gray-300">Conditions</a></li>
                <li><a href="#importance" class="block hover:text-gray-300">Importance</a></li>
                <li><a href="#vaccins" class="block hover:text-gray-300">Vaccin</a></li>
                <li><a href="login.html" class="block bg-white text-[#4A90E2] px-4 py-2 rounded-full hover:bg-gray-100">Connexion</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content Section -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-[#4A90E2] py-4 text-center text-white">
        <p>&copy; 2025 Vaccination Infantile. Tous droits réservés.</p>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-4 right-4 bg-[#4A90E2] text-white p-3 rounded-full shadow-md hover:bg-blue-700">⬆ Retour en haut</button>

    <script>
        document.getElementById("backToTop").addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });

        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>