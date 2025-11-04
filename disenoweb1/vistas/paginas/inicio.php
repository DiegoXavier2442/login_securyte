<?php

if(!isset($_SESSION["validarIngreso"])){
echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;



}else{
  
    if($_SESSION["validarIngreso"] != "ok") {


    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
    }

}

// objeto que le hace una peticion al controlador 
$usuarios = ControladorFormularios::ctrSelecionarRegistros(null,null);

 

?>


<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach ($usuarios as $key => $value ):
      // $key = viene siendo el numero de indice  al que pertenece el valor del arry $usuarios
      // se suma +1 por que los arry inician desde cero  ?>
    <tr>
      <th><?php echo ($key+1);?></th>
      <td><?php echo $value["usuario"];?></td>
      <td><?php echo $value["email"];?></td>
      <td><?php echo $value["fecha_registro"];?></td>
      <td>
        <div class="btn-group">
          <div class ="px-1">
          <a href="index.php?pagina=editar&token=<?php echo $value["token"];?>"class="btn btn-warning">
            <i class="fas fa-pencil-alt"></i>
          </a>
          </div>
          <form method ="post">

          <input type="hidden" value="<?php echo $value["token"];?>" name ="eliminarRegistro">


          <button type = "submit " class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
          </button>
          <?php

          $eliminar = new ControladorFormularios();
          $eliminar -> ctrEliminarRegistro();


          
          
          
          ?>

          </form>
          
        </div>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
