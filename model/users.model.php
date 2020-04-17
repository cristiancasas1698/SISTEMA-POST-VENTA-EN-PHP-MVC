<?php
require_once "conexion.php";

class ModelUsers{
    static public function mdlMostrarUsuario($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item"); //estructura PDO de php para preparar una consulta
        
        /* Aquí es donde se tiene en cuenta el valor de :item, y solo se va recibir valores STRING como parametro PARAM_STR  */
        $stmt -> bindparam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
    }
}

?>