<?php


require_once "conexion.php";

class ModeloFormularios{

    //Registro
//registro metodo estatico publico 
// parametros en las funciones sirven para enviar funciones de un archivo a otro ($tabla, $datos)
// $tabla = nombre de la tabla / $datos 0 los datos que quiero almacenar 
    static public function mdlRegistro ($tabla, $datos){

// prepare() prepara una sentencia SQL para ser ejecutada por el método
// PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores
// de parámetros con nombre o signos de interrogación (?) por los cuales los
// valores reales serán sustituidos cuando la sentencia sea ejecutada.
// Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar
// manualmente los parámetros.

// $stmt = declaracion    
// statement                            no es necesario poner el nombre de la tabla
$stmt = conexion:: conectar()-> prepare("INSERT INTO $tabla(token, usuario, email, contrasenia) VALUES 
#parametros ocultos agregando los: a los mismos nombres de las columnas 

(:token, :usuario, :email, :contrasenia)");

#funcion bindParam()vincula una variable de PHP a un parámetro de sustitución con nombre
// o de signo de interrogación correspondiente de la sentencia SQL que fue usada
// para preparar la sentencia.
$stmt-> bindParam(":token",$datos["token"],PDO::PARAM_STR);
$stmt-> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
$stmt-> bindParam(":email",$datos["email"],PDO::PARAM_STR);
$stmt-> bindParam(":contrasenia",$datos["contrasenia"],PDO::PARAM_STR);

 if($stmt->execute()){

    return "ok";

 }else{


    print_r(conexion::conectar()->errorinfo());

 }
//cerrar cualquiero conexion 
 $stmt->close();
//vaciar objeto
$stmt->null;


}

 //selecionar Registros

 static public function mdlSelecionarRegistros($tabla, $item, $valor){
    if($item == null && $valor ==null){

                                                                 //formato fecha DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS fecha_registro
   $stmt = conexion:: conectar()-> prepare("SELECT *,DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS fecha_registro 
   FROM $tabla ORDER BY id_usuario DESC"); 
   //ordernar los id DESC y si quiero asendente ASC
   $stmt->execute();

   return $stmt -> fetchAll();

    }else{
         $stmt = conexion:: conectar()-> prepare("SELECT *,DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS fecha_registro 
   FROM $tabla WHERE $item = :$item ORDER BY id_usuario DESC"); 
   //ordernar los id DESC y si quiero asendente ASC
   $stmt-> bindParam(":".$item,$valor,PDO::PARAM_STR);
   $stmt->execute();


   return $stmt -> fetch();



    }
   
   //cerrar cualquiero conexion 
   $stmt->close();
    //vaciar objeto
    $stmt->null;

 }
//ACTUALIZAR
  static public function mdlActualizarRegistro ($tabla, $datos){


                         
$stmt = conexion:: conectar()-> prepare("UPDATE $tabla SET 
usuario =:usuario,email=:email,contrasenia=:contrasenia WHERE token=:token");


$stmt-> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
$stmt-> bindParam(":email",$datos["email"],PDO::PARAM_STR);
$stmt-> bindParam(":contrasenia",$datos["contrasenia"],PDO::PARAM_STR);
$stmt-> bindParam(":token",$datos["token"],PDO::PARAM_STR);
 if($stmt->execute()){

    return "ok";

 }else{


    print_r(conexion::conectar()->errorinfo());

 }
//cerrar cualquiero conexion 
 $stmt->close();
//vaciar objeto
$stmt->null;


}

//ELIMINAR REGISTRO


 static public function mdlEliminarRegistro ($tabla, $valor){


                         
$stmt = conexion:: conectar()-> prepare("DELETE FROM $tabla WHERE token = :token");



$stmt-> bindParam(":token", $valor,PDO::PARAM_STR);
 if($stmt->execute()){

    return "ok";

 }else{


    print_r(conexion::conectar()->errorinfo());

 }
//cerrar cualquiero conexion 
 $stmt->close();
//vaciar objeto
$stmt->null;


}
//ACTUALIZAR INTENTOS FALLIDOS
 static public function mdlActualizarIntentosFallidos ($tabla, $valor, $token){


                         
$stmt = conexion:: conectar()-> prepare("UPDATE $tabla SET 
intentos_fallidos =:intentos_fallidos WHERE token=:token");



$stmt-> bindParam(":intentos_fallidos",$valor,PDO::PARAM_INT);
$stmt-> bindParam(":token",$token,PDO::PARAM_STR);
 if($stmt->execute()){

    return "ok";

 }else{


    print_r(conexion::conectar()->errorinfo());

 }
//cerrar cualquiero conexion 
 $stmt->close();
//vaciar objeto
$stmt->null;



}
}