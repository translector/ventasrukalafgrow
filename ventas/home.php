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
  <title>Punto de Venta | RUKALAF GROWSHOP</title>
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
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
        <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Inicio</span></a></li>
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
    <!-- /.sideb
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php 
          $fecha_actual = date('d/m/Y');
          $q = mysql_query("SELECT * FROM ventas WHERE fecha = '$fecha_actual'");
          $total_hoy = mysql_num_rows($q);
          ?>
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $total_hoy; ?>/Hoy</h3>

              <p>Productos vendidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="lista_ventas.php" class="small-box-footer">Ver más detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php 
          $fecha_actual = date('d/m/Y');
          $q = mysql_query("SELECT SUM(total) AS total_hoy FROM ventas WHERE fecha = '$fecha_actual'");
          $ventas_hoy = mysql_fetch_array($q);
          $total_hoy = $ventas_hoy[total_hoy];
          ?>
          <div class="small-box bg-green">
            <div class="inner">
              <h3><sup style="font-size: 20px">$</sup><?php if ($total_hoy > 0) {echo number_format($total_hoy, "0", "", ".");}else{echo "0";} ?></h3>

              <p>Ventas hoy</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="lista_ventas.php" class="small-box-footer">Ver más detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- clientes
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>0</h3>

              <p>Clientes registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Ver más detalles <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>-->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <?php 
          $fecha_actual = date('d/m/Y');
          $q = mysql_query("SELECT * FROM productos WHERE stock = 0");
          $productos_agotados = mysql_num_rows($q);
          ?>
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $productos_agotados; ?></h3>
              <p>Productos agotados</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="stock.php" class="small-box-footer">Revisar ahora! <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#ventasultimas" data-toggle="tab">Area</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> Ventas (Ultimos 7 días)</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="ventasultimas" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Ventas hoy</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

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
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
  $(function () {
    /* Morris.js Charts */
  // Sales chart
var day_data = [
  <?php
  $fecha_hoy = date("d/m/Y");
  $fecha_inicio = date("d/m/Y",strtotime($fecha_hoy."- 3 days"));
$q = mysql_query("SELECT fecha , SUM(total) AS total FROM ventas WHERE fecha >= '$fecha_inicio' AND fecha <= '$fecha_hoy' GROUP by fecha");
  while ($row=mysql_fetch_array($q)) {
    $fecha_c = str_replace("/", "-", $row["fecha"]);
    $fecha_cu = explode("-", $fecha_c);
    $fecha_final = $fecha_cu["2"]."-".$fecha_cu["1"]."-".$fecha_cu["0"];
    echo "
    { period: '".$fecha_final."', total: ".$row['total']." },
    ";
  }
  ?>
];
Morris.Line({
  element: 'ventasultimas',
  data: day_data,
  xkey: 'period',
  ykeys: ['total'],
  labels: ['Total']
});

var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [
    <?php
  $fecha_hoy = date("d/m/Y");
$qq = mysql_query("SELECT * FROM ventas WHERE fecha = '$fecha_hoy'");
  while ($qrow=mysql_fetch_array($qq)) {
    $fecha_cl = str_replace("/", "-", $qrow["fecha"]);
    $fecha_cul = explode("-", $fecha_cl);
    $fecha_finall = $fecha_cul["2"]."-".$fecha_cul["1"]."-".$fecha_cul["0"];
    echo "
    { period: '".$fecha_finall." ".$qrow['hora']."', total: ".$qrow['total']." },
    ";
  }
  ?>
    ],
    xkey             : 'period',
    ykeys: ['total'],
     labels: '$'+['Total']
  });

});

</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
