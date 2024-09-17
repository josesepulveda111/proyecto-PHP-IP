<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>
<div class="ui container">
<br>
    <h1>Formulario de registro de salidas</h1>
    <br>
    <div class="modals">
                    <button class="ui button" id="btn_salida"><label for="btn-modal_salida">REGISTRAR SALIDA</label></button> 
                     <input type="checkbox" id="btn-modal_salida">
                     <div class="container-modal-salida">
                        <div class="content-modal-salida">
                           <a href="" class="equis"><i class="close icon"></i></a>
                           <h2>REALIZAR SALIDA</h2>
                           <br>
                           <form class="ui fluid form" action="" method="POST">
                              <div id="inputs-container">
                                 <div class="field">
                                    <label for="">Supermercado</label>
                                    <input type="text" name="" placeholder="Seleccione el supermercado" required>
                                 </div>
      
                                 <div class=" two fields clonado">
                                    <div class="field">
                                       <label for="">Nombre del producto</label>
                                       <input type="text" name="" placeholder="Ingresar producto" required>
                                    </div>
                                    <div class="field">
                                       <label for="">Cantidad</label>
                                       <input type="number" name="" placeholder="Ingrese la cantidad">
                                    </div>
                                 </div>
                              </div>
                              <div class="btn-cerrar-salida">
                                 <input type="submit" name="" class="ui green button" value="Guardar">
                                 <input type="submit" id="cancelar" class="ui red button" value="Cancelar">
                              </div>
                           </form>
                           <div>
                              <button class="ui green button" id="agregar">Agregar</button>
                           </div>
                        </div>
                           <label for="btn-modal_salida" class="cerrar-modal-salida"></label>
                     </div>
                  </div>
    <table class="ui red table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total salida</th>
                <th>Supermercado</th>
                <th>Detalle salida</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>15/09/2023</td>
                <td>$1'230.000</td>
                <td>La 80</td>
                <td><a href="#"><i class='bx bxs-file-blank icon'></i></a></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
  const cloneButton = document.getElementById('agregar');
  const inputsContainer = document.getElementById('inputs-container');

  cloneButton.addEventListener('click', function() {
    const originalInputGroup = document.querySelector('.clonado');
    const clone = originalInputGroup.cloneNode(true);

    const deleteButton = document.createElement('a');
    deleteButton.innerHTML = '<a href="#"><i class="trash icon"></i></a>';
    deleteButton.classList.add('delete-btn');
    deleteButton.addEventListener('click', function() {
      inputsContainer.removeChild(clone);
    });

    clone.appendChild(deleteButton);
    inputsContainer.appendChild(clone);
  });

  // Para eliminar los inputs clonados existentes
  inputsContainer.addEventListener('click', function(event) {
    if (event.target.classList.contains('delete-btn')) {
      inputsContainer.removeChild(event.target.parentElement);
    }
  });
});
</script>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>