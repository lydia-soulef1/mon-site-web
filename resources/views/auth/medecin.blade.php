@extends('layouts.main')

@section('content')
<div class="bg-gray-900 text-gray-100 h-screen mx-auto p-4 md:p-6 lg:p-8 flex flex-col items-center">
    <h1 class="text-4xl font-bold text-blue-500 mb-8">
        <i class="fas fa-user-md mr-3"></i>Inscription Médecin
    </h1>

    <!-- Formulaire d'inscription -->
    <form id="registerForm" action="{{ url('/register/medecin') }}" method="POST" class="w-full max-w-md">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-gray-100 text-lg mb-2">Nom complet</label>
            <input type="text" id="name" name="name" placeholder="Dr. Dupont Jean" required
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="email" class="block text-gray-100 text-lg mb-2">Adresse e-mail professionnelle</label>
            <input type="email" id="email" name="email" placeholder="exemple@hopital.com" required
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-100 text-lg mb-2">Mot de passe</label>
            <div class="relative">
                <input type="password" id="password" name="password" placeholder="********" required
                    class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="button" onclick="togglePasswordVisibility()"
                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-200">
                    <i id="eye-icon" class="fas fa-eye"></i>
                </button>
            </div>
            <p class="text-xs text-gray-400 mt-1">8 caractères minimum, avec majuscule et chiffre</p>
        </div>

        <div class="mb-6">
            <label for="hospital" class="block text-gray-100 text-lg mb-2">Établissement médical</label>
            <input type="text" id="hospital" name="hospital" placeholder="Hôpital Necker, Paris" required
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-6">
            <label for="rpps_number" class="block text-gray-100 text-lg mb-2">Numéro RPPS</label>
            <input type="text" id="rpps_number" name="rpps_number" placeholder="12345678901" required
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-xs text-gray-400 mt-1">Votre numéro d'identification professionnel</p>
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="terms" required
                    class="rounded bg-gray-700 border-gray-600 text-blue-500 focus:ring-blue-500">
                <span class="ml-2 text-gray-300">J'accepte les <a href="#" class="text-blue-400 hover:underline">conditions d'utilisation</a></span>
            </label>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
            S'inscrire en tant que pédiatre
        </button>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </form>

    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-400 text-lg mt-6 transition duration-200">
        <i class="fas fa-arrow-left mr-2"></i> Retour
    </a>
</div>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endpush