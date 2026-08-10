@extends('layout-users.template-users')
@section('conten-users')
        <div class="category-container mb-3">
            <button class="btn btn-primary btn-sm rounded-pill px-4 mx-1">Semua</button>
            <button class="btn btn-white btn-sm border rounded-pill px-4 mx-1">Programming</button>
            <button class="btn btn-white btn-sm border rounded-pill px-4 mx-1">Design</button>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card card-course">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=300" alt="Web">
                    <div class="card-body">
                        <h6 class="card-title">Web Development Dasar</h6>
                        <p class="card-text small text-muted">HTML, CSS, dan JS.</p>
                        <a href="materi.html" class="btn btn-primary btn-sm btn-block mt-2">Mulai Belajar</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card card-course">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=300" alt="Web">
                    <div class="card-body">
                        <h6 class="card-title">Belajar AI Tools</h6>
                        <p class="card-text small text-muted">Belajar membuat AI tools</p>
                        <a href="materi.html" class="btn btn-primary btn-sm btn-block mt-2">Mulai Belajar</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-3">
                <div class="card card-course">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=300" alt="Web">
                    <div class="card-body">
                        <h6 class="card-title">Belajar Adobe Ilustrator</h6>
                        <p class="card-text small text-muted">Belajar design dengan adobe ilustrator</p>
                        <a href="materi.html" class="btn btn-primary btn-sm btn-block mt-2">Mulai Belajar</a>
                    </div>
                </div>
            </div>
        </div>
@endsection