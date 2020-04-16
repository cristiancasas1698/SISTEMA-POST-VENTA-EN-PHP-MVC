<?php   
// controladores de cada vista de la pagina
require_once "controller/plantilla.controller.php";
require_once "controller/users.controller.php";
require_once "controller/client.controller.php";
require_once "controller/sales.controller.php";
require_once "controller/products.controller.php";
require_once "controller/categories.controller.php";

// modelo de cada vista de la pagina
require_once "model/users.model.php";
require_once "model/categories.model.php";
require_once "model/client.model.php";
require_once "model/sales.model.php";
require_once "model/products.model.php";

$plantilla = new ControllerPlantilla();
$plantilla -> ctrPlantilla();

?>