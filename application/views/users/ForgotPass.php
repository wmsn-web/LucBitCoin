<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forgot Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>dist/css/custom.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>CC Market</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <h5>Fogot Password</h5>
      <p id="errMsg" class="login-box-msg text-danger"></p>
      <?php if($feed = $this->session->flashdata("Feed")): ?>
        <small class="text-danger"><?= $feed; ?></small>
      <?php endif; ?>
     <div id="forg">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" placeholder="Username" required="required" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pin" placeholder="Secure Pin" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-6">
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="button" id="submt"  class="btn btn-outline-primary btn-block btn-login">Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <div id="reset">
        <p class="text-danger">Reset Password</p>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="pass" placeholder="New Passowrd" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="conpass" placeholder="Confirm Passowrd" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="button" id="chng"  class="btn btn-outline-primary btn-block btn-login">Change Password</button>
          </div>
          <!-- /.col -->
        </div>
      </div>
      </div>
      

      <div class="social-auth-links text-center mb-3">
        
      </div>
      <!-- /.social-auth-links -->

      
    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="lodd"><i class="fas fa-crosshairs fa-spin"></i>
    <p id="lodmsg"></p>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      $("#reset").hide();
      $("#chng").click(function(){
        user = $("#username").val();
          pin = $("#pin").val();
          pass = $("#pass").val();
          conpass = $("#conpass").val()
          if(pass =="" || conpass =="")
          {
            $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Password does not match!");
          }
          else
          {
            if(pass == conpass)
            {
              //proceed
              $("#errMsg").html("");
              $.post("<?= base_url('ForgotPass/ProcessReset'); ?>",
                      {
                          user: user,
                          pin: pin,
                          pass: pass
                          
                      },
                      function(data)
                      {
                        if(data == "ok")
                        {
                          $("#errMsg").html("<i class='fas fa-check'></i> Password reset done");
                        }
                        else
                        {
                          $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Please try again");
                        }
                      }
                      )
            }
            else
            {
              $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Password does not match!");
            }
          }
      })

      //Process Login
      $("#submt").click(function(){
          user = $("#username").val();
          pin = $("#pin").val();
          
        if(user == "" || pin == "")
        {
            $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Invalid User!");
        }
        else
        {
            $("#errMsg").html("");
            $(".lodd").show();
            $("#lodmsg").html("Please Wait...");

            $.post("<?= base_url('ForgotPass/ProcessForgot'); ?>",
                      {
                          user: user,
                          pin: pin
                          
                      },
                      function(resposne,status)
                      {
                          if(resposne == "ok")
                          {
                              $(".lodd").hide();
                              $("#forg").hide();
                              $("#reset").show();
                          }
                          
                          else
                          {
                              $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Invalid User or Security PIN!");
                              $(".lodd").hide();
                              $("#forg").show();
                              $("#reset").hide();

                          }
                      })
        }
      });

  });
</script>

</body>
</html>
