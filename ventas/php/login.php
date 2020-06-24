<?php
include 'connect.php';
if ($_POST['login']) {
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string(sha1($_POST['password']));
	$q = mysql_query("SELECT * FROM usuarios WHERE email = '$email' and password = '$password'");
	if (mysql_num_rows($q) == 0) {
		echo "<script type=\"text/javascript\">alert(\"Usuario o password incorrecto\");</script>"; 
	}else{
		$row = mysql_fetch_array($q);
		session_start();
		$_SESSION['id'] = $row['id'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['nombre'] = $row['nombre'];
		//rango 1 = administrador
		if ($row[rango] == 1) {
			header("location: home.php");
		}else{//rango distinto de 1 (2) = empleado
			header("location: pos.php");
		}
		
	}
}
?>
<form action="login.php" method="post">
	<input type="text" name="email" placeholder="Email"><br>
	<input type="text" name="password" placeholder="Contraseña"><br>
	<input type="submit" name="login" value="Entrar">
</form>