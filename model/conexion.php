<?php
class Conexion{
     public function conectar(){
         
        $link = new PDO("mysql:host=localhost;dbname=admin_lte", //PDO es una forma de conectarnos a la base de datos
                        "root",
                        "");
         $link -> exec("set name utf8");

         return $link;
     }
}

?>