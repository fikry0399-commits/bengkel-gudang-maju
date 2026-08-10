@extends('admin.layouts.templates')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>Create Data</h1>
          </div>
          <div class="row">
             
          </div>
        </section>
        <div class="section-body">
            <div class="col-12">
                <form id="userForm">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label for="role_id">Role</label>
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">Silahkan Pilih</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <label for="image">Upload</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <a href="/user" class="btn btn-secondary">Cancel</a>
                                    <button type="submit" class="btn btn-primary" id="btn-save">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {
    $('#role_id').select2({
        placeholder: 'Silahkan Pilih Role',
        allowClear: true,
        width: '100%'
    });
    loadRoles();
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "{{route('users.store')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            beforeSend: function () {
                $('#btn-save').prop('disabled', true).text('Saving...');
            },
            success: function (res) {
                showToast('success', 'User berhasil dibuat');

                setTimeout(function () {
                    window.location.href = '/user';
                }, 1200);
            },
            error: function (xhr) {
                $('#btn-save').prop('disabled', false).text('Submit');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        showToast('error', value[0]);
                    });
                } else {
                    showToast('error', 'Terjadi kesalahan pada sistem');
                }
            }
        })
    })

    });
function loadRoles() {
    $.ajax({
        url: '/roles',
        type: 'GET',
        dataType: 'json',
        success: function (res) {
            let options = '<option value="">Silahkan Pilih</option>';

            $.each(res, function (index, role) {
                options += `<option value="${role.id}">${role.role_name}</option>`;
            });

            $('#role_id').html(options);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data role'
            });
        }
    });
}
</script>
@endpush