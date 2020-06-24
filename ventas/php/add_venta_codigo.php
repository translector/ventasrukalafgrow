<?php
include '../includes/connect.php';
$q = mysql_query("SELECT * FROM productos WHERE codigo_producto = '$_POST[codigo_producto]'");
if (mysql_num_rows($q) == 0) {
	echo "El producto no existe en la base de datos";
}else{
	$row = mysql_fetch_array($q);
	$query = "INSERT INTO carrito (id_producto) VALUES ('$row[id_producto]')";
	switch ($row[stock]) {
		case 0:
			echo "Este producto no tiene stock.";
			break;
		case 1:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente<br>";
			$err1="<font color='red'>Ojo: Esta es la ultima unidad de ".$row[nombre_producto]." para ser vendida.</span>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$row[id_producto]'");
			mysql_query($query);
			break;
		case 2:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente<br>";
			$err2="<font color='red'><h4>Ojo: Quedan 2 unidades de ".$row[nombre_producto].".</h4></font>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$row[id_producto]'");
			mysql_query($query);
			break;
		case 3:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente<br>";
			$err3="<font color='red'><h4>Ojo: Quedan 3 unidades de ".$row[nombre_producto].".</h4></font>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$row[id_producto]'");
			mysql_query($query);
			break;
		default:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente.<br>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$row[id_producto]'");
			mysql_query($query);
			break;
	}
}
	echo $err1;
	echo $err2;
	echo $err3;
?>