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
                  <label>checking mode :</label>
                  <select id="sqMode" class="smallInput">
                    <option value="">Select</option>
                    <option value="no">None</option>
                    <option value="auto">Buy with checker</option>
                  </select><br>
                  <input type="hidden" id="chkprc" >
                  <span id="checkerMsg" class="text-danger"></span>
                  <table  id="example5" class="tble tble-bordered">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>DATE</th>
                        <th>BIN</th>
                        <th>EXP</th>
                        <th>CVV</th>
                        <th>TYPE</th>
                        <th>BANK</th>
                        <th>ADDRESS</th>
                        <th>SELLER</th>
                        <th>BASE</th>
                        <th>Live %</th>
                        <th>$</th>
                        <th>Action</th> 
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      if(!empty($proData)): ?>
                        <?php $s =1; foreach($proData as $pro):  $card = strtolower($pro['brand']); $sl = $s++; ?>
                          <?php
                          $cryp = "";
                          $icn = "";
                          /*
                          $getSetting = $this->AdminModel->getSetting();
                          
                            $endpoint = 'live';
                            $access_key = '70d19982004ef8aa2c639ae10d4c06af';
                            //$access_key = '336afadbf57caf193b6e4bb89da64dec';
                            $user = $this->session->userdata("userName");
                            $this->db->where("username",$user);
                            $row = $this->db->get("users")->row();
                            if($row->crypto_select =="BTC")
                            {
                              $icn = "<i class='fab fa-btc'></i>";
                              
                              $json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
                              $ex = json_decode($json);  
                              $ccrr = $ex->bitcoin->usd;
                              
                              $cryps = $pro['price'] / $ccrr;
                              $cryp = number_format($cryps,8);
                            }
                            else
                            {
                              $icn = "<i class='fab fa-ethereum'></i>"; 
                              
                              $json = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');
                              $ex = json_decode($json);  
                              $ccrr = $ex->ethereum->usd;
                              
                              $cryps = $pro['price'] / $ccrr;
                              $cryp = number_format($cryps,9);

                            }
                            */
                            if($pro['cvv']=="")
                            {
                              $cvvs = "<i class='fas fa-close text-danger'></i>";
                            }
                            else
                            {
                              $cvvs = "<i class='fas fa-check text-success'></i>";
                            }

                          ?>

                          <tr>
                            <td><?= $sl; ?></td>
                            <td><?= $pro['date']; ?></td>
                            <td><img src="<?= base_url('assets/cards/'.$card.".png"); ?>" width="25"> 
                              <?= nbs(5); ?><?= $pro['bin']; ?></td>
                            <td><?= $pro['exp']; ?></td>
                            <td><?= $cvvs; ?></td>
                            <td><?= $pro['type']; ?></td>
                            <td style="text-align: left; width: 10%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['bank']; ?></td>
                            <td style="text-align: left; width: 20%"><span class="flag-icon flag-icon-<?= $pro['cntr_cd']; ?>"></span> <?= $pro['address']; ?></td>
                            <td><?= $pro['seller']; ?></td>
                            <td><?= $pro['base']; ?></td>
                            <td><?= $pro['lives']; ?></td>
                            <td><span class="text-success"><i class="fas fa-dollar-sign"></i> <?= number_format($pro['price'],2); ?></span><br>
                              <span class="text-primary"><?= $icn; ?> <?= $cryp; ?></span>
                            </td>
                            <td style="text-align: center; width: 10%">
                              <?php if($this->session->userdata("userName")==$pro['seller']): ?>
                                <button  data-toggle="modal" data-target="#chPrice" class="btnSmall" onclick="chpricee('<?= $pro['id']; ?>_<?= $pro['price']; ?>')">Change Price</button>
                                <?php else: ?>
                                <div id="mssg_<?= $sl; ?>">
                                  <!--button onclick="buys('<?= $row->crypto_select; ?>_<?= $cryp; ?>_<?= $row->user_id; ?>_<?= $sl; ?>_<?= $pro['id']; ?>')" class="btnSmall">Buy Card</button-->
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
     $("#sqMode").change(function(){
      var user = "<?= $this->session->userdata('userName'); ?>";
        var chkMode = $("#sqMode").val();
        if(chkMode == "auto")
        {
          $.post("<?= base_url('Products/ChkerPrice'); ?>",
          {
            chkMode: chkMode,
            userName: user
          },function(resp)
          {
            obj = JSON.parse(resp)
            $("#checkerMsg").html(obj.mssg);
            $("#chkprc").val(obj.chkPrc);
          }
          )
        }
        else
        {
          $("#chkprc").val("0");
        }
     });
    });
    function buys(values)
    {
      if (!confirm('Are you sure? Proceed to buy?')) return false;
      spl = values.split("_");
      curecy = spl[0];
      price = spl[1];
      sl = spl[3];
      proId = spl[4];
      var chkprc =  $("#chkprc").val();
      var totPrice = (+chkprc + +price);
      var chkMode = $("#sqMode").val();
      
      
      //Check Balance
      $("#mssg_"+sl).html("<b class='text-danger'>Please Wait..</b>");

      $.post("<?= base_url('Products/ChkUserbal'); ?>",
          {
            user_id: spl[2],
            price: totPrice,
            curecy: curecy
          },function(resp)
          {
            if(resp=="no")
            {
              $("#mssg_"+sl).html("<b class='text-danger'>INSUFFICIENT BALANCE.</b>")
            }
            else
            {
              if(chkMode == "auto")
              {
                var appl = applyChecker(proId);
                
                
                $.post("<?= base_url('Products/ApplyChecker'); ?>",
                  {proId: proId},
                   function(responses)
                   {
                    if(responses=="Live")
                    { 
                        $.post("<?= base_url('Products/PurchaseCard'); ?>", 
                        {
                          user_id: spl[2],
                          price: totPrice,
                          curecy: curecy,
                          proId : proId
                        },
                        function(data)
                        {
                          if(data == "succ")
                          {
                            alert("You have successfully bought this card. get your card details in order Section");
                            location.href = "";
                          }
                          else
                          {
                            $("#mssg_"+sl).html("<b class='text-danger'>Invalid Cards</b>")
                          }
                        }
                      )
                        
                    }
                    else
                    {
                      $("#mssg_"+sl).html("<b class='text-danger'>"+responses+"</b>")
                    }
                   }
                   )
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
                      alert("You have successfully bought this card. get your card details in order Section");
                      location.href = "";
                    }
                    else
                    {
                      $("#mssg_"+sl).html("<b class='text-danger'>Invalid Cards</b>")
                    }
                  }
                )
              }
              /*
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
                      alert("You have successfully bought this card. get your card details in order Section");
                      location.href = "";
                    }
                    else
                    {
                      $("#mssg_"+sl).html("<b class='text-danger'>Invalid Cards</b>")
                    }
                  }
                )

                */

            }
          }
        )
        
    }

    function applyChecker(proId)
    {
      return 15;
      /*
      $.post("<?= base_url('Products/ApplyChecker'); ?>",
        {proId: proId},
         function(responses)
         {
          return 15;
        }
         )
         */
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