<?php
class ControllerUsers{

     static public function ctruser(){
         if (isset($_POST["inguser"])) { //si recibe una solicitud de tipo POST 

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["inguser"])&& // utilizo expresiones para que solo acepte determinados nuemros y letras
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingpassword"])){  
                
                $tabla = "usuarios";

                $item = "usuario"; 
                $valor = $_POST["inguser"];

                $respuesta = ModelUsers::mdlMostrarUsuario($tabla,$item,$valor); // se almacena el metodo mdlMostrarUsuario en la variable $respuesta 

                if($respuesta["usuario"] == $_POST["inguser"] && $respuesta["password"] == $_POST["ingpassword"]){
                    echo '<br><div class="alert alert-success">bienvenido al sistema</div>';

                    $_SESSION["starsesion"] = "ok";

                    echo '<script>
                              window.location = "home"        
                         </script>';

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
                  
                $datos = array("nombre" => $_POST["Nuevonombre"],"usuario" => $_POST["Nuevousuario"],
                               "password" => $_POST["Nuevopassword"],"perfil" => $_POST["Nuevoperfil"],
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
  
}

?>