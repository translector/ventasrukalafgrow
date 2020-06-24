<?php
include '../includes/connect.php';
$promocion = $_POST['promocion'];
if ($promocion != true) {
	foreach ($_POST[productos] as $id_productos) {
	$q = mysql_query("SELECT * FROM productos WHERE id_producto = '$id_productos'");
	$row = mysql_fetch_array($q);
	$query = "INSERT INTO carrito (id_producto) VALUES ('$id_productos')";
	switch ($row[stock]) {
		case 0:
			echo "Este producto no tiene stock.";
			break;
		case 1:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente<br>";
			$err1="<font color='red'><h4>Ojo: Esta es la ultima unidad de ".$row[nombre_producto]." para ser vendida.</h4></font>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$id_productos'");
			mysql_query($query);
			break;
		case 2:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente<br>";
			$err2="<font color='red'><h4>Ojo: Quedan 1 unidades de ".$row[nombre_producto].".</h4></font>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$id_productos'");
			mysql_query($query);
			break;
		case 3:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente<br>";
			$err3="<font color='red'><h4>Ojo: Quedan 2 unidades de ".$row[nombre_producto].".</h4></font>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$id_productos'");
			mysql_query($query);
			break;
		default:
			echo "Producto <b>".$row[nombre_producto]."</b> agregado al carrito correctamente.<br>";
			mysql_query("UPDATE productos SET stock=stock-1 WHERE id_producto = '$id_productos'");
			mysql_query($query);
			break;
	}
}
	echo $err1;
	echo $err2;
	echo $err3;
//echo "Producto agregado al carrito correctamente";
}else{
	foreach ($promocion as $id_promocion) {
		$q = mysql_query("SELECT * FROM productos_promociones WHERE id_promocion = '".$id_promocion."'");
		while ($row = mysql_fetch_array($q)) {
		$s = mysql_query("SELECT * FROM productos WHERE id_producto = '".$row['id_producto']."'");
		$srow = mysql_fetch_array($s);
		//$srow = mysql_fetch_array($s);
		if ($srow["stock"] == 0) {
				echo "<script type=\"text/javascript\">alert(\"Producto ".$srow["nombre_producto"]." sin stock.\");</script>";
				mysql_query("TRUNCATE TABLE carrito");
				setcookie("descuento", '', time()+19600, "/");
				echo '<meta http-equiv="Refresh" content="0;url=venta.php">';
			}else{
				mysql_query("INSERT INTO carrito (id_promocion) VALUES ('$id_promocion')");
			}		
		}
		$sq = mysql_query("SELECT * FROM productos_promociones WHERE id_promocion = '".$id_promocion."'");
		$total_b = mysql_num_rows($sq);
		if ($total_b > 1) {
			$borrar = $total_b - 1;
		}else{
			$borrar = $total_b;
		}
		$contador = 1;
		while($contador < $total_b){
		      $s = mysql_query("SELECT * FROM carrito ORDER BY id_carro DESC");
				$srow = mysql_fetch_array($s);
				mysql_query("DELETE FROM carrito WHERE id_carro = '$srow[id_carro]'");
		      $contador++;
		   }
		
	}
}
?>
