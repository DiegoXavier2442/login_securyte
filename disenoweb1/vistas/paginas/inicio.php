<?php
// objeto que le hace una peticion al controlador 
$usuarios = ControladorFormularios::ctrSelecionarRegistros();

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
          <button class="btn btn-warning">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-danger">
            <i class="fas fa-trash-alt"></i>
          </button>
        </div>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
