<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <?php include("inc/table_layout.php"); ?>
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
            <h1 class="m-0 text-dark">Bases</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li> 
              <li class="breadcrumb-item active">Bases</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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
                <table  id="example5"  class="tble tble-bordered">
                  <thead>
                    <tr>
                      <th>Base Name</th>
                      <th>Seller</th>
                      <th>Live (%)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($baseData)): ?>
                      <?php foreach($baseData as $base): ?>
                          <tr>
                              <td><?= $base['basename']; ?></td>
                              <td><?= $base['seller']; ?></td>
                              <td><input type="text" onfocus="actionFocus('pr_<?= $base['id']; ?>')" class="prcntt" id="pr_<?= $base['id']; ?>" value="<?= $base['prcnt']; ?>" />
                                <?= nbs(2); ?>
                                <!--span class="tks" onclick="doAction('tk_<?= $base['id']; ?>')" id="tk_<?= $base['id']; ?>"><i class="fa fa-check text-success cp"></i></span-->
                              </td>
                              <td><button  onclick="doAction('tk_<?= $base['id']; ?>')" class="btn btn-primary"><i class="fa fa-save"> Save</button></td>

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
  <?php if($feed = $this->session->flashdata("Feed")): ?>
    <div class="flashd"><?= $feed; ?></div>
  <?php endif; ?>
  <?php include("inc/AllModal.php"); ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $(".tks").hide();
      $('#example5').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search Everything Here',
          sSearch: '',
          lengthMenu: '_MENU_',
        }
      });

      $(".actionss").click(function(){
          ids = this.id;
          spl = ids.split("_");
          $("#UsrNm").html(spl[2]);
          $("#userId").val(spl[1]);

      });
    
    });
    function actionFocus(idname)
    {
      spl = idname.split("_");
      id = spl[1];
      $("#tk_"+id).show();
      
    }
    function doAction(idname)
    {
      spl = idname.split("_");
      id = spl[1];
      prcnt = $("#pr_"+id).val();
      $.post("<?= base_url('Admin/Bases/updtPrcnt'); ?>",
      {
        id: id,
        prcnt: prcnt
      },
      function(response)
      {
        location.href="";
      }
    
      )
    }
  </script>
</body>
</html>