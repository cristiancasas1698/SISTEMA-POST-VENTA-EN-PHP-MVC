<?php
class ControllerUsers{

     static public function ctruser(){
         if (isset($_POST["inguser"])) { //si recibe una solicitud de tipo POST 

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["inguser"])&& // utilizo expresiones para que solo acepte determinados nuemros y letras
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingpassword"])){  
                
                $encriptar = crypt($_POST["ingpassword"],'$2a$07$usesomesillystringforsalt$');
                
                $tabla = "usuarios";

                $item = "usuario"; 
                $valor = $_POST["inguser"];

                $respuesta = ModelUsers::mdlMostrarUsuario($tabla,$item,$valor); // se almacena el metodo mdlMostrarUsuario en la variable $respuesta 

                if($respuesta["usuario"] == $_POST["inguser"] && $respuesta["password"] == $encriptar){

                     // SE VERIFICA SI EL USUARIO ESTA ACTIVADO O NO
                    if ($respuesta["estado"] == 1) {
                      $_SESSION["starsesion"] = "ok";
                      $_SESSION["id"] = $respuesta["id"];
                      $_SESSION["nombre"] = $respuesta["nombre"];
                      $_SESSION["usuario"] = $respuesta["usuario"];
                      $_SESSION["foto"] = $respuesta["foto"];
                      $_SESSION["perfil"] = $respuesta["perfil"];
                      echo '<br><div class="alert alert-success">bienvenido al sistema</div>';


                        echo '<script>
                                  window.location = "home"        
                             </script>';                    
                    }else {
                      echo '<br><div class="alert alert-danger">El usuario no esta activado, 
                             comuniquese con el administrador</div>';
                    }

                    

                }else{
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
                
            }
         }

        
    }
