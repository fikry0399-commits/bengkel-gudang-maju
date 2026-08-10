@extends('admin.layouts.templates')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>Edit Data</h1>
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
                                    <img 
                                        id="imagePreview" 
                                        src="" 
                                        alt="Preview" 
                                        class="img-thumbnail mt-2"
                                        style="max-width: 200px; cursor: pointer;"
                                    >
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
        {{-- MODAL --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" class="img-fluid rounded shadow">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {

let userId = "{{ request()->route('id') }}";
$('#role_id').select2({
    placeholder: 'Silahkan Pilih Role',
    allowClear: true,
    width: '100%'
});
function loadRoles() {
    $.ajax({
        url: '/roles',
        method: 'GET',
        success: function(res) {
            let options = '<option value="">Silahkan Pilih</option>';
            $.each(res, function(i, role){
                options += `<option value="${role.id}">${role.role_name}</option>`;
            });
            $('#role_id').html(options);
        }
    });
}
loadRoles();
function loadUser(userId) {
    $.ajax({
        url: `/users/${userId}`,
        method: 'GET',
        success: function(res) {
            $('#name').val(res.name);
            $('#username').val(res.username);
            $('#email').val(res.email);
            $('#role_id').val(res.role ? res.role.id : '').trigger('change');
            $('#imagePreview').attr('src', res.image_url);

        },
        error: function(xhr) {
            showToast('error', 'Gagal mengambil data user');
            console.error(xhr.responseText);
        }
    });
}
$('#imagePreview').on('click', function () {
    let src = $(this).attr('src');

    if (!src) return;

    $('#modalImage').attr('src', src);
    $('#imageModal').modal('show');
});
 loadUser(userId);
    $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#imagePreview').attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
// UPDATE
$('#userForm').on('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append('_method','PUT');

    $.ajax({
        url: `/users/${userId}`,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
            $('#btn-save').prop('disabled', true).text('Updating...');
        },
        success: function(res){
            showToast('success', res.message);
            setTimeout(() => {
                window.location.href = `/users-edit/${userId}`
            }, 1000);
        },
        error: function(xhr){
            $('#btn-save').prop('disabled', false).text('Submit');
            if(xhr.status === 422){
                let errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value){
                    showToast('error', value[0]);
                });
            }else{
                showToast('error', 'Terjadi kesalahan pada sistem');
            }
        }
    })
})
})
</script>
@endpush