<?php
require_once "../controller/users.controller.php";
require_once "../model/users.model.php";


class AjaxUsuario{
    /*===========================================
    EDITAR USUARIO
    ============================================*/
    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this -> idUsuario;
        $respuesta = ControllerUsers::ctrMostrarUsuario($item,$valor);

        echo json_encode($respuesta);
    }

    /*===========================================
     ACTIVAR O DESACTIVAR USUARIO
     ============================================*/
     public $activarId;
     public $activarUsuario;

     public function ajaxActivarUsuario(){
        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModelUsers::mdlActivarUsuario($tabla, $item1, $valor1, $item2, $valor2);

     }

 

}

if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuario();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
    
}

/*===========================================
ACTIVAR O DESACTIVAR USUARIO
============================================*/
if (isset($_POST["activarUsuario"])) {

    $activarUsuario = new AjaxUsuario();
    $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
    $activarUsuario -> activarId = $_POST["activarId"];
    $activarUsuario -> ajaxActivarUsuario();

}




?>