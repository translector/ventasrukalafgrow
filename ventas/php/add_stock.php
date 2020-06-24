<?php
include '../includes/connect.php';
$stock = $_POST[cantidad];
mysql_query("UPDATE productos SET stock=stock+$stock WHERE id_producto = '$_POST[producto]'");
$fecha = date('d/m/Y h:i:s');
mysql_query("INSERT INTO ingreso_stock (id_producto,fecha,cantidad) VALUES ('$_POST[producto]','$fecha','$stock')");
echo "Stock a producto agregado correctamente";
?>