<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<div class="ui container">
<br>
    <h1>Devoluciones de productos</h1>
    <br>
    <div class="modals">
                     <button class="ui button" id="btn_devoluciones"><label for="btn-modal_dev">REGISTRAR DEVOLUCIÓN</label></button> 
                     <input type="checkbox" id="btn-modal_dev">
                     <div class="container-modal-devoluciones">
                        <div class="content-modal-devoluciones">
                           <a href="" class="equis"><i class="close icon"></i></a>
                           <h2>Devolución de productos</h2>
                           <br>
                           <form class="ui fluid form" action="" method="POST">
                              <div class="field">
                                 <label for="">Producto</label>
                                 <input type="text" placeholder="Seleccione el producto">
                              </div>
                              <div class="two fields">
                                  <div class="field">
                                    <label for="">Motivo devolución</label>
                                    <input type="text" name="motivo_dev" placeholder="Por qué devuelve el producto?" required>
                                  </div>
                              <div class="field">
                                    <label for="">Cantidad</label>
                                    <input type="number" name="cant_producto" placeholder="Ingrese el número de unidades">
                                  </div>
                              </div>
                              <br>
                              <input type="submit" name="" class="ui green button" value="Guardar">
                           </form>
                              
                        </div>
                           <label for="btn-modal_dev" class="cerrar-modal-devoluciones"></label>
                     </div>
                  </div>
                  <table class="ui red table">
                     <thead>
                        <tr>
                           <th>Fecha devolución</th>
                           <th>Motivo devolución</th>
                           <th>Producto</th>
                           <th>Cantidad producto</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>2023-09-16 15:15:04</td>
                           <td>Se rompió el empaque</td>
                           <td>Ripio</td>
                           <td>10</td>
                        </tr>
                     </tbody>
                 </table>
</div>
<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>