<?php
include '../includes/connect.php';
$q = mysql_query("SELECT * FROM carrito");
if (mysql_num_rows($q) >= 1) {
?>
<style type="text/css">
  input#descu, input#n_boleta {
    border-radius: 5px;
    border: 3px solid #13ff00;
    margin: 2px
}
</style>
<table id="carro" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $n = mysql_query("SELECT * FROM carrito");
                  $num = 0;
                  while ($r=mysql_fetch_array($n)) {
                    $num++;
                    if ($r["id_promocion"] != 0) {
                      $l = mysql_query("SELECT * FROM promociones WHERE id_promocion = '$r[id_promocion]'");
                      while ($lrow = mysql_fetch_array($l)) {
                        echo "<tr>";
                        echo "<th>$num</th>";
                        echo "<th>$lrow[nombre]</th>";
                        echo "<th>&#36;$lrow[valor]</th>";
                        echo "<th><input type=\"submit\" href=\"javascript:;\" onclick=\"remove($r[id_carro]);return false;\" value=\"Eliminar\"/></th>";
                        echo "</tr>";
                        $total += $lrow[valor];
                      }
                    }else{
                      $k = mysql_query("SELECT * FROM productos WHERE id_producto = '$r[id_producto]'");
                      while ($rr=mysql_fetch_array($k)) {
                        echo "<tr>";
                        echo "<th>$num</th>";
                        echo "<th>$rr[nombre_producto]</th>";
                        echo "<th>&#36;$rr[precio_venta]</th>";
                        echo "<th><input type=\"submit\" href=\"javascript:;\" onclick=\"remove($r[id_carro]);return false;\" value=\"Eliminar\"/></th>";
                        echo "</tr>";
                        $total += $rr[precio_venta];
                      }
                    }
                  }
                  ?>
               </tbody>
               <tfoot>
                <?php
                  $q = mysql_query("SELECT * FROM carrito");
                  $row = mysql_fetch_array($q);
                  $descuento = $_COOKIE['descuento'];
                  $final = ($descuento*$total)/100;
                  $final_total = $total - $final;
                  ?>
                <tr>
                  <th>Total:</th>
                  <th></th>
                  <th>$<?php echo $final_total; ?></th>
                  <th></th>
                </tr>
                </tfoot>
                <tfoot>
                <tr>
                  <th>Subtotal:</th>
                  <th></th>
                  <th>$<?php echo $total; ?></th>
                  <th></th>
                </tr>
                </tfoot>
                <tfoot>
                <tr>
                  <th>Descuento:</th>
                  <th></th>
                  <th><?php echo ($_COOKIE['descuento'] == '') ? "0":$_COOKIE['descuento']; ?>%</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
<div class="box-footer">
                <center>
                  Medio de pago:
                  <select id="medio_pago">
                    <option value="Efectivo" selected="">Efectivo</option>
                    <option value="Transbank">Transbank</option>
                  </select><br><br>
                  <input type="text" id="descu" placeholder="Descuento total" onchange="descuento($('#descu').val());return false;" value="<?php echo $_COOKIE['descuento']; ?>"><input type="text" id="n_boleta" placeholder="Numero de boleta"><br><br>
                  <form action="" method="post" id="procesar_venta">
                <input type="submit" href="javascript:;" onclick="procesar($('#descu').val(),$('#medio_pago').val(),$('#n_boleta').val());return false;" value="Procesar venta" class="btn btn-warning"/>
                <input type="submit" href="javascript:;" onclick="vaciar($('#id_carro').val());return false;" value="Vaciar carrito" class="btn btn-danger"/> 
                </form>
                
              </center>
              </div>
<?php 
}else{
  echo "<p>El carrito se encuentra vacio.</p>";
}
?>