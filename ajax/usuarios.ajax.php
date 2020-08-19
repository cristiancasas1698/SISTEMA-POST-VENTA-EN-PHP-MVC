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

}

if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuario();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();
    
}



?>