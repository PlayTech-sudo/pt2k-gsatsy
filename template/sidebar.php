<body class="sidebar-mini" cz-shortcut-listen="true">
  <div class="wrapper">          
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="assets/img/sidebar.jpg">
      <div class="logo">
        <a href="" class="simple-text logo-mini">O</a>
        <a href="index.php" class="simple-text logo-normal">Oxygas Ltd</a>
      </div>
      <div class="sidebar-wrapper"> 
        <div class="user">
          <div class="photo">
              <img src="assets/img/faces/avatar.jpg">
          </div>
          <div class="user-info">
              <a class="username">
                  <span>Administration</span>
              </a>
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item <?php if($title == 'Dashboard') echo 'active'; ?>">
            <a class="nav-link" href="index.php"><i class="material-icons">dashboard</i><p>Dashboard</p></a>
          </li>
          <?php
          $nav_admin = array("A08","A06");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#patient" aria-expanded="false">
                <i class="material-icons">content_paste</i>
                <p> In / Out <b class="caret"></b></p>
            </a>
            <div class="collapse" id="patient">
                <ul class="nav">
                  <?php
                      if(in_array('A08', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Gas Entry') echo 'active'; ?>">
                        <a class="nav-link" href="returnable.php">
                            <span class="sidebar-mini"> RE </span>
                            <span class="sidebar-normal"> Gas Entry </span>
                        </a>
                    </li>
                  <?php } ?>
                  <?php
                      if(in_array('A06', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Cylinder Status Update') echo 'active'; ?>">
                        <a class="nav-link" href="status.php">
                            <span class="sidebar-mini"> SU </span>
                            <span class="sidebar-normal"> Cylinder Status Update </span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("M01");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#manu" aria-expanded="false">
                <i class="material-icons">update</i>
                <p> Manufacturing <b class="caret"></b></p>
            </a>
            <div class="collapse" id="manu">
                <ul class="nav">
                  <?php
                      if(in_array('M01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Manufacturing') echo 'active'; ?>">
                        <a class="nav-link" href="manufacture.php">
                            <span class="sidebar-mini"> MP </span>
                            <span class="sidebar-normal"> Manufacturing </span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("S01","S02","S03","S04");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#sales" aria-expanded="false">
                <i class="material-icons">attach_money</i>
                <p> Sales <b class="caret"></b></p>
            </a>
            <div class="collapse" id="sales">
                <ul class="nav">
                  <?php
                      if(in_array('S01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Sales Invoices') echo 'active'; ?>">
                        <a class="nav-link" href="salesinvoice.php">
                            <span class="sidebar-mini"> SI </span>
                            <span class="sidebar-normal"> Sales Invoices</span>
                        </a>
                    </li>
                  <?php } ?>
                  <?php
                      if(in_array('S02', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'IN / OUT Stock status') echo 'active'; ?>">
                        <a class="nav-link" href="inout.php">
                            <span class="sidebar-mini"> IO </span>
                            <span class="sidebar-normal"> IN / OUT Stock status </span>
                        </a>
                    </li>
                  <?php } ?>
                  <?php
                      if(in_array('S03', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'POS') echo 'active'; ?>">
                        <a class="nav-link" href="pos.php">
                            <span class="sidebar-mini"> POS </span>
                            <span class="sidebar-normal"> POS</span>
                        </a>
                    </li>
                  <?php } ?>
                  <?php
                      if(in_array('S04', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Tax Management') echo 'active'; ?>">
                        <a class="nav-link" href="taxmanage.php">
                            <span class="sidebar-mini"> TM </span>
                            <span class="sidebar-normal"> Tax Management</span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("C04","C05");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#hr" aria-expanded="false">
                <i class="material-icons">face</i>
                <p> Customer <b class="caret"></b></p>
            </a>
            <div class="collapse" id="hr">
                <ul class="nav">
                  <?php
                      if(in_array('C04', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Add Customer') echo 'active'; ?>">
                        <a class="nav-link" href="addcustomer.php">
                            <span class="sidebar-mini"> AC </span>
                            <span class="sidebar-normal"> Add Customer </span>
                        </a>
                    </li>
                  <?php 
                    }
                    if(in_array('C05', $user_access)){
                   ?>
                    <li class="nav-item <?php if($title == 'Customers') echo 'active'; ?>">
                        <a class="nav-link" href="customers.php">
                            <span class="sidebar-mini"> CM </span>
                            <span class="sidebar-normal">Customer Management</span>
                        </a>
                    </li>
                  <?php } ?>
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("I01");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#IR" aria-expanded="false">
                <i class="material-icons">description</i>
                <p> iNVENTORY <b class="caret"></b></p>
            </a>
            <div class="collapse" id="IR">
                <ul class="nav">
                  <?php
                      if(in_array('I01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Inventory') echo 'active'; ?>">
                        <a class="nav-link" href="inventory.php">
                            <span class="sidebar-mini"> IR</span>
                            <span class="sidebar-normal"> Inventory </span>
                        </a>
                    </li>
                  <?php 
                    }
                    ?>
      
                </ul>
            </div>
          </li>
          <?php
          }
          $nav_admin = array("A03","C03","C06");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#report" aria-expanded="false">
                <i class="material-icons">assessment</i>
                <p> Reports <b class="caret"></b></p>
            </a>
            <div class="collapse" id="report">
                <ul class="nav">
                    <?php
                      if(in_array('A03', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Report Dashboard') echo 'active'; ?>">
                        <a class="nav-link" href="report_dash.php">
                            <span class="sidebar-mini"> DS </span>
                            <span class="sidebar-normal"> Dashboard</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('C03', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Customer Reports') echo 'active'; ?>">
                        <a class="nav-link" href="customer_reports.php">
                            <span class="sidebar-mini"> CR </span>
                            <span class="sidebar-normal"> Customer Reports</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('C06', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Cylinder Reports') echo 'active'; ?>">
                        <a class="nav-link" href="Cylinder_reports.php">
                            <span class="sidebar-mini"> CR </span>
                            <span class="sidebar-normal"> Cylinder Reports</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                </ul>
            </div>
          </li> 
          <?php
          }
          $nav_admin = array("A01","A02");
          if(array_intersect($nav_admin, $user_access)){ 
          ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" href="#admin" aria-expanded="false">
                <i class="material-icons">build</i>
                <p> Administration <b class="caret"></b></p>
            </a>
            <div class="collapse" id="admin">
                <ul class="nav">
                    <?php
                      if(in_array('A01', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Administration') echo 'active'; ?>">
                        <a class="nav-link" href="admin_panel.php">
                            <span class="sidebar-mini"> DS </span>
                            <span class="sidebar-normal"> Dashboard</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('A02', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'User Management') echo 'active'; ?>">
                        <a class="nav-link" href="user_mgnt.php">
                            <span class="sidebar-mini"> UM </span>
                            <span class="sidebar-normal"> User Management</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                    <?php
                      if(in_array('A07', $user_access)){
                    ?>
                    <li class="nav-item <?php if($title == 'Definations') echo 'active'; ?>">
                        <a class="nav-link" href="definations.php">
                            <span class="sidebar-mini"> DF </span>
                            <span class="sidebar-normal"> Definations</span>
                        </a>
                    </li>
                    <?php
                      }
                    ?>
                </ul>
            </div>
          </li> 

          <?php
          }
          ?>
        </ul>    
      </div>
      <div class="sidebar-background" style="background-image: url(assets/img/sidebar.jpg) "></div>
    </div>
      <div class="main-panel">
              <!-- NAVBAR STARTS -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top" id="navigation-example">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-minimize">
                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                  <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                  <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                </button>
              </div>
              <a class="navbar-brand" href="#"><?php echo $title; ?></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
              <form class="navbar-form">
              </form>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">notifications</i>
                    <span class="notification">5</span>
                    <p class="d-lg-none d-md-block">
                    Notifications
                    </p>
                    <div class="ripple-container"></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Notifications 1</a>
                    <a class="dropdown-item" href="#">Notifications 2</a>
                    <a class="dropdown-item" href="#">Notifications 3</a>
                    <a class="dropdown-item" href="#">Notifications 4</a>
                    <a class="dropdown-item" href="#">Notifications 5</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="functions/signout.php">
                    <i class="material-icons">power_settings_new</i>
                    <p class="d-lg-none d-md-block">
                    Logout
                    </p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- NAVBAR ENDS -->