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
                  <table  id="example5" class="tble tble-bordered">
                    <thead>
                      <tr>
                        <th>DATE</th>
                        <th>BIN</th>
                        <th>EXP</th>
                        <th>CVV</th>
                        <th>TYPE</th>
                        <th>BANK</th>
                        <th>ADDRESS</th>
                        <th>SELLER</th>
                        <th>BASE</th>
                        <th>$</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(!empty($proData)): ?>
                        <?php $s =1; foreach($proData as $pro):  $card = strtolower($pro['brand']); $sl = $s++; ?>
                          <?php
                          
                            $endpoint = 'live';
                            $access_key = '70d19982004ef8aa2c639ae10d4c06af';
                            //$access_key = '336afadbf57caf193b6e4bb89da64dec';
                            $user = $this->session->userdata("userName");
                            $this->db->where("username",$user);
                            $row = $this->db->get("users")->row();
                            if($row->crypto_select =="BTC")
                            {
                              $icn = "<i class='fab fa-btc'></i>";
                              $json = file_get_contents('http://api.coinlayer.com/api/'.$endpoint.'?access_key='.$access_key.'');
                              $ex = json_decode($json);  
                              $bttc = $ex->rates->BTC;
                              $cryps = $pro['price'] / $bttc;
                              $cryp = number_format($cryps,8);
                            }
                            else
                            {
                              $icn = "<i class='fab fa-ethereum'></i>";
                              $json = file_get_contents('http://api.coinlayer.com/api/'.$endpoint.'?access_key='.$access_key.'');
                              $ex = json_decode($json);  
                              $etth = $ex->rates->ETH;
                              $cryps = $pro['price'] / $etth;
                              $cryp = number_format($cryps,9);
                            }
                            

                          ?>

                          <tr>
                            <td><?= $pro['date']; ?></td>
                            <td><img src="<?= base_url('assets/cards/'.$card.".png"); ?>" width="25"> 
                              <?= nbs(5); ?><?= $pro['bin']; ?></td>
                            <td><?= $pro['exp']; ?></td>
                            <td><?= $pro['cvv']; ?></td>
                            <td><?= $pro['type']; ?></td>
                            <td style="text-align: left; width: 10%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['bank']; ?></td>
                            <td style="text-align: left; width: 20%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['address']; ?></td>
                            <td><?= $pro['seller']; ?></td>
                            <td><?= $pro['base']; ?></td>
                            <td><span class="text-success"><i class="fas fa-dollar-sign"></i> <?= number_format($pro['price'],2); ?></span><br>
                              <span class="text-primary"><?= $icn; ?> <?= $cryp; ?></span>
                            </td>
                            <td style="text-align: center; width: 10%">
                              <?php if($this->session->userdata("userName")==$pro['seller']): ?>
                                <button  data-toggle="modal" data-target="#chPrice" class="btnSmall" onclick="chpricee('<?= $pro['id']; ?>_<?= $pro['price']; ?>')">Change Price</button>
                                <?php else: ?>
                                <div id="mssg_<?= $sl; ?>">
                                  <button onclick="buys('<?= $row->crypto_select; ?>_<?= $cryp; ?>_<?= $row->user_id; ?>_<?= $sl; ?>_<?= $pro['id']; ?>')" class="btnSmall">Buy Card</button>
                                </div>
                              <?php endif; ?>
                            </td>
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
  <?php include("inc/ModalSection.php"); ?>
  <?php include('inc/footer.php'); ?>
  </div>
  <?php include('inc/table_js.php'); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#example5').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search Everything Here',
          sSearch: '',
          lengthMenu: '_MENU_',
        }
      });

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
     
    });
    function buys(values)
    {
      spl = values.split("_");
      curecy = spl[0];
      price = spl[1];
      sl = spl[3];
      proId = spl[4];
      //Check Balance
      $.post("<?= base_url('Products/ChkUserbal'); ?>",
          {
            user_id: spl[2],
            price: price,
            curecy: curecy
          },function(resp)
          {
            if(resp=="no")
            {
              $("#mssg_"+sl).html("<b class='text-danger'>INSUFFICIENT BALANCE.</b>")
            }
            else
            {
              $.post("<?= base_url('Products/PurchaseCard'); ?>",
                  {
                    user_id: spl[2],
                    price: price,
                    curecy: curecy,
                    proId : proId
                  },
                  function(data)
                  {
                    if(data == "succ")
                    {
                      location.href = "";
                    }
                    else
                    {
                      $("#mssg_"+sl).html("<b class='text-danger'>Invalid Cards</b>")
                    }
                  }
                )
            }
          }
        )
    }

    function chpricee(values)
    {
      spl = values.split("_");
      cardId = spl[0];
      price = spl[1];
      $("#cardId").val(cardId);
      $("#prices").val(price);
    }
  </script>
</body>
</html>