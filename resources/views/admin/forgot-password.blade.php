@extends('admin.layout-auths.template-auth')
@section('content-auth')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              {{-- <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Forgot Password</h4></div>

              <div class="card-body">
                <p class="text-muted">We will send a link to reset your password</p>
                <form id="forgotPasswordForm">
                    @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>

                  <div class="form-group">
                    <button id="btnSubmit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Forgot Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Lil Tepu Development 2026
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#forgotPasswordForm').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let btn = $('#btnSubmit');
        let originalText = btn.html();
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...').prop('disabled', true);
        
        $.ajax({
            url: "{{ route('password.email') }}",
            type: "POST",
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                btn.html(originalText).prop('disabled', false);
                if(response.status) {
                    $('#email').val('');
                    showToast('success', response.message);
                }
            },
            error: function(xhr) {
                btn.html(originalText).prop('disabled', false);
                
                let res = xhr.responseJSON;
                let message = res.message || 'Terjadi kesalahan pada server.';
                if (xhr.status === 422) {
                    message = res.errors.email[0];
                }
                
                if (typeof showToast !== 'undefined') {
                    showToast('error', message);
                } else {
                showToast('message', message);
                }
            }
        });
    });
});
</script>
@endpush