
@extends('admin.layout-auths.template-auth')
@section('content-auth')
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form id="formRegister">
                  @csrf
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Name</label>
                      <input id="name" type="text" class="form-control" name="name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="username">username</label>
                      <input id="username" type="text" class="form-control" name="username">
                    </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-12">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email">
                        <div class="invalid-feedback">
                        </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control" name="password" tabindex="2" required style="padding-right: 40px;">
                      <span id="toggle-password" style="position: absolute; right: 30px; top: 70%; transform: translateY(-50%); cursor: pointer; color: #a1a8ae; z-index: 10;">
                        <i class="fas fa-eye" id="eye-icon"></i>
                      </span>
                    </div>
                    <div class="form-group col-6">
                      <label for="password_confirmation" class="d-block">Password Confirmation</label>
                      <div class="position-relative">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" tabindex="2" required style="padding-right: 40px;">
                        <span id="toggle-password-2" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #a1a8ae; z-index: 10;">
                          <i class="fas fa-eye" id="eye-icon-2"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" id="btn-save" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Have a acount? <a href="/login">Login</a>
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
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
$('#formRegister').on('submit', function(e) {
  e.preventDefault();
  if (!$('#agree').is(':checked')) {
          showToast('error', 'Anda harus menyetujui syarat dan ketentuan.');
          return false;
      }
    let form = $(this);
    let btnSubmit = $('#btn-save');
    let originalBtnText = btnSubmit.html();
    btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Loading...');
    $.ajax({
        url: "/register-proses",
        type: "POST",
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            if(response.status === 'success') {
                showToast('success', response.message);
                setTimeout(function() {
                    window.location.href = response.redirect;
                }, 1500); 
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
$('#toggle-password-2').on('click', function() {
    let passwordInput = $('#password_confirmation');
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
})
</script>
@endpush