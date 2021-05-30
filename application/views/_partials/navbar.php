  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Notifications: style can be found in dropdown.less -->
        <!-- <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li> -->
              <!-- inner menu: contains the actual data -->
              <!-- <ul class="menu">
                <li>
                  <a href="javascript:void(0)">
                    <i class="fa fa-recycle text-aqua"></i> 5 new members joined today
                  </a>
                </li>
              </ul> -->
            <!-- </li> -->
            <!-- <li class="footer"><a href="#">View all</a></li> -->
          <!-- </ul>
        </li> -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo site_url('assets/adminlte/dist/img/avatar5.png') ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $this->session->userdata('login_session')['user_name'] ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <p>
                Username : <?php echo $this->session->userdata('login_session')['user_name'] ?>
              </p>
              <p>
                Branch : <?php echo $this->session->userdata('login_session')['branch_name'] ?>
              </p>
              <p>
                Divisi : <?php echo $this->session->userdata('login_session')['division_name'] ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="<?= base_url('auth/logout'); ?>" class="btn btn-default btn-flat">Logout</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
  </nav>