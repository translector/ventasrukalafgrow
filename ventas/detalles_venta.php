<?php
error_reporting(0);
include 'includes/connect.php';
include 'includes/verificar.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Detalle de venta - Punto de Venta</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
        <li class="treeview"><a href="#"><i class="fa fa-th"></i><span>Productos y Proveedores</span></a>
          <ul class="treeview-menu">
            <li><a href="agregar_proveedor.php"><i class="fa fa-circle-o"></i> Agregar Proveedor</a></li>
            <li><a href="lista_proveedores.php"><i class="fa fa-circle-o"></i> Lista de Proveedores</a></li>
            <li><a href="agregar_producto.php"><i class="fa fa-circle-o"></i> Agregar Productos</a></li>
            <li><a href="lista_productos.php"><i class="fa fa-circle-o"></i> Lista de Productos</a></li>
            <li><a href="agregar_promocion.php"><i class="fa fa-circle-o"></i> Agregar promoción</a></li>
            <li><a href="lista_promociones.php"><i class="fa fa-circle-o"></i> Lista de promociones</a></li>
            <li><a href="stock.php"><i class="fa fa-circle-o"></i> Stock Productos</a></li>
          </ul>
        </li>
        <li class="active treeview"><a href="#"><i class="fa fa-laptop"></i><span>Sistema de Ventas</span></a>
          <ul class="treeview-menu">
            <li><a href="venta.php"><i class="fa fa-circle-o"></i> Generar venta</a></li>
            <li class="active"><a href="lista_ventas.php"><i class="fa fa-circle-o"></i> Lista de ventas</a></li>
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
        Detalle de ventas
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Sistema de Ventas</a></li>
        <li class="active">Detalle de venta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class='col-xs-12' id='print'>
          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Historial de ventas</h3>
              <form action='' method='get' style='float:right;'>
              <input type='date' name='fecha' required>
              <input type='submit' value='ir'>
              </form>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='todas' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre Producto</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Precio Venta</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $num = 0;
                  $q = mysql_query("SELECT * FROM productos_ventas WHERE id_venta = '$_GET[id_venta]'");
                  $l = mysql_query("SELECT * FROM ventas_promociones WHERE id_venta = '$_GET[id_venta]'");
                  $ven_pro = mysql_num_rows($l);
                  if ($ven_pro > 0) {

                      while ($lrow = mysql_fetch_array($l)) {
                        $m = mysql_query("SELECT * FROM promociones WHERE id_promocion = '$lrow[id_promocion]'");
                        while ($mrow = mysql_fetch_array($m)) {
                          $v = mysql_query("SELECT * FROM ventas WHERE id_venta = '$_GET[id_venta]'");
                          $vrow = mysql_fetch_array($v);
                          $num++;
                          echo "<tr>
                          <th>$num</th>
                          <th><a href='ver_promocion.php?id=$lrow[id_promocion]'>$mrow[nombre]</a></th>
                          <th>$vrow[fecha]</th>
                          <th>$vrow[hora]</th>
                          <th>$$mrow[valor]</th>
                        </tr>";
                        $total = $mrow[valor];
                        }
                      }
                  }
                  while ($row=mysql_fetch_array($q)) {
                      $k = mysql_query("SELECT * FROM ventas WHERE id_venta = '$_GET[id_venta]'");
                      while ($krow=mysql_fetch_array($k)) {
                        $n = mysql_query("SELECT * FROM productos WHERE id_producto = '$row[id_producto]'");
                        while ($nrow=mysql_fetch_array($n)) {
                          $num++;
                          echo "<tr>
                          <th>$num</th>
                          <th>$nrow[nombre_producto]</th>
                          <th>$krow[fecha]</th>
                          <th>$krow[hora]</th>
                          <th>$$nrow[precio_venta]</th>
                        </tr>";
                        $total = $krow[total];
                        }
                      }
                    }
                  
                  
                  ?>
                  
                </tbody>
                <tfoot><tr><th rowspan='1' colspan='1'>Total</th><th rowspan='1' colspan='1'></th><th rowspan='1' colspan='1'></th><th class='dt-body-right' rowspan='1' colspan='1'></th><th class='dt-body-right' rowspan='1' colspan='1'>&#36;<?php echo $total; ?></th></tr></tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        


        <!-- /.col -->
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
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#todas').DataTable()
    $('#filtrofecha').DataTable() 
     })
</script>
</body>
</html>
