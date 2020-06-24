<?php
session_start();
if (empty($_SESSION['email'])) {
header("location: login.php");
}
//verificar rango
if ($_SESSION[rango] != 1) {
  echo "<script type=\"text/javascript\">alert(\"No tienes permisos suficientes para visitar esta pagina\");</script>"; 
  echo "<meta http-equiv='Refresh' content='0;url=pos.php'>";
  exit();
}
?>