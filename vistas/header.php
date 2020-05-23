<?php
if (strlen(session_id()) < 1) 
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Test | Tienda Online</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css" type="text/css">    
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css" />
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="../public/css/bootstrap-select.min.css" type="text/css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">
  </head>

  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="prestamosView.php" class="logo">  
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">Test <b>Tienda Online</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Tienda Online</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"><?php echo $_SESSION['usuario']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="../ajax/LoginAjax2.php?op=logout" class="btn btn-default btn-flat">Cerrar Sesion</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <?php if($_SESSION['admin'] == 1) { ?>
              <li>
                <a href="ventasView.php">
                  <i class="fa fa-home"></i> <span>Inicio</span>
                </a>
              </li> 
            <?php } ?>

            <?php if($_SESSION['admin'] == 1) { ?>
              <li>
                <a href="ventasView.php">
                  <i class="fa fa-usd"></i> <span>Ventas</span>
                </a>
              </li> 
            <?php } ?>

            <?php if($_SESSION['admin'] == 1) { ?>
              <li>
                <a href="clientesView.php">
                  <i class="fa fa-users"></i> <span>Clientes</span>
                </a>
              </li>
            <?php } ?>

            <?php if($_SESSION['admin'] == 1) { ?>
              <li>
                <a href="articulosView.php">
                  <i class="fa fa-tags"></i> <span>Articulos</span>
                </a>
              </li>
            <?php } ?>

            <?php if($_SESSION['admin'] == 1) { ?>
              <li>
                <a href="cuponesView.php">
                  <i class="fa fa-gift"></i> <span>Cupones</span>
                </a>
              </li> 
            <?php } ?>

            <?php if($_SESSION['admin'] == 1) { ?>
              <li>
                <a href="configuracionView.php">
                  <i class="fa fa-line-chart"></i> <span>Configuración</span>
                </a>
              </li> 
            <?php } ?>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>