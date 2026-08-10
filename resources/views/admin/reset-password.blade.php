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
              <div class="card-header"><h4>Reset Password</h4></div>

              <div class="card-body">
                <p class="text-muted">We will send a link to reset your password</p>
                <form id="resetPasswordForm">
                    @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="input-group"> <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                      <div class="input-group-append">
                        <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                          <i class="fas fa-eye" id="eye-icon"></i>
                        </span>
                      </div>
                    </div>
                    <div id="pwindicator" class="pwindicator">
                      <div class="bar"></div>
                      <div class="label"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <div class="input-group"> <input id="password-confirm" type="password" class="form-control" name="password_confirmation" tabindex="3" required>
                      <div class="input-group-append">
                        <span class="input-group-text" id="toggle-password-2" style="cursor: pointer;">
                          <i class="fas fa-eye" id="eye-icon-2"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button id="btnSubmit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Reset Password
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
    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault();
        
        let form = $(this);
        let btn = $('#btnSubmit');
        let originalText = btn.html();
        
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...').prop('disabled', true);
        
        $.ajax({
            url: "{{ route('password.update') }}",
            type: "POST",
            data: form.serialize(),
            success: function(response) {
                btn.html(originalText).prop('disabled', false);
                
                if(response.status) {
                    if (typeof showToast !== 'undefined') {
                        showToast('success', response.message);
                    }
                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                }
            },
            error: function(xhr) {
                btn.html(originalText).prop('disabled', false);
                
                let res = xhr.responseJSON;
                let message = res.message || 'Terjadi kesalahan pada server.';
                if (xhr.status === 422) {
                    let firstError = Object.values(res.errors)[0][0];
                    message = firstError;
                }
                
                if (typeof showToast !== 'undefined') {
                    showToast('error', message);
                } else {
                    showToast('error', 'error in system');
                }
            }
        });
    });

$('#toggle-password').on('click', function() {
        let passwordInput = $('#password');
        let eyeIcon = $('#eye-icon');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } 
        else {
            passwordInput.attr('type', 'password');
            eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    $('#toggle-password-2').on('click', function() {
        let passwordInput = $('#password-confirm');
        let eyeIcon = $('#eye-icon-2');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } 
        else {
            passwordInput.attr('type', 'password');
            eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
</script>
@endpush