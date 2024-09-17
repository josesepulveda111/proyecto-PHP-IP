<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>

<?php
include "conexion.php";
    $consulta="select * from tbl_categoria_pd where estado_ct='Activo' order by id_categoria asc";
    $resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");
?>
<div class="ui container">
<br>
    <h1>Categorías de productos</h1>
    <br>
    <div class="content" id="modulo">
                <div class="">
                    <button class="ui button" id="btn_categoria"><label for="btn-modal">Ingresar categoria</label></button>
                    <input type="checkbox" id="btn-modal">
                    <div class="container-modal">
                          <div class="content-modal">
                             <a href="" class="equis"><i class="close icon"></i></a>
                             <h2>Formulario de registro de categoria de productos</h2>
                             <br>
                             <form class="ui fluid form formulario" action="categorias/insertarc.php" method="POST"
                                 id="formulario">
                                 <div class="field" id="grupo_nombre">
                                    <label for="" class="grupo_label">Nombre de la categoría</label>
                                    <input class="grupo_input" id="nombre" type="text" name="nombre_ct"
                                       placeholder="Ingresar el nombre que va a recibir la categoría" required>
                                    <p class="error">El nombre no puede tener carácteres especiales, ni números</p>
                                 </div>
                                 <div class="field">
                                    <label for="">Descripción del producto</label>
                                    <textarea name="descrip_ct" class="ui input"
                                       placeholder="Escribe aquí una breve descripción de la categoría" rows="1" required></textarea>
                                 </div>
                                 <br>
                                 <input type="submit" name="btn_insertar" class="ui green button" value="Guardar">
                              </form>
                           </div>
                           <label for="btn-modal" class="cerrar-modal"></label>
                    </div> 
                </div>
                  <table class="ui red table">
                     <thead>
                         <tr>
                           <th>Nombre categoria</th>
                           <th>Descripción</th>
                           <th class="cols" colspan="2">Acciones</th>
                         </tr>
                     </thead>
                     <?php while ($columna=mysqli_fetch_array($resultado)){ ?>
                     <tbody>
                        <tr>
                           <td><?php echo $columna['nombre_ct'];?></td>
                           <td><?php echo $columna['descrip_ct'];?></td>
                           <td><a name="btn_actualizar" id="icon" href="menu.php?mod=actualizarcategoria&id=<?php echo $columna['id_categoria'];?>"><i class="bx bx-edit icon"></i>ACTUALIZAR</a></td>
                           <td><a name="btn_eliminar" id="icon" onclick="borrar('<?php echo $columna['id_categoria'];?>')" href="#"><i class="bx bx-trash icon"></i>BORRAR</a></td>
                        </tr>
                        <?php }
                        mysqli_close($conexion);
                        ?>
                     </tbody>
                 </table>
                 <br>

<script src="validaciones/validar_categoria.js"></script>
<script src="js/sweetalert2@11.js"></script>
<!-- <script src="js/jquery-3.7.1.min.js"></script> -->
<script>
      //   function borrar(id){
      //       respuesta=confirm("Está seguro de que desea borrar esta categoría?");
      //       if (respuesta){ // SI ES TRUE, ENTRA, DE LO CONTRARIO NO
      //           window.location="categorias/eliminar.php?id="+id;
      //       }
      //   }

      function borrar(codigo) {
         Swal.fire({
            title: "Desea inhabilitar la categoría",
            text: "La categoría pasará a ser inactiva",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButton: true,
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, seguro",
            cancelButtonText: "Cancelar"
         }).then((result) => {
            if (result.isConfirmed) {
               mandar_php(codigo)
            }
         });
      }

   function mandar_php(codigo) {
      parametros={ id: codigo };
       $.ajax({
         data: parametros,
         url: "categorias/eliminar.php",
         type: "GET",
         beforeSend: function () {},
         success: function () {
            Swal.fire("Categoría eliminada", "La categoría pasará a estar inactiva", "success")
            .then((result) => {
               window.location.href = "menu.php?mod=registrarcategoria"
            })
         }
      })
   }
</script>

<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>