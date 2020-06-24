<?php
error_reporting(0);
include 'includes/connect.php';
?>
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>Shot</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>POS</b>Shot</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <?php 
          $q = mysql_query("SELECT * FROM productos WHERE stock <= '2'");
          $productos_agotados = mysql_num_rows($q);
          ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php
              if ($productos_agotados != "0") {
                echo '<span class="label label-warning">'.$productos_agotados.'</span>';
              }
              ?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Usted tiene <?php echo $productos_agotados; ?> notificaciones.</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                  while ($row = mysql_fetch_array($q)) {
                    if ($row["stock"] == 1) {
                      echo "<li>
                    <a href='#'>
                      <i class='fa fa-warning text-yellow'></i> Queda $row[stock] unidad de $row[nombre_producto].
                    </a>
                  </li>";
                    }else{
                      echo "<li>
                    <a href='#'>
                      <i class='fa fa-warning text-yellow'></i> Quedan $row[stock] unidades de $row[nombre_producto].
                    </a>
                  </li>";
                    }
                  }
                  ?>                 
                </ul>
              </li>
              <li class="footer"><a href="#">Ver todo</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nombre']; ?> - <?php echo $_SESSION['rango']; ?>
                  <small>RUKALAF GROWSHOP</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="salir.php" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>