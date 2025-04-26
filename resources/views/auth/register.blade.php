@extends('layouts.main')

@section('content')
<div class="bg-gray-900 text-gray-100 h-screen flex items-center justify-center text-center">
    <div class="container mx-auto p-4 md:p-6 lg:p-8 flex flex-col items-center">
        <h1 class="text-5xl text-blue-500 mb-8">Inscription</h1>
        
        <!-- Choix du rôle (médecin ou parent) -->
        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <!-- Carte pour s'inscrire en tant que parent -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center hover:bg-gray-700 transition duration-300">
                <i class="fas fa-child text-6xl text-blue-500 mb-4"></i>
                <h2 class="text-3xl text-blue-500 mb-4">Parent</h2>
                <p class="text-xl text-gray-100 mb-6">Inscrivez-vous pour suivre les vaccinations de vos enfants et rester en contact avec leur médecin.</p>
                <a href="{{ route('register.parent') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    S'inscrire en tant que parent
                </a>
            </div>

            <!-- Carte pour s'inscrire en tant que médecin -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center hover:bg-gray-700 transition duration-300">
                <i class="fas fa-user-md text-6xl text-blue-500 mb-4"></i>
                <h2 class="text-3xl text-blue-500 mb-4">Médecin</h2>
                <p class="text-xl text-gray-100 mb-6">Inscrivez-vous pour gérer les dossiers médicaux de vos patients et communiquer avec les parents.</p>
                <a href="{{ route('register.medecin') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    S'inscrire en tant que médecin
                </a>
            </div>
        </div>
        
        <!-- Ajouter le lien retour après les cartes -->
        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 text-lg mt-6">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>
</div>
@endsection
