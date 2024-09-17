<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<div class="ui container">
    <br>
    <h1>Formulario de registro de supermercados</h1>
    <br>
    <form class="ui fluid form formulario" action="supermercados/registrar.php" method="POST" id="formulario">
                        <div class="field">
                           <div class="field" id="grupo_rut_nit">
                              <label for="" class="grupo_label">RUT O NIT DEL SUPERMERCADO</label>
                              <input id="rut_nit" class="grupo_input" type="text" name="rut_nit"
                                 placeholder="Ingrese el número del documento" required>
                              <p class="error">El RUT o NIT debe tener sólo números (6 dígitos)</p>
                           </div>
                        </div>
                        <div class="two fields">
                           <div class="field" id="grupo_nombre">
                              <label for="" class="grupo_label">Nombre</label>
                              <input id="nombre" class="grupo_input" type="text" name="nombre"
                                 placeholder="Ingrese la razón social o nombre del supermercado" required>
                              <p class="error">El nombre no puede tener carácteres especiales, ni números</p>
                           </div>
                           <div class="field" id="grupo_direccion">
                              <label for="" class="grupo_label">Dirección</label>
                              <input id="direccion" class="grupo_input" type="text" name="direccion"
                                 placeholder="Ingrese dónde se encuentra ubicado el supermercado" required>
                           </div>
                        </div>
                        <div class="two fields">
                           <div class="field" id="grupo_correo">
                              <label for="" class="grupo_label">Correo</label>
                              <input id="correo" class="grupo_input" type="text" name="correo"
                                 placeholder="Ingrese el email de contacto del supermercado" required>
                              <p class="error">Ingrese un correo válido</p>
                           </div>
                           <div class="field" id="grupo_telefono">
                              <label for="" class="grupo_label">Teléfono</label>
                              <input id="telefono" class="grupo_input" type="text" name="telefono"
                                 placeholder="Ingrese el número de contacto del supermercado" required>
                              <p class="error">Ingrese un teléfono válido</p>
                           </div>
                        </div>
                        <input type="submit" onclick="guardarDatos()" name="guardar_super" class="ui green button"
                           value="GUARDAR">
                        <input type="button" onclick="recuperarDatos()" class="ui yellow button"
                           value="RECUPERAR DATOS">
                        <input type="reset" class="ui red button"
                           value="BORRAR DATOS">
                  </div>
                  </form>
</div>

<script src="validaciones/crearsupermercado.js"></script>
   <script>
      function guardarDatos() {
         localStorage.rutnit = document.getElementById("rut_nit").value;
         localStorage.nombre = document.getElementById("nombre").value;
         localStorage.direccion = document.getElementById("direccion").value;
         localStorage.correo = document.getElementById("correo").value;
         localStorage.telefono = document.getElementById("telefono").value;
      }
      function recuperarDatos() {
         document.getElementById("rut_nit").value = localStorage.rutnit;
         document.getElementById("nombre").value = localStorage.nombre;
         document.getElementById("direccion").value = localStorage.direccion;
         document.getElementById("correo").value = localStorage.correo;
         document.getElementById("telefono").value = localStorage.telefono;
      }
   </script>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>