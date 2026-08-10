@extends('admin.layouts.templates')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>Pengaturan Profil</h1>
          </div>
          <div class="row">
            <p class="text-muted ml-3">Kelola informasi data diri dan keamanan akun Anda di sini.</p>
          </div>
        </section>
<div class="section-body">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 text-center">
                    <h5 class="card-title font-weight-bold mb-0">Foto Profil</h5>
                </div>
                <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                    @php
                        $avatar = $user->image ? asset('storage/' . $user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random';
                    @endphp
                    
                    <div class="position-relative d-inline-block mt-3" style="cursor: pointer;" data-toggle="modal" data-target="#modal-update-image">
                        <img src="{{ $avatar }}" id="main-profile-image" alt="Profile Picture" class="img-thumbnail rounded-circle shadow-sm" style="width: 160px; height: 160px; object-fit: cover; transition: 0.3s;" onmouseover="this.style.opacity=0.8" onmouseout="this.style.opacity=1">
                        
                        <div class="position-absolute" style="bottom: 10px; right: 10px; background: #fff; border-radius: 50%; padding: 8px 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                            <i class="fas fa-camera text-primary"></i>
                        </div>
                    </div>
                    
                    <p class="text-muted mt-3 small">Klik foto di atas untuk memperbesar atau mengubah gambar.</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title font-weight-bold mb-0">Informasi Pribadi</h5>
                    <button type="button" class="btn btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#modal-change-password">
                        <i class="fas fa-key mr-1"></i> Ganti Password
                    </button>
                </div>
                <div class="card-body">
                    <form id="form-update-profile">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="font-weight-bold">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">Alamat Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-muted">Role (Hak Akses)</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->role ? $user->role->role_name : 'Tidak ada role' }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold text-muted">Status Akun</label>
                                    <input type="text" class="form-control bg-light" value="{{ $user->is_block ? 'Terblokir' : 'Aktif' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" id="btn-save-profile" class="btn btn-primary px-4">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-update-image" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-image mr-2"></i> Detail Foto Profil</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-update-image" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-center bg-light pt-4 pb-4">
                    <img src="{{ $avatar }}" id="preview-image-modal" alt="Profile Picture" class="img-thumbnail rounded shadow-sm mb-4" style="width: 250px; height: 250px; object-fit: cover;">
                    
                    <div class="form-group px-4 mb-0">
                        <div class="custom-file text-left">
                            <input type="file" class="custom-file-input border-primary" id="image" name="image" accept="image/jpeg, image/png, image/jpg">
                            <label class="custom-file-label" for="image">Pilih Foto Baru...</label>
                        </div>
                        <small class="form-text text-muted mt-2 text-left">Format: JPG, JPEG, PNG. Maksimal ukuran file: 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 mt-3">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btn-save-image" class="btn btn-primary font-weight-bold px-4">
                        <i class="fas fa-upload mr-1"></i> Simpan Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-key mr-2"></i> Ganti Password</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-change-password">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="current_password">Password Saat Ini</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            <div class="input-group-append">
                                <span class="input-group-text toggle-password" style="cursor: pointer;">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btn-save-password" class="btn btn-warning font-weight-bold">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image-modal').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ==========================================
    // PROSES UPDATE FOTO PROFIL
    // ==========================================
    $('#form-update-image').on('submit', function(e) {
        e.preventDefault();
        let form = $(this)[0];
        let formData = new FormData(form);
        let btn = $('#btn-save-image');
        let originalText = btn.html();

        btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Mengunggah...').prop('disabled', true);

        $.ajax({
            url: "{{ route('profil.update-image') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                btn.html(originalText).prop('disabled', false);
                if(response.status === 'success') {
                    showToast('success', response.message);
                    $('.navbar .fa-user-circle').replaceWith('<img alt="image" src="'+response.image_url+'" class="rounded-circle mr-1" style="width:30px; height:30px; object-fit:cover;">');
                    $('#main-profile-image').attr('src', response.image_url);
                    $('#modal-update-image').modal('hide');
                }
            },
            error: handleError(btn, originalText)
        });
    });

    // ==========================================
    // PROSES UPDATE DATA PROFIL
    // ==========================================
    $('#form-update-profile').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        console.log('>>>', form)
        let btn = $('#btn-save-profile');
        let originalText = btn.html();

        btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...').prop('disabled', true);

        $.ajax({
            url: "{{ route('profil.update') }}",
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                btn.html(originalText).prop('disabled', false);
                if(response.status === 'success') {
                    showToast('success', response.message);
                    $('#profDrop').html('<i class="fas fa-user-circle mr-1"></i> ' + $('#name').val());
                }
            },
            error: handleError(btn, originalText)
        });
    });

    // ==========================================
    // PROSES GANTI PASSWORD
    // ==========================================
    $('#form-change-password').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let btn = $('#btn-save-password');
        let originalText = btn.html();

        btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Memproses...').prop('disabled', true);

        $.ajax({
            url: "{{ route('profil.update-password') }}",
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                btn.html(originalText).prop('disabled', false);
                if(response.status === 'success') {
                    showToast('success', response.message);
                    $('#modal-change-password').modal('hide');
                    form[0].reset();
                }
            },
            error: handleError(btn, originalText)
        });
    });

    // ==========================================
    // TOGGLE LIHAT PASSWORD DI MODAL
    // ==========================================
    $('.toggle-password').on('click', function() {
        // Cari inputan yang sejajar dengan ikon mata yang diklik
        let input = $(this).closest('.input-group').find('input');
        let icon = $(this).find('i');
        
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
    // ==========================================
    // FUNGSI GLOBAL UNTUK HANDLE ERROR AJAX
    // ==========================================
    function handleError(btn, originalText) {
        return function(xhr) {
            btn.html(originalText).prop('disabled', false);
            let res = xhr.responseJSON;
            
            if (xhr.status === 422) {
                let errors = res.errors;
                $.each(errors, function (key, value) {
                    showToast('error', value[0]);
                });
            } else {
                let message = res.message || 'Terjadi kesalahan pada server';
                showToast('error', message);
            }
        };
    }
    
});
</script>
@endpush