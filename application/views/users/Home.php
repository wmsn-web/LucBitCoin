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
    <div class="content-headerdd">
        <div class="card">
          <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h4>Dashboard</h4>
                    <small><i class="fa fa-caret-down" aria-hidden="true"></i> Welcome back <?= $this->session->userdata("userName"); ?></small>
                </div>
                <?php include("inc/dash_head.php"); ?>
            </div>
              
          </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table id="example1" class="simpleTable">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($dashData)): ?>
                        <?php $s=1; foreach ($dashData as $key): $sl=$s++; ?>
                          <tr>

                            <td><?= $sl; ?>:<?= nbs(4); ?><span class="smlSpan"><i class="fa fa-university"></i></span><?= nbs(3); ?> <b>[<?= $key['cd']; ?>]</b><?= nbs(4); ?> Username <?= $key['user']; ?> updated  base <?= $key['base']; ?> with <?= $key['tot'] ?> cards.</td>
                            <td><?= $key['date']; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
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