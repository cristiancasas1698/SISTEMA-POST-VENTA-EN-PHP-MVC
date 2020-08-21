<?php
require_once "conexion.php";

class ModelUsers{
    static public function mdlMostrarUsuario($tabla,$item,$valor){

        //verificamos si la variable item no llega nulo es para mostrar un solo usuario
        if ($item != null) {
              $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item"); //estructura PDO de php para preparar una consulta
        
              /* Aquí es donde se tiene en cuenta el valor de :item, y solo se va recibir valores STRING como parametro PARAM_STR  */
              $stmt -> bindparam(":".$item, $valor, PDO::PARAM_STR);
              $stmt -> execute();
              return $stmt -> fetch();
            
        //de lo contrario si la variable item llega nula es para mostrar todos los usuarios de la BD
        }else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla"); //estructura PDO de php para preparar una consulta

            $stmt -> execute();

            return $stmt -> fetchAll(); 
            
        }

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
     /*===========================================
      EDITAR USUARIO 
      ============================================*/
    static public function mdlEditarUsuario($tabla,$datos){
         //estructura PDO de php para REGISTRAR un usuario 
         $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,
          password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

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

    /*===========================================
     ACTIVAR O DESACTIVAR USUARIO
    ============================================*/
    static public function mdlActivarUsuario($tabla, $item1, $valor1, $item2, $valor2){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":".$item1,$valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2,$valor2, PDO::PARAM_STR);

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