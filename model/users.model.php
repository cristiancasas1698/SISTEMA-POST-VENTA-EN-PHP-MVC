<?php
require_once "conexion.php";

class ModelUsers{
    static public function mdlMostrarUsuario($tabla,$item,$valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item"); //estructura PDO de php para preparar una consulta
        
        /* Aquí es donde se tiene en cuenta el valor de :item, y solo se va recibir valores STRING como parametro PARAM_STR  */
        $stmt -> bindparam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt -> null;
    }
   /*===========================================
   REGISTRAR UN NUEVO USUARIO 
   ============================================*/
    static public function mdlIngresarUsuario($tabla,$datos){

        //estructura PDO de php para REGISTRAR un usuario 
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) 
                                              values (:nombre, :usuario, :password, :perfil, :foto)"); 

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["ruta"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        }else {
            return "error";
        }
        $stmt -> close();

        $stmt -> null;

    }
}

?>