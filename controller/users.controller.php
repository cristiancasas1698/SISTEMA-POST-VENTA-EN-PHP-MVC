<?php
class ControllerUsers{

     public function ctruser(){
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
}

?>