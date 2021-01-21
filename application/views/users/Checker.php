<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CC4U</title>
  <?php include("inc/layout.php"); ?>
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
                    <h4>Checker</h4>
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
               <div class="row justify-content-left">
                <div class="col-md-10">
                  <div class="table-responsive">
                    <input type="text" maxlength="17" class="floatInput" id="ccn" placeholder="Card Number">
                      <input type="text" maxlength="2" name="" class="floatInputS" id="mnth" placeholder="Month">
                      <input type="text" maxlength="2" class="floatInputS" id="yr" placeholder="Year">
                      <input type="text" maxlength="4" class="floatInputS" id="cvv" placeholder="CVV">
                      <button id="chk" class="btnSmall">Check</button>

                  
                  </div>
                </div>
                 <?php $getSetting = $this->AdminModel->getSetting();
                 $user = $this->session->userdata("userName");
                 $this->db->where("username",$user);
                 $gtUser = $this->db->get("users")->row();
                 $cryptoSelect = $gtUser->crypto_select;
                  if($cryptoSelect=="BTC")
                    {
                      $json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
                                            $ex = json_decode($json);  
                                            $ccrr = $ex->bitcoin->usd;
                                            $icn = '<i class="fab fa-btc"></i>';
                                            $prc = number_format($getSetting['checker_price_btc'] / $ccrr,8);
                          }
                          else
                          {
                            $json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');
                                            $ex = json_decode($json);  
                                            $ccrr = $ex->ethereum->usd;
                                            $icn = '<i class="fab fa-ethereum"></i>';
                                            $prc = number_format($getSetting['checker_price_btc'] / $ccrr,9);
                          }
                  ?>
                  <div class="form-group col-sm-12">
                    <b>Price: <?= $icn; ?> <span id=""><?= $prc; ?></span>
                      <img id="ldr" src="<?= base_url('assets/load.gif'); ?>" width="65">
                    <div id="result"></div>
                  </div>
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
  <?php include('inc/js.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#ldr").hide();
    })
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
      $("#chk").click(function(){
        $("#ldr").show();
        ccn = $("#ccn").val();
        mnth = $("#mnth").val();
        yr = $("#yr").val();
        cvv = $("#cvv").val();
        user = "<?= $this->session->userdata('userName'); ?>";

        if(ccn =="" || mnth =="" || yr =="" || cvv =="" )
        {
          $("#result").html("<b class='text-danger'>Invalid Input!</b>");
          $("#ldr").hide();
        }
        else
        {
          $.post("<?= base_url('Checker/CheckCard'); ?>", 
              {
                user: user,
                ccn: ccn,
                month: mnth,
                year: yr,
                cvv: cvv
              },
              function(response)
              {
                $("#result").html(response);
                $("#ldr").hide();
              }
            )
          
        }
      })
</script>
</body>
</html>