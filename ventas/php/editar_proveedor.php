<?php
include '../includes/connect.php';
if ($_POST[editar_proveedor]) {
	mysql_query("UPDATE proveedores SET nombre_prove='$_POST[nombre]',email='$_POST[email]',fono='$_POST[fono]',categoria='$_POST[categoria]' WHERE id_prove = '$_GET[id_prove]'");
}
echo "<script>alert('Proveedor editado correctamente.')</script>";
echo "<meta http-equiv='Refresh' content='0;url=../editar_proveedor.php?id=$_GET[id_prove]'>";
?>