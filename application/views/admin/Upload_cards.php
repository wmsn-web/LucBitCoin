<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Upload Cards</title>
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
            <h1 class="m-0 text-dark">Upload Cards</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upload Cards </li> 
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
                <form action="<?= base_url('Admin/NewTests/ppost'); ?>" method="post">
                  <select id="crdSeller" name="seller" class="smallInput">
                    <option value="">Select Seller</option>
                    <?php if(!empty($userData)): ?>
                      <?php foreach($userData as $usr): ?>
                        <option><?= $usr['username']; ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                     <select id="base" class="smallInput" required>
                       <option value="">Select Base</option>
                       <option value="New Base">New Base</option>
                       <?php if(!empty($base)): ?>
                        <<?php foreach ($base as $key => $val): ?>
                          <option value="<?= $val['basename']; ?>"><?= $val['basename']; ?></option>
                        <?php endforeach ?>
                       <?php endif; ?>
                     </select>
                     <input id="bsn" type="hidden" name="base_name"  class="smallInput" placeholder="Base Name" required>
                     <select id="cd" name="cd" class="smallInput" required>
                       <option value="">Select Type</option>
                       <option value="Card">Card</option>
                       <option value="Dump">Dump</option>
                     </select>
                     <hr>
                     <div class="format-notice">
                      <div id="cards">
                         <p>Format:<br>
                          PRICE | CCN | MONTH | YEAR| CVV | NAME | ADDRESS | CITY | STATE | ZIP | COUNTRY | MOBILE | EMAIL</p>

                          <p>Example:
                          12.50|4111222233334444|01|2016|123|JOHN DOE|FAKE STREET 123 | CHICAGO | ILLINOIS | 12345 | UNITED STATES OF AMERICA |2505550199|john@gmail.com</p>

                          <span>ATTENTION: CURRENT SHOP FEE IS AT 30%</span>
                        </div>
                        <div id="dumps">
                         <p>Format:<br>
                          PRICE|TRACK1|TRACK2</p>

                          <p>Example:
                          18.50|4111222233334444^JHON/DOE^160110100000000000|4111222233334444=160110100000000000</p>
                          <span>ATTENTION: CURRENT SHOP FEE IS AT 30%</span>

                        </div>
                     </div>
                     <textarea id="ccno" style="font-size: 13px" class="form-control" rows="8" placeholder="Paste Data here using correct format" name="ccDeta" required></textarea>
                     <div class="form-group"><br>
                      
                      <button id="upl" class="btn btn-primary">Parse & Upload</button>
                    </div>
                  </form>
                  <?php if($newFeedupl = $this->session->flashdata("newFeedupl")): ?>
                    <div class="message message-success">
                      <?php foreach ($newFeedupl as $upll) { echo $upll; }?>
                    </div>
                  <?php endif; ?>
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
    $(document).ready(function(){

      $("#crdSeller").change(function(){
        seller = $("#crdSeller").val();
          $.post("<?= base_url('Admin/Upload_cards/getSellerbase'); ?>",
              {seller: seller},
              function(response)
              {
                $("#base").html(response);
              }

          )
      });

      $("#base").change(function(){
        basename = $("#base").val();
        if(basename=="New Base")
        {
          $("#bsn").attr({type:"text"});
          $("#bsn").focus();
          $("#bsn").val("");
        }
        else if(basename=="")
        {
          $("#bsn").attr("type","hidden");
          $("#bsn").val("");
        }
        else
        {
          $("#bsn").attr({type:"text",reaonly:true,});
          $("#bsn").val(basename);
        }
      });
      $("#cd").change(function(){
        cd = $("#cd").val();
        if(cd=="Card")
        {
          $(".format-notice").show();
          $("#cards").show();
          $("#dumps").hide();
          $(".message").removeClass("message-danger");
            $(".message").html("");
        }
        else if(cd=="Dump")
        {
          $(".format-notice").show();
          $("#dumps").show();
          $("#cards").hide();
          $(".message").removeClass("message-danger");
            $(".message").html("");
        }
        else
        {
          $(".format-notice").hide();
          $("#dumps").hide();
          $("#cards").hide();
        }
      });
      $("#upldd").click(function(){
        bsn = $("#bsn").val();
        cd = $("#cd").val();
        ccno = $("#ccno").val();

        if(cd=="Card")
        {
          if(bsn == "")
          {
            $(".message").removeClass("message-success");
            $(".message").addClass("message-danger");
            $(".message").html("<b>Error:</b> Please Select a base name");
          }
          else
          {
            $(".message").removeClass("message-success");
            $(".message").removeClass("message-danger");
            $(".message").html("");
            if(cd == "")
            {
              $(".message").removeClass("message-success");
              $(".message").addClass("message-danger");
              $(".message").html("<b>Error:</b> Please Select Card or Dump");
            }
            else
            {
              $(".message").removeClass("message-success");
              $(".message").removeClass("message-danger");
              $(".message").html("");
              if(ccno == "")
              {
                $(".message").removeClass("message-success");
                $(".message").addClass("message-danger");
                $(".message").html("<b>Error:</b> Invalid Format");
              }
              else
              {
                $(".message").removeClass("message-success");
                $(".message").removeClass("message-danger");
                $(".message").html("");


                //spl = ccno.split("|");

                
                $.post("<?= base_url('NewTests/ppost'); ?>",
                      {
                        ccno: ccno,
                        base_name: bsn,
                        cd: cd
                      },
                      
                      function(response)
                      {

                        //alert(response);
                          /*
                          respns = JSON.parse(response);
                          if(respns.msg == "error")
                          {
                            $(".message").addClass("message-danger");
                            $(".message").html(respns.note);
                          }
                          else
                          {
                            $(".message").removeClass("message-danger");
                            $(".message").addClass("message-success");
                            $(".message").html(respns.note);
                          } 
                          */
                          alert(response);
                          
                      }
                  )


              }
            } 
          }
        }
        else
        {
          //alert("dump")
        }

      });
    })
  </script>
</body>
</html>