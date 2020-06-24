<?php
include '../includes/connect.php';
  $n = mysql_query("SELECT * FROM carrito");
  $num = 0;
  while ($r=mysql_fetch_array($n)) {
    if ($r["id_promocion"] != 0) {
      $l = mysql_query("SELECT * FROM promociones WHERE id_promocion = '$r[id_promocion]'");
      while ($lrow=mysql_fetch_array($l)) {
        $total += $lrow["valor"];
      }
    }else{
      $k = mysql_query("SELECT * FROM productos WHERE id_producto = '$r[id_producto]'");
      while ($rr=mysql_fetch_array($k)) {
        $total += $rr["precio_venta"];
      }
    }
  }
$descuento = $_POST['descu'];
$medio_pago = $_POST['medio_pago'];
$n_boleta = $_POST['n_boleta'];
$final = ($descuento*$total)/100;
$final_total = $total - $final;

$fecha = date('d/m/Y');
$hora = date('H:i:s');

mysql_query("INSERT INTO ventas (total,descuento,medio_pago,n_boleta,fecha,hora) VALUES ('$final_total','$descuento','$medio_pago','$n_boleta','$fecha','$hora')");

$l = mysql_query("SELECT * from ventas ORDER BY id_venta DESC LIMIT 1");
$lrow = mysql_fetch_array($l);

$q = mysql_query("SELECT * FROM carrito WHERE id_producto != 0");
while ($row=mysql_fetch_array($q)) {
	mysql_query("INSERT INTO productos_ventas (id_venta,id_producto) VALUES ('$lrow[id_venta]','$row[id_producto]')");
	//mysql_query("UPDATE productos SET stock = stock-1 WHERE id_producto = '$row[id_producto]'");
}

$b = mysql_query("SELECT * FROM carrito WHERE id_promocion != 0");
$promoci = mysql_num_rows($b);
if ($promoci > 0) {
  while ($brow = mysql_fetch_array($b)) {
    mysql_query("INSERT INTO ventas_promociones (id_venta,id_promocion) VALUES ('$lrow[id_venta]','$brow[id_promocion]')");
  }
}
mysql_query("TRUNCATE TABLE carrito");
setcookie("descuento", '', time()+19600, "/");
echo "Venta realizada correctamente.";
//echo '<meta http-equiv="Refresh" content="0;url=vouncher.php?id_venta='.$lrow["id_venta"].'">';
echo '<script>alert("Venta realizada correctamente");</script>';
echo '<meta http-equiv="Refresh" content="0;url=venta.php">';
?>