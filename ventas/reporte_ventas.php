<?php
error_reporting(0);
include 'includes/connect.php';
include 'includes/verificar.php';
$fecha = explode("-", $_GET["fecha"]);
$fecha_inicio = $fecha["0"];
$fecha_fin = $fecha["1"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reporte Ventas | Rukalaf GrowShop</title>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <style type="text/css">
    @media print {
  @page { margin: 0; }
  body { margin: 10px; }
  a.btn.btn-default{display:none;}
}

  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body >
<div class="wrapper">
  <!-- Main content -->
    <!-- title row -->
    <section class="content">
    <div class="row">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ventas periodo: <?php echo $fecha_inicio." - ".$fecha_fin; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="ventas" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha y Hora</th>
                  <th>Cantidad Productos</th>
                  <th>Total</th>
                  <th>Descuento</th>
                  <th>Medio de Pago</th>
                  <th>N° Boleta</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $fecha_inicio_f = explode("/", $fecha_inicio);
                $fecha_fin_f = explode("/", $fecha_fin);
                $fecha_inicio_ff = $fecha_inicio_f["2"]."-".$fecha_inicio_f["1"]."-".$fecha_inicio_f["0"];
                $fecha_fin_ff = $fecha_fin_f["2"]."-".$fecha_fin_f["1"]."-".$fecha_fin_f["0"];
                  $num = 0;
                  $q = mysql_query("SELECT * FROM ventas WHERE str_to_date(fecha,'%d/%m/%Y') BETWEEN '$fecha_inicio_ff' AND '$fecha_fin_ff'");
                  $row = mysql_num_rows($q);
                  while ($row=mysql_fetch_array($q)) {
                  $n = mysql_query("SELECT * FROM productos_ventas WHERE id_venta = '$row[id_venta]'");
                  $n_producto = mysql_num_rows($n);
                  $num++;
                  $total = number_format($row[total], 0, '','.');
                    echo "<tr>
                  <th>$num</th>
                  <th>".$row["fecha"]." ".$row["hora"]."</th>
                  <th>$n_producto</th>
                  <th>&#36;".number_format($row["total"], "0", "", ".")."</th>
                  <th>$row[descuento]%</th>
                  <th>$row[medio_pago]</th>
                  <th>#$row[n_boleta]</th>";
                }
                $qq = mysql_query("SELECT SUM(total) AS total FROM ventas WHERE str_to_date(fecha,'%d/%m/%Y') BETWEEN '$fecha_inicio_ff' AND '$fecha_fin_ff'");
                $qtotal = mysql_fetch_array($qq);
                $total = $qtotal['total'];
              ?>
              <tfoot><tr><th rowspan='1' colspan='1'>Total periodo:</th><th rowspan='1' colspan='1'></th><th rowspan='1' colspan='1'></th><th rowspan='1' colspan='1'>$<?php echo number_format($total, "0", "", "."); ?></th><th class='dt-body-right' rowspan='1' colspan='1'></th><th class='dt-body-right' rowspan='1' colspan='1'></th></tr></tfoot>
              </table>
        <center><a href="#" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a></center>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.col -->
    </div>
  </section>
    <!-- /.row -->
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>
