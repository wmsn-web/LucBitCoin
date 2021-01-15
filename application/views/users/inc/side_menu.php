<?php $uri = $this->uri->segment(1); ?>
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link">
      <img src="<?= base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CC Market</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url(); ?>" class="d-block"><?= $this->session->userdata("userName"); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="<?= base_url(); ?>" <?php if($uri==""): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Rules'); ?>" <?php if($uri=="Rules"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-hammer"></i>
              <p>
                Rules
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Products/index/Card'); ?>" <?php if($uri=="Products"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-cube"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?= base_url('Orders'); ?>" <?php if($uri=="Orders"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>            
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Checker'); ?>" <?php if($uri=="Checker"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-check"></i>
              <p>
                Checker
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>            
          </li>
          
          
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Seller'); ?>"  <?php if($uri=="Seller"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="nav-icon fas fa-users"></i>
              <p>
                Seller
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('Fund-Request'); ?>"  <?php if($uri=="Fund-Request"): echo 'class="nav-link active"'; else: echo 'class="nav-link"'; endif; ?>>
              <i class="fas fa-donate"></i>
              <p>
                Fund Request
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