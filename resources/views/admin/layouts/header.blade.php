<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard &mdash; BENGKEL</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="/admin/dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/admin/dist/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/admin/dist/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="/admin/dist/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="/admin/dist/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="/admin/dist/assets/modules/summernote/summernote-bs4.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/admin/dist/assets/modules/izitoast/css/iziToast.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="/admin/dist/assets/css/style.css">
  <link rel="stylesheet" href="/admin/dist/assets/css/components.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          <img alt="image" src="{{ Auth::check() && Auth::user()->image ? asset('storage/' . Auth::user()->image) : '/admin/dist/assets/img/avatar/avatar-1.png' }}" class="rounded-circle mr-1" style="width: 30px; height: 30px; object-fit: cover;">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::check() ? Auth::user()->name : 'Profil' }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ url('/profil-admin') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>