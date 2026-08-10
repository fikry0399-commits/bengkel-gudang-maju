@extends('admin.layout-auths.template-auth')
@section('content-auth')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 bg-soft-white">
            <div class="login-brand">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
                <form id="form-login" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your username
                    </div>
                  </div>

                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                    <div class="float-right">
                      <a href="/forgot-password" class="text-small">
                        Forgot Password?
                      </a>
                    </div>
                  </div>
                  
                  <div class="position-relative">
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required style="padding-right: 40px;">
                    
                    <span id="toggle-password" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a1a8ae; z-index: 10;">
                      <i class="fas fa-eye" id="eye-icon"></i>
                    </span>
                  </div>

                  <div class="invalid-feedback">
                    please fill in your password
                  </div>
                </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="/register">Register</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; TI 2026
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    @if(session('success'))
        showToast('success', '{{ session('success') }}');
    @endif

    @if(session('error'))
        showToast('error', '{{ session('error') }}');
    @endif
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('#form-login').on('submit', function(e) {
    e.preventDefault();
        let form = $(this);
        let btnSubmit = $('#btn-login');
        let originalBtnText = btnSubmit.html();
        btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
        $.ajax({
            url: "{{ route('login.proses') }}",
            type: "POST",
            data: form.serialize(),
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
                btnSubmit.prop('disabled', false).html(originalBtnText);
                let res = xhr.responseJSON;
                
                  if (xhr.status === 422) {
                      let errors = res.errors;
                      $.each(errors, function (key, value) {
                          showToast('error', value[0]);
                      });
                  } else if (xhr.status === 401 || xhr.status === 403) {
                      showToast('error', res.message);
                  } else {
                      showToast('error', 'Terjadi kesalahan pada sistem');
                  }
              }
        })
  })
  // PASSWORD
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
})
</script>   
@endpush