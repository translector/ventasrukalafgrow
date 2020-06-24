<?php
include '../includes/connect.php';
mysql_query("DELETE FROM productos WHERE id_producto = '$_GET[id]'");
echo "<script>alert('Producto eliminado correctamente.')</script>";
echo "<meta http-equiv='Refresh' content='0;url=../lista_productos.php'>";
?>