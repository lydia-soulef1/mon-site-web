@extends('layouts.main')

@section('content')
<section id="accueil" class="hero py-12 bg-blue-100 text-center" style="background-image: url('{{ asset('images/mother_baby.jpg') }}'); background-size: cover; background-position: center;">
    <div class="hero-content bg-white bg-opacity-80 p-8 rounded-lg">
        <h1 class="text-3xl font-bold text-[#4A90E2]">Assurez la protection de votre enfant grâce à un suivi vaccinal intelligent !</h1>
        <p class="text-lg mt-4 text-gray-700">Une solution facile pour suivre les vaccinations et recevoir des rappels.</p>
        <a href="{{ route('register') }}" class="mt-6 inline-block bg-[#4A90E2] text-white px-6 py-2 rounded-lg hover:bg-blue-700">S'inscrire maintenant</a>
    </div>
</section>


<section id="features" class="features py-12">
    <h2 class="text-3xl text-center text-[#4A90E2]">Nos Fonctionnalités</h2>
    <div class="feature-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="feature-item text-center">
            <img src="{{ asset('images/calendar-icon.png') }}" alt="Calendrier" class="mx-auto mb-4">
            <p>📅 Suivi des vaccins</p>
        </div>
        <div class="feature-item text-center">
            <img src="{{ asset('images/reminder-icon.png') }}" alt="Rappel" class="mx-auto mb-4">
            <p>🔔 Rappels automatiques</p>
        </div>
        <div class="feature-item text-center">
            <img src="{{ asset('images/doctor-icon.png') }}" alt="Médecin" class="mx-auto mb-4">
            <p>🩺 Accès pour médecins</p>
        </div>
        <div class="feature-item text-center">
            <img src="{{ asset('images/security-icon.png') }}" alt="Sécurité" class="mx-auto mb-4">
            <p>🔐 Sécurité des données</p>
        </div>
    </div>
</section>

<section id="conditions" class="conditions py-12">
    <h2 class="text-3xl text-center text-[#4A90E2]">Conditions de Vaccination</h2>
    <p class="text-lg mt-4 text-center text-gray-700">Pour garantir l'efficacité et la sécurité des vaccins, certaines conditions doivent être respectées :</p>
    <ul class="list-disc list-inside mt-6 text-gray-700 mx-auto max-w-prose">
        <li>✔️ L'enfant doit être en bonne santé au moment de la vaccination.</li>
        <li>✔️ Respect des délais entre les doses pour une protection optimale.</li>
        <li>✔️ Vérification des antécédents médicaux et des allergies éventuelles.</li>
        <li>✔️ Utilisation de vaccins certifiés et conservés dans des conditions optimales.</li>
    </ul>
</section>

<section id="importance" class="importance py-12">
    <h2 class="text-3xl text-center text-[#4A90E2]">Pourquoi la Vaccination est-elle Importante ?</h2>
    <p class="text-lg mt-4 text-center text-gray-700">La vaccination infantile joue un rôle clé dans la protection de la santé publique :</p>
    <ul class="list-disc list-inside mt-6 text-gray-700 mx-auto max-w-prose">
        <li>🛡️ Protège contre des maladies graves comme la rougeole, la polio et la diphtérie.</li>
        <li>👶 Renforce le système immunitaire des enfants dès leur plus jeune âge.</li>
        <li>🌍 Contribue à l'éradication de maladies grâce à l'immunité collective.</li>
        <li>❤️ Réduit les risques de complications graves et de mortalité infantile.</li>
    </ul>
</section>

<section id="vaccins" class="vaccins py-12">
    <h3 class="text-3xl text-center text-[#4A90E2]">Les principaux vaccins et âges recommandés</h3>
    <table class="table-auto mx-auto mt-6 text-gray-700 border-collapse">
        <thead>
            <tr class="bg-[#4A90E2] text-white">
                <th class="px-4 py-2">Âge</th>
                <th class="px-4 py-2">Vaccin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-4 py-2">2 mois</td>
                <td class="px-4 py-2">DTaP, Polio, Hépatite B, Pneumocoque</td>
            </tr>
            <tr>
                <td class="px-4 py-2">4 mois</td>
                <td class="px-4 py-2">Rappel DTaP, Polio, Pneumocoque</td>
            </tr>
            <tr>
                <td class="px-4 py-2">12 mois</td>
                <td class="px-4 py-2">Rougeole, Oreillons, Rubéole (ROR)</td>
            </tr>
        </tbody>
    </table>
</section>

<footer class="bg-[#4A90E2] py-4 text-center text-white">
    <p>&copy; 2025 Vaccination Infantile. Tous droits réservés.</p>
</footer>

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
@endsection