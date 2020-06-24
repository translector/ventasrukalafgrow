<?php
include '../includes/connect.php';
$productos = $_POST['productos'];
$nombre_promo = $_POST['nombre'];
$valor_promo = $_POST['valor'];
if ($nombre_promo != '') {
	mysql_query("INSERT INTO promociones (nombre,valor) VALUES ('$nombre_promo','$valor_promo')");
	$q = mysql_query("SELECT * FROM promociones ORDER BY id_promocion DESC");
	$row = mysql_fetch_array($q);
	foreach ($productos as $key) {
		mysql_query("INSERT INTO productos_promociones (id_promocion,id_producto) VALUES ('".$row["id_promocion"]."','$key')");
	}
	echo '<meta http-equiv="Refresh" content="0;url=../agregar_promocion.php">';
}
?>