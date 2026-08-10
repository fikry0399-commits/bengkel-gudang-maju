<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar | E-learing ABED</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm no-print">
    <div class="container-fluid"> 
        <a class="navbar-brand font-weight-bold" href="index.html">
            <i class="fas fa-graduation-cap mr-2"></i> E-learing ABED
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 p-0 sidebar-materi d-none d-lg-block">
                <div id="sidebar-list"></div>
            </div>

            <div class="col-lg-9 bg-white p-4">
                <div class="d-lg-none mb-3">
                    <button class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modalM">
                        <i class="fas fa-list mr-2"></i> Lihat Daftar Materi
                    </button>
                </div>

                <div class="video-container shadow-sm mb-4">
                    <iframe id="mainVideo" src="" allowfullscreen></iframe>
                </div>
                
                <h4 id="materiTitle" class="font-weight-bold">Memuat...</h4>
                <p id="materiDesc" class="text-muted small">Deskripsi materi muncul di sini.</p>

                <div class="card bg-light border-0 mt-4">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-primary"><i class="fas fa-upload mr-2"></i> Unggah Tugas</h6>
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="upTugas" onchange="document.getElementById('fL').innerText=this.files[0].name">
                            <label class="custom-file-label" id="fL">Pilih file...</label>
                        </div>
                        <button class="btn btn-outline-primary btn-sm px-4">Kirim Tugas</button>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                    <button class="btn btn-light border" onclick="prev()"><i class="fas fa-chevron-left mr-2"></i> Kembali</button>
                    <button class="btn btn-success px-5 shadow" onclick="next()">Selesai & Lanjut <i class="fas fa-arrow-right ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalM" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Daftar Materi</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body p-0" id="mobile-list">
                    </div>
            </div>
        </div>
    </div>

    <script>
        const materi = [
            {id:0, t: "1. Pengenalan Web", v: "https://www.youtube.com/embed/zO_nEunAtuA", d: "Materi pembuka tentang sejarah dan cara kerja website."},
            {id:1, t: "2. Struktur HTML", v: "https://www.youtube.com/embed/NBZ7L7Zls98", d: "Belajar tentang tag head, body, dan elemen dasar lainnya."}
        ];

        let cur = 0;

        function load(i) {
            cur = i;
            document.getElementById('mainVideo').src = materi[i].v;
            document.getElementById('materiTitle').innerText = materi[i].t;
            document.getElementById('materiDesc').innerText = materi[i].d;
            
            // Render ulang list agar class "active" berpindah
            render();

            // Tutup modal secara otomatis setelah pilih materi (khusus mobile)
            $('#modalM').modal('hide');
            
            // Scroll ke atas saat ganti materi
            window.scrollTo(0,0);
        }

        function next() {
            if(cur < materi.length - 1) {
                load(cur + 1);
            } else {
                window.location.href = 'sertifikat.html';
            }
        }

        function prev() {
            if(cur > 0) {
                load(cur - 1);
            }
        }

        function render() {
            let h = "";
            materi.forEach((m, i) => {
                h += `<a class="materi-link ${i == cur ? 'active' : ''}" onclick="load(${i})">
                        <i class="fas ${i == cur ? 'fa-play-circle' : 'fa-circle'} mr-2"></i> ${m.t}
                      </a>`;
            });
            
            // Isi ke sidebar (Desktop) dan modal (Mobile)
            document.getElementById('sidebar-list').innerHTML = h;
            document.getElementById('mobile-list').innerHTML = h;
        }

        // Inisialisasi awal saat halaman dibuka
        window.onload = function() {
            load(0);
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>