<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4eaa38587a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">

    <h3 class="text-center py-3">LOGO</h3>

</div>

<!--=====================================
BOTONERA GET 
======================================-->

<div class="container-fluid  bg-light">

    <div class="container">

        <ul class="nav nav-justified py-2 nav-pills">

        <?php if (isset($_GET["pagina"])): ?>

           <?php if ($_GET["pagina"] == "registro"): ?>

            <li class="nav-item">
               <a class="nav-link active" href="index.php?pagina=registro">Registro</a>
            </li>

            <?php else: ?>

             <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=registro">Registro</a>
            </li>

            <?php endif ?>

           <!-- // ingreso boton -->
            <?php if ($_GET["pagina"] == "ingreso"): ?>

            <li class="nav-item">
               <a class="nav-link active" href="index.php?pagina=ingreso">Ingreso</a>
            </li>

            <?php else: ?>

             <li class="nav-item">
                <a class="nav-link" href="index.php?pagina=ingreso">Ingreso</a>
            </li>

            <?php endif ?>

            

           <?php if ($_GET["pagina"] == "inicio"): ?>

            <li class="nav-item">
             <a class="nav-link active" href="index.php?pagina=inicio">Inicio</a>
            </li>
            <?php else: ?>
             <li class="nav-item">
             <a class="nav-link" href="index.php?pagina=inicio">Inicio</a>
            </li>

            <?php endif ?>

            

           <?php if ($_GET["pagina"] == "salir"): ?>

            <li class="nav-item">
             <a class="nav-link active" href="index.php?pagina=salir">Salir</a>
            </li>
            <?php else: ?>
             <li class="nav-item">
             <a class="nav-link" href="index.php?pagina=salir">Salir</a>
            </li>





            <?php endif ?>

            <?php else: ?>
            <li class="nav-item">
            <a class="nav-link active " href="index.php?pagina=registro">Registro</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=ingreso">Ingreso</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="index.php?pagina=inicio">Inicio</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="index.php?pagina=salir">Salir</a>
            </li>



            <?php endif ?>

          

        </ul>

    </div>

</div>

</div>
<div class="container-fluid ">

    <div class="container py-5">

<?php 
// lista blanca y pagina 404= son aquellas paginas que permito pasar a traves de una url 
// ATAQUE DE INYECCION SQL A TRAVES DE URL 
if (isset($_GET["pagina"])){
    if($_GET["pagina"]=="registro" ||
     $_GET["pagina"]=="ingreso" ||
    $_GET["pagina"]=="inicio"||
    $_GET["pagina"]=="salir"){


   include "paginas/". $_GET["pagina"].".php";

    }else{
        include "paginas/error404.php";

    }


}else{
    include "paginas/registro.php";

}


?>

</div>

</div>


    
</body>
</html>