/*===========================================
REGISTRO DE USUARIOS
============================================*/
 static public function ctrCrearUsuario(){
     if(isset($_POST["Nuevousuario"])){
         if(preg_match('/^[a-zA-Z ]+$/',$_POST["Nuevonombre"]) && 
             preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["Nuevousuario"]) &&
              preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["Nuevopassword"])){

                /*===========================================
                 VALIDAR IMAGEN DE USUARIO
                 ============================================*/
                 $ruta = "";

                 if (isset($_FILES["Nuevafoto"]["tmp_name"])) {

                   list($ancho,$alto) = getimagesize($_FILES["Nuevafoto"]["tmp_name"]);

                   $nuevoancho = 500;
                   $nuevoalto = 500;

                   var_dump(getimagesize($_FILES["Nuevafoto"]["tmp_name"]));
                   /*===========================================
                    CREAMOS UN DIRECTORIO TEMPORAL PARA GUARDAR IMAGENES DE USUARIO
                    ============================================*/
                    $directorio = "view/img/".$_POST["Nuevousuario"];
                    mkdir($directorio,0755);

                    /*===========================================
                    FUNCIONES DE PHP PARA SUBIR FOTO EN JPG 
                    ============================================*/

                    if ($_FILES["Nuevafoto"]["type"] == "image/jpeg") {
                        /*===========================================
                        GUARDANDO LA IMAGEN DENTRO DEL DIRECTORIO QUE SE CREO
                        ============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "view/img/".$_POST["Nuevousuario"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["Nuevafoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoancho,$nuevoalto);  
                        
                        imagecopyresized ($destino,$origen,0,0,0,0,$nuevoancho,$nuevoalto,$ancho,$alto);

                        imagejpeg($destino,$ruta);

                    }elseif ($_FILES["Nuevafoto"]["type"] == "image/png") {
                        
                        $aleatorio = mt_rand(100,999);

                        $ruta = "view/img/".$_POST["Nuevousuario"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["Nuevafoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoancho,$nuevoalto);  
                        
                        imagecopyresized ($destino,$origen,0,0,0,0,$nuevoancho,$nuevoalto,$ancho,$alto);

                        imagepng($destino,$ruta);
                        
                    }
                        
                  
                 }           
                $tabla = "usuarios";
                //encriptar la contraseña del usuario
                $escriptar = crypt($_POST["Nuevopassword"],'$2a$07$usesomesillystringforsalt$');
                  
                $datos = array("nombre" => $_POST["Nuevonombre"],"usuario" => $_POST["Nuevousuario"],
                               "password" => $escriptar,"perfil" => $_POST["Nuevoperfil"],
                               "ruta" => $ruta);

                $respuesta = ModelUsers::mdlIngresarUsuario($tabla,$datos);

                if ($respuesta == "ok") {
                    echo "<script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Excelente',
                    text: 'el usuario ha sido guardado correctamente'
                  }).then((result)=>{
                    if (result.value) {
                        window.location = 'users';
                      }
                     }
                    )
                  </script>";
                }
                
              }else{
                  echo "<script>
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'el usuario no puede ir vacion o llevar caracteres especiales'
                  }).then((result)=>{
                    if (result.value) {
                        window.location = 'users';
                      }
                     }
                    )
                  </script>";
              }
             
     }
 }
  /*===========================================
  MOSTRAR USUARIOS EN LA BASE DE DATOS
  ============================================*/
  static public function ctrMostrarUsuario($item,$valor){

    $tabla = "usuarios";
    $respuesta = ModelUsers::mdlMostrarUsuario($tabla,$item,$valor);
    return $respuesta;

  }
  /*===========================================
  EDITAR USUARIOS 
  ============================================*/
  static public function ctrEditarUsuario(){

    

    if (isset($_POST["Editarusuario"])) {
        if(preg_match('/^[a-zA-Z ]+$/',$_POST["Editarnombre"])){

           /*===========================================
           EDITAR IMAGEN DE USUARIO
           ============================================*/
           $ruta = $_POST["fotoActual"];
           if (isset($_FILES["Editarfoto"]["tmp_name"]) && !empty($_FILES["Editarfoto"]["tmp_name"])) {

            list($ancho,$alto) = getimagesize($_FILES["Editarfoto"]["tmp_name"]);

            $nuevoancho = 500;
            $nuevoalto = 500;

            var_dump(getimagesize($_FILES["Editarfoto"]["tmp_name"]));
            /*===========================================
             CREAMOS UN DIRECTORIO TEMPORAL PARA GUARDAR IMAGENES DE USUARIO
             ============================================*/
             $directorio = "view/img/".$_POST["editarusuario"];


             if (!empty($_POST["fotoActual"])) {
               unlink($_POST["fotoActual"]);
             }else {
              mkdir($directorio,0755);
             }

             /*===========================================
             FUNCIONES DE PHP PARA SUBIR FOTO EN JPG 
             ============================================*/

             if ($_FILES["Editarfoto"]["type"] == "image/jpeg") {
                 /*===========================================
                 GUARDANDO LA IMAGEN DENTRO DEL DIRECTORIO QUE SE CREO
                 ============================================*/

                 $aleatorio = mt_rand(100,999);

                 $ruta = "view/img/".$_POST["Editarusuario"]."/".$aleatorio.".jpg";

                 $origen = imagecreatefromjpeg($_FILES["Editarfoto"]["tmp_name"]);

                 $destino = imagecreatetruecolor($nuevoancho,$nuevoalto);  
                 
                 imagecopyresized ($destino,$origen,0,0,0,0,$nuevoancho,$nuevoalto,$ancho,$alto);

                 imagejpeg($destino,$ruta);

             }elseif ($_FILES["Editarfoto"]["type"] == "image/png") {
                 
                 $aleatorio = mt_rand(100,999);

                 $ruta = "view/img/".$_POST["Editarusuario"]."/".$aleatorio.".png";

                 $origen = imagecreatefrompng($_FILES["Editarfoto"]["tmp_name"]);

                 $destino = imagecreatetruecolor($nuevoancho,$nuevoalto);  
                 
                 imagecopyresized ($destino,$origen,0,0,0,0,$nuevoancho,$nuevoalto,$ancho,$alto);

                 imagepng($destino,$ruta);
                 
             }      
          } 
          /*===========================================
           SE VERIRIFICA SI LA CONTRASEÑA SE CAMBIO SE ENCRIPTA LA NUEVA CONTRASEÑA
           DE LO CONTRARIO SE DEJA LA CONTRASEÑA COMO ESTABA
           ============================================*/
          $tabla = "usuarios";
          if ($_POST["Editarpassword"] != "") {

            if (preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["Editarpassword"])) {

              $escriptar = crypt($_POST["Editarpassword"],'$2a$07$usesomesillystringforsalt$');
            }else {
              echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'la contraseña no puede llevar caracteres especiales'
              }).then((result)=>{
                if (result.value) {
                    window.location = 'users';
                  }
                 }
                )
              </script>";
              
            }
          }else {
            $escriptar = $passwordActual;
          }
          $datos = array("nombre" => $_POST["Editarnombre"],
                        "usuario" => $_POST["Editarusuario"],
                        "password" => $escriptar,
                        "perfil" => $_POST["Editarperfil"],
                         "ruta" => $ruta);

          $respuesta = ModelUsers::mdlEditarUsuario($tabla,$datos);

          if ($respuesta == "ok") {
            echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Excelente',
            text: 'el usuario ha sido actualizado correctamente'
          }).then((result)=>{
            if (result.value) {
                window.location = 'users';
              }
             }
            )
          </script>";
        }else {
          echo "<script>
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'el nombre no puede ir vacion o llevar caracteres especiales'
                  }).then((result)=>{
                    if (result.value) {
                        window.location = 'users';
                      }
                     }
                    )
                  </script>";
        }

         }

    }
  }

}

?>