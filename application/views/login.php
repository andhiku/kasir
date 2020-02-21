<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <?php $this->load->view('partials/head'); ?>
</head>
<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">Login</div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Login untuk masuk</p>
        <div class="alert alert-danger d-none"></div>
        <form>
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button class="btn btn-block btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $this->load->view('partials/footer'); ?>
<script src="<?php echo base_url('assets/vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script>
  $('form').validate({
    errorElement: 'span',
    errorPlacement: (error, element) => {
      error.addClass('invalid-feedback')
      element.closest('.input-group').append(error)
    },
    submitHandler: () => {
      $.ajax({
        url: '<?php echo site_url('login') ?>',
        type: 'post',
        dataType: 'json',
        data: $('form').serialize(),
        success: res => {
          if (res == 'tidakada') {
            $('.alert').html('Username tidak terdaftar')
            $('.alert').removeClass('d-none')
          } else if (res == 'passwordsalah') {
            $('.alert').html('Password Salah')
            $('.alert').removeClass('d-none')
          } else {
            $('.alert').html('Sukses')
            $('.alert').addClass('alert-success')
            $('.alert').removeClass('d-none alert-danger')
            setTimeout(function() {
              window.location.reload()
            }, 1000);
          }
        },
        error: err => {
          console.log(err);
        }
      })
    }
  })
</script>
</body>
</html>
