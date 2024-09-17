<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<div class="ui container">
<br>
<h1>Formulario de registro de proveedores</h1>
<br>
<form class="ui fluid form formulario" action="proveedores/registrar.php" method="POST" id="formulario">
                  <div class="field" id="grupo_rutnit">
                     <label for="" class="grupo_label">RUT O NIT</label>
                     <input class="grupo_input" id="rutnit" type="number" name="rutnit" placeholder="Ingrese el RUT o NIT" required>
                     <p class="error">El RUT o NIT debe tener sólo números (6 dígitos)</p>
                  </div>
                  <div class="two fields">
                     <div class="field" id="grupo_nombre">
                        <label for="" class="grupo_label">Nombre proveedor</label>
                        <input class="grupo_input" id="nombre" type="text" name="nombre_pv" placeholder="Ingrese el nombre o razón social del proveedor" required>
                        <p class="error">El nombre no puede tener carácteres especiales, ni números</p>
                     </div>
                     <div class="field">
                        <label for="">Dirección</label>
                        <input type="text" name="direccion_pv" placeholder="Ingrese la dirección dónde se encuentra ubicado el proveedor" required>
                     </div>
                  </div>
                  <div class="two fields">
                     <div class="field" id="grupo_correo">
                        <label for="" class="grupo_label">Correo electrónico</label>
                        <input class="grupo_input" id="correo" type="text" name="correo_pv" placeholder="Ingrese el correo electrónico de contacto del proveedor" required>
                        <p class="error">Ingrese un correo válido</p>
                     </div>
                     <div class="field" id="grupo_telefono">
                        <label for="" class="grupo_label">Teléfono</label>
                        <input class="grupo_input" id="telefono" type="number" name="telefono_pv" placeholder="Ingrese el número de contacto del proveedor" required>
                        <p class="error">Ingrese un teléfono válido</p>
                     </div>
                  </div>
                  <br>
                  <input type="submit" name="btn_insertar" class="ui yellow button" value="Registrar proveedor">
               </form>
</div>
<script src="validaciones/validar_proveedores.js"></script>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>