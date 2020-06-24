<?php
include '../includes/connect.php';
$q = mysql_query("SELECT * FROM carrito");
while ($row=mysql_fetch_array($q)) {
	mysql_query("UPDATE productos SET stock=stock+1 WHERE id_producto = '$row[id_producto]'");
}
mysql_query("TRUNCATE TABLE carrito");
setcookie("descuento", '', time()+19600, "/");
echo "Carrito vaciado correctamente";
?>