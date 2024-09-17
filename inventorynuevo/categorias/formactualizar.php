<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$id_categoria=$_GET['id'];
$consulta="SELECT * FROM tbl_categoria_pd WHERE id_categoria=$id_categoria";
$ejecutarconsulta=mysqli_query($conexion,$consulta);
$resultado=mysqli_fetch_array($ejecutarconsulta);
?>
<div class="ui container">
   <br>
   <h1>Formulario de actualización de categoría</h1>
   <br>
               <div class="content">
                  <form class="ui fluid form formulario" action="categorias/actualizarc.php" method="POST" id="formulario">
                     <div class="field" id="grupo_nombre">
                        <label for="" class="grupo_label">Nombre categoría</label>
                        <input class="grupo_input" id="nombre" type="text" name="nombre_ct" value="<?php echo $resultado['nombre_ct']; ?>">
                        <p class="error">El nombre no puede tener caracteres especiales ni numeros</p>
                     </div>
                     <input type="hidden" name="nombre" value="<?php echo $resultado['nombre_ct']; ?>">
                     <input type="hidden" name="id_categoria" value="<?php echo $resultado['id_categoria']; ?>">
                     <div class="field">
                        <label for="">Descripción categoría</label>
                        <textarea name="descrip_ct" id="" cols="" rows=""><?php echo $resultado['descrip_ct']; ?></textarea>
                     </div>
                     <br>
                     <input class="ui yellow button registrar col-md-3 col-sm-12 col-lg-3 col-xs-12" type="submit" name="btn_actualizar" value="ACTUALIZAR CATEGORÍA">
                  </form>
            </div>
</div>
            <?php mysqli_close($conexion); ?>

<script src="validaciones/validar_categoria.js"></script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>