<?php
include '../includes/connect.php';
if ($_GET[id_venta]) {
	mysql_query("UPDATE ventas SET estado = 'Pagado' WHERE id_venta = '$_GET[id_venta]'");
	echo "<script language='javascript'>alert('Venta validada correctamente');</script>";
	echo "<meta http-equiv='Refresh' content='0;url=../validar.php'>";
}
?>