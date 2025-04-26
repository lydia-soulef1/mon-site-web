@extends('layouts.main')

@section('content')
<div class="bg-gray-900 text-gray-100 h-screen mx-auto p-4  md:p-6 lg:p-8 flex flex-col items-center">
    <h1 class="text-5xl text-blue-500 mb-8 mt-8">Inscription Parent</h1>

    <form action="{{ route('register.parent') }}" method="POST" class="w-full max-w-md">
        @csrf

        <!-- Champ Nom complet -->
        <div class="mb-6">
            <label for="name" class="block text-gray-100 text-lg mb-2">Nom complet</label>
            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Champ Email -->
        <div class="mb-6">
            <label for="email" class="block text-gray-100 text-lg mb-2">Adresse e-mail</label>
            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Champ Mot de passe -->
        <div class="mb-6">
            <label for="password" class="block text-gray-100 text-lg mb-2">Mot de passe</label>
            <input type="password" id="password" name="password" required
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Champ Confirmation Mot de passe -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-100 text-lg mb-2">Confirmer mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                class="w-full px-4 py-2 bg-gray-700 text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('password_confirmation')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
            S'inscrire
        </button>

        <p class="text-gray-400">Vous pourrez ajouter vos enfants après l'inscription.</p>
    </form>

    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 text-lg mt-6">
        <i class="fas fa-arrow-left mr-2"></i> Retour
    </a>
</div>
@endsection