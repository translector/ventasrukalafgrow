<?php
error_reporting(0);
include 'includes/connect.php';
include 'includes/verificar.php';
$id = mysql_real_escape_string($_GET['id']);
$q = mysql_query("SELECT * FROM proveedores WHERE id_prove = '$id'");
$row = mysql_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Editar proveedor - Punto de Venta</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu principal</li>
        <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
        <li class="active treeview"><a href="#"><i class="fa fa-th"></i><span>Productos y Proveedores</span></a>
          <ul class="treeview-menu">
            <li class="active"><a href="agregar_proveedor.php"><i class="fa fa-circle-o"></i> Agregar Proveedor</a></li>
            <li><a href="lista_proveedores.php"><i class="fa fa-circle-o"></i> Lista de Proveedores</a></li>
            <li><a href="agregar_producto.php"><i class="fa fa-circle-o"></i> Agregar Productos</a></li>
            <li><a href="lista_productos.php"><i class="fa fa-circle-o"></i> Lista de Productos</a></li>
            <li><a href="agregar_promocion.php"><i class="fa fa-circle-o"></i> Agregar promoción</a></li>
            <li><a href="lista_promociones.php"><i class="fa fa-circle-o"></i> Lista de promociones</a></li>
            <li><a href="stock.php"><i class="fa fa-circle-o"></i> Stock Productos</a></li>
          </ul>
        </li>
        <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>Sistema de Ventas</span></a>
          <ul class="treeview-menu">
            <li><a href="venta.php"><i class="fa fa-circle-o"></i> Generar venta</a></li>
            <li><a href="lista_ventas.php"><i class="fa fa-circle-o"></i> Lista de ventas</a></li>
          </ul>
        </li>
        <li class="header">Etiquetas</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar proveedor de la base de datos
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Productos y Proveedores</a></li>
        <li class="active">Editar proveedor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información del proveedor</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="php/editar_proveedor.php?id_prove=<?php echo $id; ?>" method="post" id="agregar_proveedor">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" name="nombre" required="" value="<?php echo $row['nombre_prove'] ?>">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" placeholder="Email" name="email" required="" value="<?php echo $row['email'] ?>">
                </div>
                <div class="form-group">
                  <label for="nombre">Teléfono</label>
                  <input type="text" class="form-control" placeholder="Teléfono" name="fono" required="" value="<?php echo $row['fono'] ?>">
                </div>
                <div class="form-group">
                  <label for="nombre">Categoria</label>
                  <input type="text" class="form-control" placeholder="Categoria" name="categoria" required="" value="<?php echo $row['categoria'] ?>">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" value="Editar" name="editar_proveedor" class="btn btn-primary"/>
              </div>
            </form>
          </div>
          <!-- /.box -->
 <div id="resultado"></div>
</div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ("includes/footer.php"); ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
