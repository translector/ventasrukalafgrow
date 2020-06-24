<?php
include '../includes/connect.php';
?>
<div class="form-group">
                  <label>Productos</label>
                  <select multiple="" class="form-control" id="productos">
                    <?php
                    $q = mysql_query("SELECT * FROM productos WHERE stock >= 1");
                    while ($row=mysql_fetch_array($q)) {
                      echo "<option value='$row[id_producto]'>$row[nombre_producto] ($row[stock])</option>";
                    }
                    ?>
                  </select>
                </div>