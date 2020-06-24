<?php
error_reporting(0);
include 'includes/connect.php';
session_start();
if (empty($_SESSION['email'])) {
header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Generar venta - Punto de Venta</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script>
function venta(productos){
        var parametros = {
                "productos" : productos
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/add_venta.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $('#productos').val('');
                        $("#selec_pro").load(" #selec_pro");
                        $("#carrito").load("includes/carrito.php"); 
                        $("#codigo_producto").focus();
                }
        });    
}
function promocion(promocion){
        var parametros = {
                "promocion" : promocion
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/add_venta.php?promocion=true', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $('#productos').val('');
                        $('#promociones').val('');
                        $("#selec_pro").load(" #selec_pro");
                        $("#carrito").load("includes/carrito.php"); 
                        $("#codigo_producto").focus();
                }
        });    
}
function venta_codigo(codigo_producto){
        var parametros = {
                "codigo_producto" : codigo_producto
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/add_venta_codigo.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $('#codigo_producto').val('');
                        $("#selec_pro").load(" #selec_pro");
                        $("#carrito").load("includes/carrito.php"); 
                }
        });    
}
function venta_busqueda(codigo_producto){
        var parametros = {
                "codigo_producto" : codigo_producto
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/add_venta_codigo.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $('#codigo_producto').val('');
                        $("#selec_pro").load(" #selec_pro");
                        $("#carrito").load("includes/carrito.php"); 
                }
        });    
}
function remove(id_carro){
        var parametros = {
                "id_carro" : id_carro
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/remove_carrito.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $('#productos').val('');
                        $("#codigo_producto").focus();
                        $("#selec_pro").load(" #selec_pro");
                        $("#carrito").load("includes/carrito.php"); 
                }
        });    
}
function vaciar(id_carro){
        var parametros = {
                "id_carro" : id_carro
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/vaciar_carrito.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $('#productos').val('');
                        $("#codigo_producto").focus();
                        $("#selec_pro").load(" #selec_pro");
                        $("#carrito").load("includes/carrito.php"); 
                }
        });    
}
function procesar(descu, medio_pago, n_boleta){
        var parametros = {
                "descu" : descu,
                "medio_pago" : medio_pago,
                "n_boleta"	: n_boleta
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/procesar_venta.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $("#carro").load(" #carro");
                        $("#selec_pro").load(" #selec_pro");
                }
        });    
}
function descuento(descu){
        var parametros = {
                "descu" : descu
        };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'php/descuento.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#resultado").html(response);
                        $("#carrito").load("includes/carrito.php"); 
                        
                }
        });    
}
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/header.php'; ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu principal</li>
          <li><a href='index.php'><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
          <li class='treeview'><a href='#'><i class='fa fa-th'></i><span>Productos y Proveedores</span></a>
          <ul class='treeview-menu'>
            <li><a href='agregar_proveedor.php'><i class='fa fa-circle-o'></i> Agregar Proveedor</a></li>
            <li><a href='lista_proveedores.php'><i class='fa fa-circle-o'></i> Lista de Proveedores</a></li>
            <li><a href='agregar_producto.php'><i class='fa fa-circle-o'></i> Agregar Productos</a></li>
            <li><a href='lista_productos.php'><i class='fa fa-circle-o'></i> Lista de Productos</a></li>
            <li><a href="agregar_promocion.php"><i class="fa fa-circle-o"></i> Agregar promoción</a></li>
            <li><a href="lista_promociones.php"><i class="fa fa-circle-o"></i> Lista de promociones</a></li>
            <li><a href='stock.php'><i class='fa fa-circle-o'></i> Stock Productos</a></li>
          </ul>
        </li>
        <li class="active treeview"><a href="#"><i class="fa fa-laptop"></i><span>Sistema de Ventas</span></a>
          <ul class="treeview-menu">
            <li class="active"><a href="#"><i class="fa fa-circle-o"></i> Generar venta</a></li>
            <li><a href="lista_ventas.php"><i class="fa fa-circle-o"></i> Lista de ventas</a></li>
          </ul>
        </li>
        <li class="header">Etiquetas</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nueva venta
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Sistema de Ventas</a></li>
        <li class="active">Generar venta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div id="resultado"></div>
      <div class="row">
          
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Añadir producto con codigo de barras</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="#" method="post" id="agregar_proveedor">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Codigo</label>
                  <input type="text" class="form-control" placeholder="Codigo de barras" id="codigo_producto" autofocus="">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer" style="display: none">
                <input type="submit" href="javascript:;" onclick="venta_codigo($('#codigo_producto').val());return false;" value="Enviar" class="btn btn-primary"/>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
          
          <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Busqueda de producto</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="#" method="post" id="agregar_proveedor">
              <div class="box-body">
                <div class="form-group">
                  <select class="form-control select2" id="codigo_producto_b" size="15">
                    <?php
                    $q = mysql_query("SELECT * FROM productos");
                    while ($row=mysql_fetch_array($q)) {
                      echo "<option value='$row[codigo_producto]'>$row[nombre_producto] ($row[stock])</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" href="javascript:;" onclick="venta_busqueda($('#codigo_producto_b').val());return false;" value="Enviar" class="btn btn-primary"/>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>

        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccione productos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="#" method="post" id="agregar_proveedor">
              <div class="box-body" id="selec_pro">
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
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" href="javascript:;" onclick="venta($('#productos').val());return false;" value="Enviar" class="btn btn-primary"/>
              </div>
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Seleccione promociones</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="#" method="post" id="agregar_promocion">
              <div class="box-body" id="select_promo">
                <div class="form-group">
                  <label>Promociones vigentes</label>
                  <select multiple="" class="form-control" id="promociones">
                    <?php
                    $q = mysql_query("SELECT * FROM promociones");
                    while ($row=mysql_fetch_array($q)) {
                      echo "<option value='".$row["id_promocion"]."'>".$row["nombre"]." - $".$row["valor"]."</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="submit" href="javascript:;" onclick="promocion($('#promociones').val());return false;" value="Enviar" class="btn btn-primary"/>
              </div>
            </form>
          </div>
          <!-- /.box -->
 
</div>

<div class="col-md-6">
          <div class="box" id="carro">
            <div class="box-header">
              <h3 class="box-title">Carrito actual</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="carrito">
              <?php 
              $q = mysql_query("SELECT * FROM carrito");
              if (mysql_num_rows($q) >= 1) {
                include ('includes/carrito.php'); 
              }else{
                echo "<p>El carrito se encuentra vacio.</p>";
              }
              ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ("includes/footer.php"); ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
    <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
</body>
</html>
