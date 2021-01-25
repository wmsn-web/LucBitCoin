<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
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
      <p id="errMsg" class="login-box-msg text-danger"></p>
      <?php if($feed = $this->session->flashdata("Feed")): ?>
        <small class="text-danger"><?= $feed; ?></small>
      <?php endif; ?>
     
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" placeholder="Username" required="required" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div id="snup">
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="conpass" placeholder="Confirm Password" required="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="scPin" placeholder="Secure Pin" required="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-key"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="PrntrefCode" placeholder="Referral Code" required="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-award"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            
              <button type="submit" id="btSnup" class="btn btn-outline-primary btn-block">Sign Up</button>
            
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" id="btLogin" class="btn btn-outline-primary btn-block btn-login">Login</button>
          </div>
          <!-- /.col -->
        </div>
      

      <div class="social-auth-links text-center mb-3">
        <a href="<?= base_url('ForgotPass'); ?>"> Forgot Password? </a>
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
      $("#snup").hide();
      $("#btSnup").click(function(){

          user = $("#username").val();
          pass = $("#password").val();
          conpass = $("#conpass").val();
          security = $("#scPin").val();
          PrntrefCode = $("#PrntrefCode").val();
        if(user == "" || pass == "" || conpass == "" || security == "")
        {
            $("#snup").show();
            $("#btSnup").addClass("btn-signup");
            $("#btLogin").removeClass("btn-login");
        }
        else
        {
            if(pass == conpass)
            {
              $(".card").css("opacity",0.4);
              $(".lodd").show();
              $("#lodmsg").html("Please Wait...");
              
            
                $.post("<?= base_url('Login/ProcessSugnup'); ?>",
                      {
                          user: user,
                          pass: pass,
                          security: security,
                          parentCode: PrntrefCode
                      },
                      function(resposne,status)
                      {
                          if(resposne == "done")
                          {
                              $("#lodmsg").html("Successfully Signup. Please Wait...");
                              setTimeout(function () {
                                window.location.href = "<?= base_url(); ?>";
                              }, 2000);
                          }
                          else if(resposne == "inv")
                          {
                            $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Invalid Refferal Code");
                            $(".card").css("opacity",1);
                            $(".lodd").hide();
                          }
                          else
                          {
                              $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> User Already Exist!");
                              $(".card").css("opacity",1);
                              $(".lodd").hide();
                          }
                      }
                  )
                  $("#errMsg").html("");
                 
            }
            else
            {
                $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Password Doesn't Match!");
            }
        }
      });

      //Process Login
      $("#btLogin").click(function(){
          user = $("#username").val();
          pass = $("#password").val();
          conpass = $("#conpass").val();
          security = $("#scPin").val();
        if(user == "" || pass == "")
        {
            $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Invalid User!");
        }
        else
        {
            $("#errMsg").html("");
            $(".lodd").show();
            $("#lodmsg").html("Please Wait...");

            $.post("<?= base_url('Login/ProcessLogin'); ?>",
                      {
                          user: user,
                          pass: pass
                          
                      },
                      function(resposne,status)
                      {
                          if(resposne == "done")
                          {
                              $("#lodmsg").html("Successfully Loggedin. Please Wait...");
                              setTimeout(function () {
                                window.location.href = "<?= base_url(); ?>";
                              }, 2000);
                          }
                          else if(resposne == "invPs")
                          {
                              $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Invalid Password!");
                              $(".lodd").hide();
                          }
                          else
                          {
                              $("#errMsg").html("<i class='fas fa-exclamation-triangle'></i> Invalid User!");
                              $(".lodd").hide();
                          }
                      })
        }
      });

  });
</script>

</body>
</html>
