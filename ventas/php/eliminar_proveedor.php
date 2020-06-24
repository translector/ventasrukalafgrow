<?php
include '../includes/connect.php';
mysql_query("DELETE FROM proveedores WHERE id_prove = '$_GET[id_proveedor]'");
echo "<script>alert('Proveedor eliminado correctamente.')</script>";
echo "<meta http-equiv='Refresh' content='0;url=../lista_proveedores.php'>";
?>