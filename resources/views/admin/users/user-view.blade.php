@extends('admin.layouts.templates')
@section('content')
        <section class="section">
          <div class="section-header">
            <h1>User Management</h1>
          </div>
          <div class="row">
             
          </div>
        </section>
        <div class="section-body">
            
            <div class="table table-responsive">
                <table class="table table-bordered table-responsive" id="userTable">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
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
           $('#userTable').DataTable({
            ajax: {
            url: '/users',
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
                data: 'name'
            },
            {
                data: 'username'
            },
            {
                data : 'role',
                render: function (data, type, row) {
                    return data ? data.role_name : '-';
                }
            },
            
            ]
        })
// DELETE
      $(document).on('click', '.btn-delete', function () {
            const userId = $(this).data('id');
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
                         url: `/users/${userId}`,
                         type: 'DELETE',
                         success: function (response) {
                             showToast('success', 'User berhasil dihapus');
                             $('#userTable').DataTable().ajax.reload();
                         },
                         error: function (xhr) {
                            showToast('error', 'User gagal dihapus');
                            console.error(xhr.responseText);
                            }
                     })
                 }
            })
        });
})
</script>
@endpush