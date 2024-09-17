<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<div class="ui container">
    <br>
    <h1>Formulario de registro de pedidos</h1>
    <br>
    <div class="content">
               <form class="ui fluid form" action="#" method="POST">
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
                  <div>
                     <button class="ui green button" id="agregar">Agregar línea</button>
                  </div>
                  <br>
                  <input class="ui yellow button" type="submit" value="Crear pedido">
               </form>
            </div>
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