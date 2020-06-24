<?php
include '../includes/connect.php';
$q = mysql_query("SELECT * FROM carrito WHERE id_carro = '$_POST[id_carro]'");
while ($row=mysql_fetch_array($q)) {
	mysql_query("UPDATE productos SET stock=stock+1 WHERE id_producto = '$row[id_producto]'");
}
mysql_query("DELETE FROM carrito WHERE id_carro = '$_POST[id_carro]'");
echo "Producto eliminado del carrito correctamente";
?>