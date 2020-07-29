<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Inventario</title>
  <link rel="icon" href="view\img\sistema_inventario2.png">

                         <!-- =============================================== -->
                           <!--    plugins de css de la pagina   -->
                         <!-- =============================================== -->

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/AdminLTE.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">
  
  <!-- Google Font tipografia del sitio web-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
                         
                         <!-- =============================================== -->
                           <!--    plugins de javascript de la pagina   -->
                         <!-- =============================================== -->

  <!-- jQuery 3 -->
  <script src="view/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="view/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="view/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="view/dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- sweetalert2 -->
  <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>

</head>

                         <!-- =============================================== -->
                           <!--            cuerpo de la pagina        -->
                         <!-- =============================================== -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
<?php

if (isset($_SESSION["starsesion"]) && ($_SESSION["starsesion"]) == "ok") { //se verifica si tiene una sesion iniciada de lo contrario se evia a login.php
echo '<div class="wrapper">';
// cabecera de la pagina 
include "modules/header.php";
// menu lateral
include "modules/sidebar.php";

/* de esta manera cuando se desee ingresar a alguna de las opciones del menu lateral
      como [home,product,users,categories,sales...] la url sera "amigable" mostrando la
       opcion escogida como: "localhost/AdminLTE/[opcion escogida]"     */    

if (isset($_GET["ruta"])) {
  if ($_GET["ruta"] == "home" || 
      ($_GET["ruta"] == "users") ||
       ($_GET["ruta"] == "categories") ||
        ($_GET["ruta"] == "products") ||
          ($_GET["ruta"] == "client") ||
            ($_GET["ruta"] == "sales") ||
              ($_GET["ruta"] == "create-sales") ||
                ($_GET["ruta"] == "report-sales") ||
                 ($_GET["ruta"] == "salir")){  
       
    include "modules/".$_GET["ruta"].".php";
  }else {
    include "modules/404.php";
  }
}else {
  include "modules/home.php";
}

// contenido de la pagina por defecto
include "modules/footer.php";

echo '</div>';

}else {
  include "modules/login.php";

}
?>
 
<!-- ./wrapper -->
<script src="view/js/plantilla.js"></script>
<script src="view/js/usuarios.js"></script>

</body>
</html>
