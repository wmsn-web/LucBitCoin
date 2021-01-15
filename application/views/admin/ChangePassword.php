<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Change Password</title>
  <?php include("inc/layout.php"); ?>
  <body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include("inc/top_panel.php"); ?>
		<?php include("inc/side_menu.php"); ?>
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Change your password</p>
                <?php if($feed = $this->session->flashdata("Feed")): ?>
                  <small class="text-danger"><?= $feed; ?></small>
                <?php endif; ?>
                <form action="<?= base_url('Admin/ChangePassword/process'); ?>" method="post">
                  <small id="msgA" class="text-danger"></small>
                  <div class="input-group mb-3">
                    
                    <input type="text" class="form-control" name="oldPass" placeholder="Old Password" required="required" autocomplete="off" id="oldPass">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span id="icnA" class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" name="newPass" placeholder="New Password" required="required" autocomplete="off" id="newPass">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span id="icnB" class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="ConPass" placeholder="Password" required="required" id="ConPass">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span id="icnC" class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="icheck-primary">
                        <div id="loggs"></div>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <button disabled="disabled"  id="subb" class="btn btn-primary btn-block">Change Password</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                  
                  
                </div>
                <!-- /.social-auth-links -->

                
              </div>
              <!-- /.login-card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <?php if($feed = $this->session->flashdata("Feed")): ?>
      <div class="flashd"><?= $feed; ?></div>
    <?php endif; ?>
  </div>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/js.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      
      $("#oldPass").blur(function(){
        oldPass = $("#oldPass").val();
        $.post("<?= base_url('Admin/ChangePassword/CheckOld'); ?>",
            {
              oldPass: oldPass
            },
            function(datass)
            {
              if(datass == "err")
              {
                $("#msgA").html("Invalid Old Password !");
                $("#oldPass").val("");
                $("#icnA").addClass("fa-times text-danger");
                $("#icnA").removeClass("fa-lock");
                $("#icnA").removeClass("fa-check text-success");
                $("#subb").prop("disabled",true);
              }
              else
              {
                $("#msgA").html("");
                $("#icnA").addClass("fa-check text-success");
                $("#icnA").removeClass("fa-lock");
                $("#icnA").removeClass("fa-times text-danger");
                $("#subb").prop("disabled",false);
              }
            }
          )
        
      })
      $("#newPass").blur(function(){
        newPassLen = $("#newPass").val().length;
        if(newPassLen < 8)
        {
          $("#msgA").html("Password Length is minimum 8 character.");
          //$("#newPass").focus();
          $("#subb").prop("disabled",true);
          $("#icnB").addClass("fa-times text-danger");
          $("#icnB").removeClass("fa-lock");
          $("#icnB").removeClass("fa-check text-success");
        }
        else
        {
          $("#msgA").html("");
          $("#icnB").addClass("fa-check text-success");
          $("#icnB").removeClass("fa-lock");
          $("#icnB").removeClass("fa-times text-danger");
        }
      })
      $("#ConPass").keyup(function(){
        pass = $("#newPass").val();
        cnpass = $("#ConPass").val();
        newPassLen = $("#newPass").val().length;
        if(newPassLen < 8)
        {
          $("#msgA").html("Password Length is minimum 8 character.");
          $("#newPass").focus();
          $("#subb").prop("disabled",true);
          $("#icnB").addClass("fa-times text-danger");
          $("#icnB").removeClass("fa-lock");
          $("#icnB").removeClass("fa-check text-success");
        }
        else
        {
          if(cnpass == "")
          {
            $("#msgA").html("Passowrd doesn't match!");
            $("#icnC").addClass("fa-times text-danger");
            $("#icnC").removeClass("fa-lock");
            $("#icnC").removeClass("fa-check text-danger");
            $("#subb").prop("disabled",true);
          }
          else
          {
            if(cnpass == pass)
            {
              $("#msgA").html("");
              $("#icnC").addClass("fa-check text-success");
              $("#icnC").removeClass("fa-lock");
              $("#icnC").removeClass("fa-times text-danger");
              $("#subb").prop("disabled",false);
            }
            else
            {
              $("#msgA").html("Passowrd doesn't match!");
              $("#icnC").addClass("fa-times text-danger");
              $("#icnC").removeClass("fa-lock");
              $("#icnC").removeClass("fa-check text-success");
              $("#subb").prop("disabled",true);
            }
          }
        }
      });
    })
  </script>
</body>
</html>