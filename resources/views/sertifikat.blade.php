<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan | E-learning ABED</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm no-print">
    <div class="container-fluid"> 
        <a class="navbar-brand font-weight-bold" href="index.html">
            <i class="fas fa-graduation-cap mr-2"></i> E-learning ABED
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html"><i class="fas fa-home mr-1"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html"><i class="fas fa-book mr-1"></i> Katalog</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profDrop" data-toggle="dropdown">
                        <i class="fas fa-user-circle mr-1"></i> Profil
                    </a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow">
                        <a class="dropdown-item" href="#"><i class="fas fa-id-card mr-2 text-muted"></i> Edit Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="index.html"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center py-4 no-print">
    <h2 class="font-weight-bold text-success mb-3 mt-2"><i class="fas fa-award mr-2"></i> Selamat, Kamu Lulus!</h2>
    
    <div class="row justify-content-center mx-0">
        <div class="col-12 px-0">
            <div class="cert-paper">
                <div class="cert-watermark text-uppercase">Verified</div>

                <div style="position: relative; z-index: 1;">
                    <h5 class="text-primary text-uppercase font-weight-bold" style="letter-spacing: 4px;">Sertifikat Kelulusan</h5>
                    <p class="mt-4 text-muted small">Diberikan dengan hormat kepada:</p>
                    
                    <h1 class="font-weight-bold text-dark my-4 text-uppercase">Budi Santoso</h1>
                    
                    <p class="text-muted small">Atas keberhasilannya dalam menyelesaikan materi:</p>
                    <h4 class="font-weight-bold text-primary mb-5 text-uppercase">Web Development Dasar</h4>
                    
                    <div class="row mt-5 mx-0">
                        <div class="col-6 text-left border-top pt-2">
                            <small class="d-block text-muted">Tanggal Terbit:</small>
                            <small class="font-weight-bold text-dark">20 Februari 2026</small>
                        </div>
                        <div class="col-6 text-right border-top pt-2">
                            <small class="d-block text-muted">Otoritas Penerbit:</small>
                            <small class="font-weight-bold text-dark">E-learning ABED Official</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 pb-5">
        <button onclick="window.print()" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
            <i class="fas fa-file-pdf mr-2"></i> Unduh Sertifikat (PDF)
        </button>
        <br>
        <a href="index.html" class="btn btn-link mt-3 text-secondary">Kembali ke Beranda</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>