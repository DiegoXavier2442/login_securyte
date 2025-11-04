<?php 


class ControladorFormularios{

    //registro


    static public function ctrRegistro() {
    if (isset($_POST["registroNombre"])) {
        //Exprecion regulares que voy a permitir en el campo de registro de esta fotma se define '/^[]+$/'

        // Prevenir ataques xss (CROSS-SITE SCRIPTING) ocurre cuando un atacante es capaz de inyectar un scrip 
        // en el autput de una aplicacion web de forma que se ejecuta en el navegador 
        //preg_match : el simple hecho de usar esta funcion ya nos proteje contra ataques SQL injection  
        //  SQL injection: se produce cuando el atacante intenta inyectar codigo SQL malicioso
        // en la base de datos de la victima, y fuerza a la base de datos a ejecutar esa sentencia
        // Esto sucede si no protegemos la "url" "los formularios" y no protegemos el proceso de subir 
        // informacion a la base de datos 




        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&
        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
        preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroPassword"])){


        $tabla = "usuarios";

        $token = md5 ( $_POST["registroNombre"]."+".$_POST["registroEmail"]);
// propiedades que voy a colocar en este array los titulos con los que quiero que llega a la DB uso los mismos titulos omitiendo los datos automaticos 

            $encriptarPassword = crypt($_POST["registroPassword"],'$6$rounds=xavier$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/'); 
           
            $datos = array( "token" => $token,
                            "usuario" => $_POST["registroNombre"],
                            "email" => $_POST["registroEmail"],
                            "contrasenia" => $encriptarPassword);




            $respuesta = ModeloFormularios::mdlRegistro($tabla,  $datos);

            return $respuesta;

            // esos datos los paso instanciando el metodo estatico del modelo 

            }else{
                $respuesta ="error";
                return $respuesta;



            }
        }

    }

    //selecionar Registros

    static public function ctrSelecionarRegistros($item,$valor){
//parametro del la tabla 
    $tabla = "usuarios";

    $respuesta = ModeloFormularios::mdlSelecionarRegistros($tabla, $item,$valor);

    return $respuesta;

}
 //selecionar Ingreso

 public function ctrIngreso(){
    if(isset($_POST["ingresoEmail"])) {

        $tabla = "usuarios";
        $item = "email";
        $valor = $_POST["ingresoEmail"];

        $respuesta = ModeloFormularios::mdlSelecionarRegistros($tabla, $item, $valor);
         $encriptarPassword = crypt($_POST["ingresoPassword"],'$6$rounds=xavier$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/'); 
           
        //emali incorrecto
         if (!$respuesta) {
            echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                  </script>';
            echo '<div class="alert alert-danger">El email no coincide.</div>';
            return;
        }

       if (
    $respuesta
    && isset($respuesta["email"], $respuesta["contrasenia"])
    && $respuesta["email"] === $_POST["ingresoEmail"]
    && $respuesta["contrasenia"] === $encriptarPassword
) {
      ModeloFormularios::mdlActualizarIntentosFallidos ($tabla, 0,$respuesta["token"]);
   $_SESSION["validarIngreso"]= "ok";
     echo '<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    window.location = "index.php?pagina=inicio";
    </script>';

 

  echo'<div class = "alert alert-danger"> Error al ingresar al sistema, el email o contraseña no coincide </div>';

}else {

    if($respuesta["intentos_fallidos"]<3){
    $tabla = "usuarios";

    $intentos_fallidos = $respuesta["intentos_fallidos"]+1;
    $actualizarIntentosFallidos = ModeloFormularios::mdlActualizarIntentosFallidos ($tabla, $intentos_fallidos,$respuesta["token"]);
}else{

     echo'<div class = "alert alert-warning"> RECPCHA Debes validar que no eres un robot</div>';





}
             echo '<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>';

  

  echo'<div class = "alert alert-danger"> Error al ingresar al sistema, el email o contraseña no coincide </div>';




        }

    }


    }

// ACTUALIZAR REGISTRO

static public function  ctrActualizarRegistro (){

     if (isset($_POST["actualizarNombre"])) {

        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarNombre"]) &&
        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["actualizarEmail"]) ){


        $usuario = ModeloFormularios::mdlSelecionarRegistros("usuarios", "token",$_POST["tokenUsuario"]);
         
         $compararToken = md5 ( $usuario["usuario"]."+".$usuario["email"]);

         if ($compararToken==$_POST["tokenUsuario"]){

        if($_POST["actualizarPassword"]!=""){
            
        if (preg_match('/^[0-9a-zA-Z]+$/', $_POST["actualizarPassword"])){

            $password = crypt($_POST["actualizarPassword"],'$6$rounds=xavier$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/'); 
          
           
        }
        }else{
            $password = $_POST["passwordActual"];

        }
        $tabla = "usuarios";
// propiedades que voy a colocar en este array los titulos con los que quiero que llega a la DB uso los mismos titulos omitiendo los datos automaticos 

            $datos = array(
                            "token"  => $_POST["tokenUsuario"],
                            "usuario" => $_POST["actualizarNombre"],
                            "email" => $_POST["actualizarEmail"],
                            "contrasenia" => $password);



 
            $respuesta = ModeloFormularios::mdlActualizarRegistro($tabla,  $datos);

            return $respuesta;
        }else{
            $respuesta="error";
            return $respuesta;
        }
         }else{
            $respuesta="error";
            return $respuesta;
        }

            if($respuesta=="ok"){
                 echo '<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>';

  

  echo'<div class = "alert alert-success"> El usuario ha sido Actualizado</div>
  
  <script>

  setTimeout(function(){

  window.location = "index.php?pagina=inicio";
  
            },3000);
  
  
  </script>
  ';



            }

           


        }

}

public function ctrEliminarRegistro (){

if (isset($_POST["eliminarRegistro"])) {

    $usuario = ModeloFormularios::mdlSelecionarRegistros("usuarios", "token",$_POST["eliminarRegistro"]);
         
         $compararToken = md5 ( $usuario["usuario"]."+".$usuario["email"]);

         if ($compararToken==$_POST["eliminarRegistro"]){

    $tabla="usuarios";
    $valor = $_POST["eliminarRegistro"];

    $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla,  $valor);


 if ($respuesta=="ok");{
     echo '<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    window.location = "index.php?pagina=inicio";
    </script>';

 

  echo'<div class = "alert alert-danger"> Error al ingresar al sistema, el email o contraseña no coincide </div>';




 }


}





 }

}

}