<?php
include '../includes/connect.php';
$q = mysql_query("SELECT * FROM productos WHERE codigo_producto = '$_POST[codigo_producto]'");
if (mysql_num_rows($q) == 0) {
	mysql_query("INSERT INTO productos (codigo_producto,nombre_producto,categoria_producto,precio_compra,precio_venta,proveedor) VALUES ('$_POST[codigo_producto]','$_POST[nombre_producto]','$_POST[categoria_producto]','$_POST[precio_c]','$_POST[precio_v]','$_POST[proveedor]')");
	echo "Producto agregado correctamente";
}else{
	echo "El codigo del producto, ya esta registrado en la base de datos. Operación cancelada.";
}

?>