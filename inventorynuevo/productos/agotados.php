<?php
   include "conexion.php";
    $consulta="select * from tbl_productos_agotados";
    $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
?>
<div class="ui container">
<br>
   <h1>Productos agotados</h1>
   <br>
                  <table class="ui red table">
                     <thead>
                         <tr>
                           <th>Código producto</th>
                           <th>Nombre producto</th>
                           <th>Descripción</th>
                           <th>Fecha</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php while ($columna=mysqli_fetch_array($resultado)){ ?>
                        <tr>
                           <td><?php echo $columna['cod_producto']; ?></td>
                           <td><?php echo $columna['nombre_pd']; ?></td>
                           <td><?php echo $columna['descripcion_pd_a']; ?></td>
                           <td><?php echo $columna['fecha_ag']; ?></td>
                        </tr>
                  <?php }
                    mysqli_close($conexion);
                    ?>
                     </tbody>
                 </table>
                 <br>
</div>