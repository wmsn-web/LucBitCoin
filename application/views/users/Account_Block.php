<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CC4U</title>
  <?php include("inc/table_layout.php"); ?>
  <body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include("inc/top_panel.php"); ?>
		<?php include("inc/side_menu.php"); ?>
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-4">
            <?= br(3); ?>
            <div class="card">
              <div class="card-body">
                <div class="text-danger text-center">
                  <h3><i class="fa fa-lock"></i> Your Account is locked</h3>
                  <p>Please contact us at  <a href="mailto:ccmarket@xabber.org">ccmarket@xabber.org</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
  <script type="text/javascript">
   $("#slctEth").click(function(){
        user = "<?= $this->session->userdata('userName'); ?>";
        $.post("<?= base_url('Products/ChangetoEth'); ?>",
            {
              user: user
            },
            function(response)
            {
              location.href="";
            }
          )
      });
      $("#slctBtc").click(function(){
        user = "<?= $this->session->userdata('userName'); ?>";
        $.post("<?= base_url('Products/ChangetoBtc'); ?>",
            {
              user: user
            },
            function(response)
            {
              location.href="";
            }
          )
      });
</script>
</body>
</html>