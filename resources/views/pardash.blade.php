<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
@extends('layouts.main')

@section('content')

<div class="dashboard-container">
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('assets/img/logo-white.png') }}" alt="VacciBaby">
        </div>

        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('pardash') }}" class="nav-link active">
                    <i class="fas fa-home"></i> Tableau de bord
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#addChildModal">
                    <i class="fas fa-baby"></i> Ajouter un enfant
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#calendarModal">
                    <i class="fas fa-calendar-alt"></i> Calendrier
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </li>
        </ul>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addChildModalLabel">Ajouter un enfant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a child -->
                    <form action="{{ route('child.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="child_name" class="form-label">Nom de l'enfant</label>
                            <input type="text" class="form-control" id="child_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Sexe</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </div>
                        <!-- Hidden field to pass parent_id -->
                        <input type="hidden" name="parent_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-primary">Ajouter l'enfant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Tableau de Bord</h1>
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr($parent->name, 0, 1)) }}
                </div>
                <div>
                    <div>{{ $parent->name }}</div>
                    <small>{{ $parent->email }}</small>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="card stat-card">
                <div>Enfants enregistrés</div>
                <div class="stat-number">{{ count($children) }}</div>
            </div>
            <div class="card stat-card">
                <div>Vaccins complétés</div>
                <div class="stat-number" style="color: var(--success);">
                    {{ collect($children)->sum('vaccines_done') }}
                </div>
            </div>
            <div class="card stat-card">
                <div>Vaccins à faire</div>
                <div class="stat-number" style="color: var(--warning);">
                    {{ collect($children)->sum(fn($child) => $child['vaccines_total'] - $child['vaccines_done']) }}
                </div>
            </div>
        </div>

        <!-- Upcoming Vaccines -->
        <div class="card">
            <h2 class="card-title">
                <i class="fas fa-bell"></i> Prochains vaccins
            </h2>

            @if (!empty($upcomingVaccines))
            <ul style="list-style: none; padding: 0;">
                @foreach ($upcomingVaccines as $vaccine)
                <li style="padding: 0.75rem 0; border-bottom: 1px dashed var(--gray);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <strong>{{ $vaccine['name'] }}</strong>
                            <div style="font-size: 0.9rem; color: #666;">
                                Pour {{ $vaccine['child_name'] }}
                            </div>
                        </div>
                        <span style="background-color: var(--warning); color: #000; padding: 0.25rem 0.5rem; border-radius: 1rem; font-size: 0.8rem; font-weight: 600;">
                            À {{ $vaccine['age_month'] }} mois
                        </span>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <div style="text-align: center; padding: 1rem; color: #666;">
                <i class="fas fa-check-circle" style="color: var(--success); font-size: 1.5rem; margin-bottom: 0.5rem;"></i>
                <p>Aucun vaccin en attente pour le moment</p>
            </div>
            @endif
        </div>

        <!-- Children List -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <h2 class="card-title">
                    <i class="fas fa-child"></i> Mes enfants
                </h2>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChildModal">
                    <i class="fas fa-plus"></i> Ajouter un enfant
                </a>
            </div>

            @if (!empty($children))
            <div class="children-grid">
                @foreach ($children as $child)
                @php
                $progress = $child['vaccines_total'] > 0 ? round(($child['vaccines_done'] / $child['vaccines_total']) * 100) : 0;
                @endphp
                <div class="card child-card">
                    <div class="child-header">
                        <div class="child-avatar">
                            {{ strtoupper(substr($child['name'], 0, 1)) }}
                        </div>
                        <div>
                            <h3 style="margin: 0;">{{ $child['name'] }}</h3>
                            <small>{{ $child->age }} an(s) - Né(e) le {{ \Carbon\Carbon::parse($child['dob'])->format('d/m/Y') }}</small>
                        </div>
                    </div>

                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <span>Progression vaccinale :</span>
                            <span>{{ $child['vaccines_done'] }}/{{ $child['vaccines_total'] }}</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <a href="#" class="btn btn-primary" style="display: block; text-align: center;" ddata-toggle="modal" data-target="#calendarModal">
                            <i class="fas fa-syringe"></i> Voir le calendrier
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div style="text-align: center; padding: 2rem;">
                <img src="{{ asset('assets/img/empty-child.png') }}" alt="Aucun enfant" style="width: 150px; opacity: 0.6; margin-bottom: 1rem;">
                <h3 style="color: #666; margin-bottom: 0.5rem;">Vous n'avez pas encore ajouté d'enfant</h3>
                <p style="color: #888; margin-bottom: 1.5rem;">Commencez par ajouter votre premier enfant pour suivre son calendrier vaccinal</p>
                <a href="{{ route('child.add') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter un enfant
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calendarModalLabel">Calendrier de Vaccination</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- محتويات تقويم اللقاح -->
                <p>هنا يتم عرض تقويم اللقاحات للطفل.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const childCards = document.querySelectorAll('.child-card');
        childCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = `all 0.3s ease ${index * 0.1}s`;
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `
                <i class="fas fa-exclamation-circle"></i>
                ${decodeURIComponent(urlParams.get('error'))}
            `;
            document.querySelector('.main-content').prepend(errorDiv);

            setTimeout(() => {
                errorDiv.style.transition = 'opacity 1s';
                errorDiv.style.opacity = '0';
                setTimeout(() => errorDiv.remove(), 1000);
            }, 5000);
        }
    });
</script>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection