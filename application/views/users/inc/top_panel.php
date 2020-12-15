<?php
  $getSetting = $this->AdminModel->getSetting();
  $username = $this->session->userdata("userName"); 
  $this->db->where("username",$username);
  $gtU = $this->db->get("users")->row();
  $this->db->where("user_id",$gtU->user_id);
        $gtWllet = $this->db->get("user_wallet");
        if($gtWllet->num_rows()==0)
        {
          $btc = "0.0000";
          $eth = "0.0000";
        }
        else
        {
          $row = $gtWllet->row();
          $btcs = $row->btc;
          $eths = $row->eth;
          if($btcs==null)
          {
            $btc = "0.0000";
          }
          else
          {
            $btc = $btcs;
          }
          if($eths==null)
          {
            $eth = "0.0000";
          }
          else
          {
            $eth = $eths;
          }
        }

        $json1 = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');
                              $ex1 = json_decode($json1);  
                              $ccrr1 = $ex1->bitcoin->usd;
        $json2 = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=usd');
                              $ex2 = json_decode($json2);  
                              $ccrr2 = $ex2->ethereum->usd;
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url("Admin/Dashboard"); ?>" class="nav-link"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <span class="sp1"><b>BTC/USD:</b> <?= number_format($ccrr1,2); ?> </span><?= nbs(8); ?>
      <span class="sp2"><b>ETH/USD:</b> <?= number_format($ccrr2,2); ?> </span>

    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" id="addrDivv" href="#">
           <i class="fas fa-dollar-sign"></i>
        </a>
        <div class="sqBox"></div>
        <div class="addrDiv">
            <label>Bitcoin(BTC) deposit address:</label>
            <span class="">1B8PC8hD1zj8Fx3y4WHErDZYNZaCkRcdFd</span>
            <label>Ethereum(ETH) deposit address:</label>
            <span class="">1B8PC8hD1zj8Fx3y4WHErDZYNZaCkRcdFd</span>
          </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"><?= $this->session->userdata("userName"); ?>
           <i class="far fa-user"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?= $this->session->userdata("userName"); ?></span>
          <div class="dropdown-divider"></div>
          
          
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('Home/Logout'); ?>" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i>Logout
            
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer"></a>
        </div>
      </li>
      
    </ul>
  </nav>