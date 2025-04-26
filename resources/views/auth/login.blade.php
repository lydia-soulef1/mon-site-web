@extends('layouts.main')

@section('content')
<div class="bg-gray-900 text-gray-100 h-screen flex justify-center items-center">
    <div class="w-full max-w-md p-8 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-4xl text-blue-500 font-bold mb-6 text-center">Connexion</h2>

        <!-- عرض الأخطاء -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-6 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-200 mb-1">Email :</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-200 mb-1">Mot de passe :</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
                Se connecter
            </button>
        </form>

        <p class="mt-6 text-center text-sm">
            Pas encore de compte ?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">S'inscrire</a>
        </p>
    </div>
</div>
@endsection
