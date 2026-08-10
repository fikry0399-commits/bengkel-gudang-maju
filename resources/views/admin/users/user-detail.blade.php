@extends('admin.layouts.templates')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail User</h1>
    </div>
</section>

<div class="section-body">
    <div class="row">
        <div class="col-md-4">
            {{-- FOTO --}}
            <div class="card">
                <div class="card-body text-center">
                    <img
                        id="imagePreview"
                        src=""
                        class="img-fluid rounded mb-3"
                        style="max-height: 250px; cursor:pointer"
                        alt="User Image"
                    >
                    <h5 id="nameText" class="mb-0"></h5>
                    <small id="usernameText" class="text-muted"></small>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            {{-- DETAIL --}}
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th width="30%">Nama</th>
                            <td id="nameDetail">-</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td id="usernameDetail">-</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="emailDetail">-</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td id="roleDetail">-</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="statusDetail">-</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="/user" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#modal-change-password">
                            <i class="fas fa-key"></i> Ganti Password User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- MODAL IMAGE --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid rounded">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
{{-- MODAL GANTI PASSWORD KHUSUS ADMIN --}}
<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-key mr-2"></i> Ganti Password User</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-change-password">
                <div class="modal-body">
                    <div class="alert alert-info">
                        Anda akan mengubah password untuk user ini secara paksa (Bypass Admin).
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
$(document).ready(function () {

    let userId = "{{ request()->route('id') }}";

    function loadUserDetail() {
        $.ajax({
            url: `/users/${userId}`,
            method: 'GET',
            success: function (res) {
                $('#imagePreview').attr('src', res.image_url);
                $('#nameText').text(res.name);
                $('#usernameText').text('@' + res.username);
                $('#nameDetail').text(res.name);
                $('#usernameDetail').text(res.username);
                $('#emailDetail').text(res.email ?? '-');
                $('#roleDetail').text(res.role ? res.role.role_name : '-');

                $('#statusDetail').html(
                    res.is_block == 1
                        ? '<span class="badge badge-danger">Blocked</span>'
                        : '<span class="badge badge-success">Active</span>'
                );
            },
            error: function () {
                showToast('error', 'Gagal mengambil data user');
            }
        });
    }

    loadUserDetail();
    $('#imagePreview').on('click', function () {
        let src = $(this).attr('src');
        if (!src) return;

        $('#modalImage').attr('src', src);
        $('#imageModal').modal('show');
    });

$('.toggle-password').on('click', function() {
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

// CHANGE PASSWORD
$('#form-change-password').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this); 
        let btn = $('#btn-save-password');
        let originalText = btn.html();

        btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Memproses...').prop('disabled', true);

        $.ajax({
            // NOTE: URL INI MENGARAH KE ENDPOINT BARU KHUSUS ADMIN (Misal: /users/{id}/change-password)
            url: `/users/${userId}/change-password`, 
            type: "POST", 
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PUT' // Method Spoofing
            },
            success: function(response) {
                btn.html(originalText).prop('disabled', false);
                if(response.status === 'success') {
                    showToast('success', response.message);
                    $('#modal-change-password').modal('hide');
                    $('#form-change-password')[0].reset(); 
                }
            },
            error: function(xhr) {
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
            }
        });
    });

});
</script>
@endpush