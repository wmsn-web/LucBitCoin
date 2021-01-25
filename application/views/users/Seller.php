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
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h4>Dashboard</h4>
                    <small><i class="fa fa-caret-right" aria-hidden="true"></i> Make easy money</small>
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
          <div class="col-12 col-md-12">
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Sales</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Transactions</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Upload</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Settings</a>
                  </li>
                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <table id="example1" class="tble tble-bordered">
                       <thead>
                        <tr>
                          <th>SL</th>
                          <th>Base</th>
                          <th>% Lives</th>
                          <th>% Sold</th>
                          
                        </tr>
                       </thead>
                       <tbody>
                        <?php if(!empty($getBaseData)): ?>
                          <?php $s = 1; foreach($getBaseData as $keys): $sl = $s++;
                            
                           ?>
                            <tr>
                               <td><?= $sl; ?></td>
                               <td><?= $keys['base'] ?></td>
                               <td><?= $keys['live'] ?></td>
                               <td><?= $keys['sold'] ?></td>
                               
                             </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                         
                       </tbody>
                       
                     </table>
                     <?= br(3); ?>
                     <table id="example5" class="tble tble-bordered">
                       <thead>
                        <tr>
                          <th>Date</th>
                          <th>Base</th>
                          <th>Type</th>
                          <th>Description</th>
                          <th>Buyer</th>
                          <th>Price</th>
                        </tr>
                       </thead>
                       <tbody>
                        <?php if(!empty($saleData)): ?>
                          <?php foreach($saleData as $key):
                            if($key['currency'] == "btc")
                            {
                              $icn = "<i class='fab fa-btc'></i>";
                            }
                            else
                            {
                              $icn = "<i class='fab fa-ethereum'></i>";
                            }
                           ?>
                            <tr>
                               <td><?= $key['date'] ?></td>
                               <td><?= $key['base'] ?></td>
                               <td><?= $key['type'] ?></td>
                               <td><?= $key['description'] ?></td>
                               <td><?= $key['buyer'] ?></td>
                               <td><?= $icn." ".$key['price'] ?></td>
                             </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                         
                       </tbody>
                       
                     </table>
                       
                     
                  </div>
                 
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                    <div class="col-md-12 text-center">
                      <h4>Please Contact</h4><p>ccmarker@xabber.org</p>
                    </div>
                    <!--form action="NewTests/ppost" method="post">
                     <select id="base" class="smallInput">
                       <option value="">Select Base</option>
                       <option value="New Base">New Base</option>
                       <?php if(!empty($base)): ?>
                        <<?php foreach ($base as $key => $val): ?>
                          <option value="<?= $val['basename']; ?>"><?= $val['basename']; ?></option>
                        <?php endforeach ?>
                       <?php endif; ?>
                     </select>
                     <input id="bsn" type="hidden" name="base_name"  class="smallInput" placeholder="Base Name">
                     <select id="cd" name="cd" class="smallInput">
                       <option value="">Select Type</option>
                       <option value="Card">Card</option>
                       <option value="Dump">Dump</option>
                     </select>
                     <hr>
                     <div class="format-notice">
                      <div id="cards">
                         <p>Format:<br>
                          PRICE | CCN | MONTH | YEAR| CVV | NAME | ADDRESS | CITY | STATE | ZIP | COUNTRY</p>

                          <p>Example:
                          12.50|4111222233334444|01|16|123|JOHN DOE|FAKE STREET 123 | CHICAGO | ILLINOIS | 12345 | UNITED STATES OF AMERICA</p>

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
                     <textarea id="ccno" class="form-control" rows="6" placeholder="Paste Data here using correct format" name="ccDeta"></textarea>
                     <div class="form-group"><br>
                      <button id="upl" class="btn btn-primary">Parse & Upload</button>
                    </div>
                  </form-->
                    <div class="message">
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                     <div class="row justify-content-center">
                       <div class="col-md-4">
                        <h5>- Seller withdraw addresses:</h5>
                          <form action="<?= base_url('Seller/updateWithdrawAddress'); ?>" method="post">
                            <div class="form-group">
                              <label>Bitcoin(BTC):</label>
                              <input type="text" id="wdBtc" name="withdrawBtc" class="form-control" placeholder="Bitcoin Address" value="<?= $userDatas['withdraw_btc']; ?>">
                            </div>
                            <div class="form-group">
                              <label>Ethereum(ETH):</label>
                              <input type="text" id="wdEth" name="withdrawEth" class="form-control" placeholder="Ethereum Address" value="<?= $userDatas['withdraw_eth']; ?>">
                            </div>
                            <input type="hidden" name="username" value="<?= $this->session->userdata('userName'); ?>">
                            <div class="form-group">
                              <button class="btn btn-primary">Save</button>
                              <span data-toggle="modal" data-target="#wthdrawReq" class="text-primary cp wd">Request Withdraw</span>
                            </div>
                          </form>
                       </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                    <div class="pull-right">
                      <h5>Total Earnings: <span><?= $earning['gtTrBtc']; ?></span></h5> 
                    </div>
                     <table id="example5" class="table table-bordered">
                       <thead>
                        <tr>
                          <th>Date</th>
                          <th>Narration</th>
                          <th>Debit</th>
                          <th>Credit</th>
                        </tr>
                       </thead>
                       <tbody>
                        <?php if(!empty($trData)): ?>
                          <?php foreach($trData as $key):
                            if($key['currency'] == "btc")
                            {
                              $icn = "<i class='fab fa-btc'></i>";
                            }
                            else
                            {
                              $icn = "<i class='fab fa-ethereum'></i>";
                            }
                           ?>
                            <tr>
                               <td><?= $key['date'] ?></td>
                               <td><?= $key['notes'] ?></td>
                               <td class="text-danger"><?= $icn." ".$key['debit'] ?></td>
                               <td class="text-success"><?= $icn." ".$key['credit'] ?></td>
                               
                             </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>
                         
                       </tbody> 
                       
                     </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
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
      $('#example5').DataTable({
        responsive: false,
        language: {
          searchPlaceholder: 'Search Everything Here',
          sSearch: '',
          lengthMenu: '_MENU_',
        }
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
      $("#upl").click(function(){
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
                spl = ccno.split("|");

                
                $.post("<?= base_url('Seller/parseUpload'); ?>",
                      {
                        price : spl[0],
                        ccn:  spl[1], 
                        month: spl[2],
                        year:  spl[3],
                        cvv:   spl[4],
                        name:  spl[5],
                        address:spl[6],
                        city: spl[7],
                        state:spl[8],
                        zip: spl[9],
                        country: spl[10],
                        basename: bsn,
                        cd: cd
                      },
                      
                      function(response)
                      {
                          
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
                          
                          //alert(response);
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
      $("#reqst").click(function(){
        currency = $('input[name="currency"]:checked').val();
        user = "<?= $this->session->userdata('userName'); ?>";
        rqAmt = $("#rqAmt").val();
        if(rqAmt =="")
        {
          alert("Enter Amount");
          $("#rqAmt").focus();
        }
        else
        {
          $.post("<?= base_url('Seller/SendWthdrRequest'); ?>",
              {
                currency: currency,
                user: user,
                rqAmt: rqAmt
              },
              function(data)
              {
                alert(data);
                location.href="";
              }
            )
        }
      });
      $(".wd").click(function(){
          wdEth = $("#wdEth").val();
          wdBtc = $("#wdBtc").val();
          if(wdBtc == "" | wdEth=="")
          {
            alert("Please Add Withdraw BTC & ETH Address");
            location.href="";

          }
      })
    });
  </script>
  
</body>
</html>