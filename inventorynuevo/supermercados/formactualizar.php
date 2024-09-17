<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$rut_nit = $_GET['id'];
$consulta = "SELECT * from tbl_supermercados WHERE rut_nit_cli = '$rut_nit'";
$ejecutarconsulta = mysqli_query($conexion, $consulta);
$resultado = mysqli_fetch_array($ejecutarconsulta);
?>
<div class="ui container">
    <br>
    <h1>Formulario de actualización de supermercados</h1>
    <br>
    <form class="ui fluid form formulario" action="supermercados/actualizarsp.php" method="POST" id="formulario">
                                <div class="field">
                                    <div class="field">
                                        <label for="">RUT O NIT DEL SUPERMERCADO</label>
                                        <input type="text" name="rut_nit" placeholder="Ingrese el número del documento"
                                            value="<?php echo $resultado['rut_nit_cli']; ?>" required>
                                    </div>
                                    <div class="field">
                                        <input type="hidden" name="rutnit"
                                            value="<?php echo $resultado['rut_nit_cli']; ?>">
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label for="">Nombre</label>
                                        <input type="text" name="nombre"
                                            placeholder="Ingrese la razón social o nombre del supermercado"
                                            value="<?php echo $resultado['nombre_cli']; ?>" required>
                                    </div>
                                    <div class="field">
                                        <label for="">Dirección</label>
                                        <input type="text" name="direccion"
                                            placeholder="Ingrese dónde se encuentra ubicado el supermercado"
                                            value="<?php echo $resultado['direccion_cli']; ?>">
                                    </div>
                                </div>
                                <div class="two fields">
                                    <div class="field">
                                        <label for="">Correo</label>
                                        <input type="text" name="correo"
                                            placeholder="Ingrese el email de contacto del supermercado"
                                            value="<?php echo $resultado['correo_cli']; ?>">
                                    </div>
                                    <div class="field">
                                        <label for="">Teléfono</label>
                                        <input type="text" name="telefono"
                                            placeholder="Ingrese el número de contacto del supermercado"
                                            value="<?php echo $resultado['telefono_cli']; ?>">
                                    </div>
                                </div>
                                <input type="submit" name="btn_actualizar" class="ui yellow button"
                                    value="Guardar">
                        </div>
                        </form>
    <br>
</div>
<script src="validaciones/crearsupermercado.js"></script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>