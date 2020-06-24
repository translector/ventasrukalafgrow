<?php
include '../includes/connect.php';
mysql_query("DELETE FROM promociones WHERE id_promocion = '$_GET[id_promocion]'");
mysql_query("DELETE FROM productos_promociones WHERE id_promocion = '$_GET[id_promocion]'");
echo "<script>alert('Promoción eliminada correctamente.')</script>";
echo "<meta http-equiv='Refresh' content='0;url=../lista_promociones.php'>";
?>