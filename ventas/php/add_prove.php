<?php
include '../includes/connect.php';
mysql_query("INSERT INTO proveedores (nombre_prove,email,fono) VALUES ('$_POST[nombre]','$_POST[email]','$_POST[fono]')");
echo "Agregado correctamente";
?>