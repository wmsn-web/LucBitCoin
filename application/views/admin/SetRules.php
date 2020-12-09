<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
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
            <h1 class="m-0 text-dark">Set Rules</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Set Rules</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Set Site Ruls</h3>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('Admin/Set-Rules/setRules'); ?>" method="post">
                      <div class="form-group">
                        <label>Add Rule</label> 
                        <input type="text" name="rules" class="form-control" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary"><i class='fa fa-save'></i> Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Ruls</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Rules</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($rules)): ?>
                          <?php $s = 1;  foreach($rules as $rule): $sl = $s++; ?>
                            <tr>
                              <td><?= $sl; ?></td>
                              <td><?= htmlspecialchars_decode($rule['descr']); ?></td>
                              <td><a onclick="return confirm('Delete this Rule?')" class="text-danger" href="<?= base_url('Admin/Set-Rules/delRule/'.$rule['id']); ?>">Delete</a></td>
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
        <!-- /.row -->
        <!-- Main row -->
        <?php if($feed = $this->session->flashdata("Feed")): ?>
          <div class="flashd"><?= $feed; ?></div>
        <?php endif; ?>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/js.php'); ?>
</body>
</html>