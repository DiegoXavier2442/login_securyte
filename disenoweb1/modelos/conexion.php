<?php 
class Conexion {
    // metodo estarico publico 
    static public function conectar(){

        //parametos del PDO (nombre del servidor ; nombre de la base de datos: usuario , contrasena )

        $link = new PDO ("mysql:host=localhost;dbname=login", 
        "root", 
        "");

        //funcion exec
        $link ->exec("set names utf8");


        return $link ;


//require_once "modelos/conexion.php";
//$conexion = Conexion::conectar();
//echo '<pre>'; print_r($conexion); echo '</pre>';

    }
}
?>


