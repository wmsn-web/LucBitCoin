<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
  getNoticeRequest();
  getNoticeWd();
  function getNoticeRequest()
  {
    setInterval(function(){
      $.post("<?= base_url('Admin/Dashboard/getNotice'); ?>",
      {
        gtNtc: "gtNtc"
      },
      function(data)
      {
        //alert(data);
        if(data=="0")
        {
          $("#rqNotice").html("");
          $("#rqNotice").removeClass("badge badge-danger");
        }
        else
        {
          $("#rqNotice").html(data);
          $("#rqNotice").addClass("badge badge-danger");
        }
      }
      )
      
    }, 1000);
  }

  function getNoticeWd()
  {
    setInterval(function(){
      $.post("<?= base_url('Admin/Dashboard/getWdNotice'); ?>",
      {
        gtNtc: "gtNtc"
      },
      function(data)
      {
        //alert(data);
        if(data=="0")
        {
          $("#wdNotice").html("");
          $("#wdNotice").removeClass("badge badge-danger");
        }
        else
        {
          $("#wdNotice").html(data);
          $("#wdNotice").addClass("badge badge-danger");
        }
      }
      )
      
    }, 1000);
  }
</script>