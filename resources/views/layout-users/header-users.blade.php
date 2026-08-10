<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Learning | ABED</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="/admin/dist/assets/modules/izitoast/css/iziToast.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/front/front-style.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm no-print">
    <div class="container-fluid"> 
        <a class="navbar-brand font-weight-bold" href="/home">
            <i class="fas fa-graduation-cap mr-2"></i> E-learning Abed
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/home"><i class="fas fa-home mr-1"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/home"><i class="fas fa-book mr-1"></i> Katalog</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profDrop" data-toggle="dropdown">
                        @if(Auth::check() && Auth::user()->image)
                            <img alt="image" src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle mr-2" style="width: 30px; height: 30px; object-fit: cover;">
                        @else
                            <i class="fas fa-user-circle mr-2" style="font-size: 1.25rem;"></i>
                        @endif
                        <span>{{ Auth::check() ? Auth::user()->name : 'Profil' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow">
                    <a class="dropdown-item" href="{{ url('/profil') }}"><i class="fas fa-id-card mr-2 text-muted"></i> Edit Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger btn-logout" href="#"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>