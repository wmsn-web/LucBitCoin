<?php $uri = $this->uri->segment(2); ?>
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Admin/Dashboard'); ?>" class="brand-link">
      <img src="<?= base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('Admin/Dashboard'); ?>" class="d-block">CC Market</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Admin/Dashboard'); ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/All-users'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Users</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Products'); ?>" <?php if($uri=="Products"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Withdraw-Request'); ?>" <?php if($uri=="Withdraw-Request"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Withdraw Request
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>
          <li <?php if($uri == "Set-Rules"){ echo 'class="nav-item has-treeview menu-open"'; }else{ echo 'class="nav-item has-treeview"'; } ?>>
            <a href="#" <?php if($uri == "Set-Rules"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('Admin/Set-Rules'); ?>" <?php if($uri == "Set-Rules"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Rules</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('Admin/Other-Settings'); ?>" <?php if($uri == "Other-Settings"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
                  <i class="far fa-circle nav-icon"></i>
                  <p>Other Settings</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Admin/Admin-Wallet'); ?>" <?php if($uri=="Admin-Wallet"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Admin Wallet
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Admin/Fund-Request'); ?>"  <?php if($uri=="Fund-Request"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="fas fa-donate"></i>
              <p>
                Fund Request
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Admin/Upload-cards'); ?>"  <?php if($uri=="Upload-cards"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="fas fa-upload"></i>
              <p>
                Upload cards
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>
          
          
          
          
          
          
          
          
          
          
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>