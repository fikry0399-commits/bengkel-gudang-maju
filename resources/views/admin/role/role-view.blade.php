@extends('admin.layouts.templates')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>Role Management</h1>
          </div>
          <div class="row">
             
          </div>
        </section>
        <div class="section-body">
            
            <div class="table table-responsive">
                <table class="table table-bordered table-responsive" id="roleTable">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Role Name</th>
                            <th>Description</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>

        </div>
<!-- MODAL -->
 <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="roleForm">
        @csrf
        <input type="hidden" name="id" id="role_id">
          <div class="modal-body">
            <div class="row">
                <div class="col">
                    <label for="role_name">Name</label>
                    <input type="text" class="form-control" id="role_name">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="description">Description</label>
                    <textarea class="summernote-simple" id="description"></textarea>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function () {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
           $('#roleTable').DataTable({
            ajax: {
            url: '/roles',
            dataSrc: function (data) {
                return data;
                }
            },
            columns: [
            { data: null,
                render : function (data, type, row, meta){
                    return meta.row + 1
                }
            },
            {
                data: 'role_name'
            },
            {
                data: 'description'
            },
            
            ]
        })

$('#roleModal').on('hidden.bs.modal', function () {
    $('#roleForm')[0].reset()
    $('#role_id').val('')
    $('#description').summernote('code', '')
    $('.modal-title').text('Add Data')
})
$('#roleForm').on('submit', function (e) {
    e.preventDefault()
    let id = $('#role_id').val();
    let url = id 
        ? "{{ route('roles.update') }}" 
        : "{{ route('roles.store') }}";
    $.ajax({
        url : url,
        method : 'POST',
       data : {
            id: id,
            role_name: $('#role_name').val(),
            description: $('#description').summernote('code'),
        },
        beforeSend: function(){
            $('.error-text').text('')
            $('#btn-save').prop('disabled', true).text('Saving...')
        },
        success: function (res) {
            showToast('success', id ? 'Role berhasil diupdate' : 'Role berhasil ditambahkan');
            $('#roleModal').modal('hide');
            $('#roleTable').DataTable().ajax.reload(null, false);
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
        },
        complete: function () {
            $('#btn-save').prop('disabled', false).text('Save changes')
        }
    })
 })

// EDIT DATA
$(document).on('click', '.btn-edit', function () {
    let id = $(this).data('id')
    $.ajax({
        url: `/roles/${id}`,
        method: 'GET',
        success: function (res) {
            $('#role_id').val(res.id)
            $('#role_name').val(res.role_name)
            $('#description').summernote('code', res.description)
            $('.modal-title').text('Edit Data')
        }
    })
})

// DELETE
      $(document).on('click', '.btn-delete', function () {
            const roleId = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                 if (result.isConfirmed) {
                     $.ajax({
                         url: `/roles/${roleId}`,
                         type: 'DELETE',
                         success: function (response) {
                             showToast('success', 'Role berhasil dihapus');
                             $('#roleTable').DataTable().ajax.reload();
                         },
                         error: function (xhr) {
                            showToast('success', 'Role berhasil dihapus');
                            console.error(xhr.responseText);
                            }
                     })
                 }
            })
        });
})
</script>
@endpush