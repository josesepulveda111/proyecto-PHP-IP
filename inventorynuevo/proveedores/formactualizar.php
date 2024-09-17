<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$rutnit=$_GET['id'];
$consulta="SELECT * FROM tbl_proveedores WHERE rut_nit_pv='$rutnit'";
$ejecutarconsulta=mysqli_query($conexion,$consulta);
$resultado=mysqli_fetch_array($ejecutarconsulta);
?>
<div class="ui container">
<br>
<h1>Formulario de actualización de proveedores</h1>
<br>
<form class="ui fluid form formulario" action="proveedores/actualizarp.php" method="POST" id="formulario">
                     <div class="field" id="grupo_rutnit">
                        <label for=""class="grupo_label">RUT O NIT</label>
                        <input class="grupo_input" type="number" name="rutnit" placeholder="Ingrese el RUT o NIT" value="<?php echo $resultado['rut_nit_pv']; ?>" required>
                        <p class="error">El RUT o NIT debe tener sólo números (6 dígitos)</p>
                        <input type="hidden" name="proveedor" value="<?php echo $resultado['rut_nit_pv']; ?>">
                     </div>
                     <div class="two fields">
                        <div class="field" id="grupo_nombre">
                           <label for=""class="grupo_label">Nombre proveedor</label>
                           <input class="grupo_input" id="nombre" type="text" name="nombre_pv" placeholder="Ingrese el nombre o razón social del proveedor" value="<?php echo $resultado['nombre_pv']; ?>" required>
                           <p class="error">El nombre no puede tener carácteres especiales, ni números</p>
                        </div>
                        <div class="field">
                           <label for="">Dirección</label>
                           <input type="text"  name="direccion_pv" placeholder="Ingrese la dirección dónde se encuentra ubicado el proveedor" value="<?php echo $resultado['direccion_pv']; ?>" required>
                        </div>
                     </div>
                     <div class="two fields">
                        <div class="field" id="grupo_correo">
                           <label for=""class="grupo_label">Correo electrónico</label>
                           <input class="grupo_input" id="correo" type="text" name="correo_pv" placeholder="Ingrese el correo electrónico de contacto del proveedor" value="<?php echo $resultado['correo_pv']; ?>" required>
                           <p class="error">Ingrese un correo válido</p>
                        </div>
                        <div class="field" id="grupo_telefono">
                           <label for=""class="grupo_label">Teléfono</label>
                           <input class="grupo_input" id="telefono" type="number" name="telefono_pv" placeholder="Ingrese el número de contacto del proveedor" value="<?php echo $resultado['telefono_pv']; ?>" required>
                           <p class="error">Ingrese un teléfono válido</p>
                        </div>
                     </div>
                     <br>
                     <input type="submit" name="btn_actualizar" class="ui yellow button" value="ACTUALIZAR PROVEEDOR">
</form>
</div>

<script src="validaciones/validar_proveedores.js"></script>
<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>