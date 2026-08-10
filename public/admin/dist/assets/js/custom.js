window.showToast = function (type, message) {
    iziToast[type]({
        title: type === 'success' ? 'Success' : 'Error',
        message: message,
        position: 'topRight',
        timeout: 3000,
        progressBar: true
    });
};

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.btn-logout', function(e) {
        e.preventDefault(); 
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Sesi Anda saat ini akan diakhiri.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777ef', 
            cancelButtonColor: '#fc544b',  
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/logout",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 'success') {
                            showToast('success', response.message); 
                            setTimeout(function() {
                                window.location.href = response.redirect;
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        showToast('error', 'Terjadi kesalahan saat logout.');
                    }
                });
            }
        });
    });
});