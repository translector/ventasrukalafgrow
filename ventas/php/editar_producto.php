<?php
include '../includes/connect.php';
if ($_POST[editar_producto]) {
	mysql_query("UPDATE productos SET codigo_producto='$_POST[codigo_producto]',nombre_producto='$_POST[nombre_producto]',precio_compra='$_POST[precio_c]',precio_venta='$_POST[precio_v]' WHERE id_producto = '$_GET[id_producto]'");
}
echo "<script>alert('Producto editado correctamente.')</script>";
echo "<meta http-equiv='Refresh' content='0;url=../editar_producto.php?id=$_GET[id_producto]'>";
?>