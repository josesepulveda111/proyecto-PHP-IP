<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<div class="ui container">
    <br>
    <h1>Pedidos registrados</h1>
    <br>
<div class="modals">
                        <button class="ui button" id="btn_pedi"><label for="btn-modal">Pedidos completados</label></button>
                        <input type="checkbox" id="btn-modal">
                        <button class="ui button" id="btn_pedi_p"><label for="btn-modal_salida">Pedidos por completar</label></button> 
                         <input type="checkbox" id="btn-modal_salida">
                      </div>
                  <table class="ui red table">
                     <thead>
                         <tr>
                           <th>Fecha</th>
                           <th>Detalle pedido</th>
                           <th>Proveedor</th>
                           <th colspan="3">Acciones</th>
                         </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>22/08/2023</td>
                           <td><a href="#"><i class="file alternate icon"></i></a></td>
                           <td>Rikipan</td>
                           <td><a href="#" id="icon"><i class="edit icon"></i>Editar</a></td>
                           <td><a href="#" id="icon"><i class="trash alternate icon"></i>Cancelar</a></td>
                           <td><a href="#" id="icon"><i class="check icon"></i>Confirmar</a></td>
                         </tr>
                     </tbody>
                 </table>
</div>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>