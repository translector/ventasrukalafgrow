<?php
error_reporting(0);
include 'includes/connect.php';
session_start();
if (empty($_SESSION['email'])) {
header("location: login.php");
}
$id_venta = $_GET['id_venta'];
$q = mysql_query("SELECT * FROM ventas WHERE id_venta = '$id_venta'");
$row = mysql_fetch_array($q);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vouncher | Rukalaf GrowShop</title>
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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    img#logo {
      max-width: 300px;
    }
    .table-h {
    width: 300px;
    max-width: 300px;
    margin-bottom: 10px;
    background-color: transparent;
    border-spacing: 0;
    border-collapse: collapse;
    }
    .table2 {
    width: 250px;
    max-width: 250px;
    margin-bottom: 10px;
    background-color: transparent;
    border-spacing: 0;
    border-collapse: collapse;
    }
    @media print {
  @page { margin: 0; }
  body { margin: 10px; }
}
.wrapperr {
    /*height: 100%;*/
    position: relative;
    overflow-x: hidden;
    overflow-y: auto;
}
.col-sm-4 {
    width: 100%!important;
    max-width: 320px!important;
}
.col-xs-6 {
    width: 100%!important;
    max-width: 320px!important;
}
  </style>
</head>
<body onload="window.print();">
<div class="wrapperr" id="imp">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <img src="dist/img/logo.png" width="290px" />
      </div>
      <!-- /.col -->
    </div>
    <!-- info row --><br>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <b>ID Venta:</b> #<?php echo $row["id_venta"]; ?><br>
        <b>Fecha y Hora:</b> <?php echo $row["fecha"]." ".$row["hora"]; ?><br>
        <b>Medio de Pago:</b> <?php echo $row["medio_pago"]; ?> <br>
       <?php if ($row["n_boleta"] != '0') { echo "<b>Numero boleta: </b>#".$row["n_boleta"]."<br>";}?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table-h table-striped">
          <thead>
          <tr>
            <th width="5%">#</th>
            <th width="80%">Producto</th>
            <th width="15%">Precio</th>
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
                          <th>$mrow[nombre]</th>
                          <th>$".number_format($mrow["valor"], "0", "", ".")."</th>
                        </tr>";
                        $total += $mrow["valor"];
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
                          <th>$".number_format($nrow["precio_venta"], "0", "", ".")."</th>
                        </tr>";
                        $total += $nrow["precio_venta"];
                        }
                      }
                    }
                  
                  
                  ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php
    $total_descuento = ($row["descuento"]*$total)/100;
$total_final = $total - $total_descuento;
    ?>
    <div class="row">
      <div class="col-xs-6">
        <div class="table-responsive">
          <table class="table2">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$<?php echo number_format($total, "0", "", "."); ?></td>
            </tr>
            <tr>
              <th>Descuento (%<?php echo $row['descuento']; ?>)</th>
              <td>$<?php echo number_format($total_descuento, "0", "", "."); ?></td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$<?php echo number_format($total_final, "0", "", "."); ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<meta http-equiv="Refresh" content="0;url=venta.php">
</body>
</html>
