<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/formularios.controlador.php";

require_once "modelos/formularios.modelo.php";

//require_once "modelos/conexion.php";
//$conexion = Conexion::conectar();
//echo '<pre>'; print_r($conexion); echo '</pre>';


$plantilla = new ControladorPlantilla();


$plantilla -> ctrTraerPlantilla();