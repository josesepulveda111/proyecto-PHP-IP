<?php
   if(basename($_SERVER['PHP_SELF'])=="menu.php"){
?>
      <div class="ui container">
   <br>
   <h1>Formulario de registro de productos</h1>
   <br>
      <form class="ui fluid form formulario" action="productos/registrar.php" method="POST" id="formulario">
         <div class="field" id="grupo_codigo">
            <label for="" class="grupo_label" id="label">Código de barras</label>
               <input id="codigo" class="grupo_input" type="number" name="cod_producto" placeholder="Escriba aquí el código de barras" required>
               <p class="error">El código de barras debe contener sólo números (5 dígitos)</p>
         </div>
         <div class="field" id="grupo_nombre">
            <label for="" class="grupo_label" id="label">Nombre del producto</label>
            <input id="nombre" class="grupo_input" type="text" name="nombre_pd" placeholder="Escribe aquí el nombre del producto" required>
            <p class="error">El nombre del producto no puede tener carácteres especiales ni números</p>
         </div>
         <div class="two fields">
            <div class="field">
               <?php 
               include "conexion.php";
               $categoria="SELECT * FROM tbl_categoria_pd where estado_ct='Activo' ORDER BY id_categoria ASC";
               $select=mysqli_query($conexion, $categoria); 
               ?>
               <label for="">Categoría</label>
               <select class="ui fluid search dropdown texto grupo_input" name="id_categoria" id="categoria" required>
                  <option value="">Categoría producto</option>
                     <?php while($categoria=mysqli_fetch_array($select)){?>
                     <option value="<?php echo $categoria['id_categoria'];?>"><?php echo $categoria['nombre_ct'];?></option>
                     <?php }?>
                  </select>
            </div>
            <div class="field">
               <?php 
               $proveedor="SELECT * FROM tbl_proveedores where estado_pv='Activo' ORDER BY fecha_creacion_pv ASC";
               $selectp=mysqli_query($conexion, $proveedor); 
               ?>
               <label for="">Proveedor</label>
               <select class="ui fluid search dropdown texto grupo_input" name="rut_nit_pv" id="rut" required>
                  <option value="">Selecciona el proveedor</option>
                  <?php while($select2=mysqli_fetch_array($selectp)){?>
                  <option value="<?php echo $select2['rut_nit_pv'];?>"><?php echo $select2['nombre_pv'];?></option>
                  <?php }?>
               </select>
            </div>
         </div>
         <div class="field">
            <label for="">Descripción del producto</label>
            <textarea name="descrip_pd" class="ui input" placeholder="Escribe aquí una breve descripción del producto" rows="1" id="descrip_pd" required></textarea>
         </div>
         <div class="two fields">
            <div class="field" id="grupo_pc">
               <label class="grupo_label" for="">Precio de compra</label>
               <input type="number" class="grupo_input" placeholder="Ingresa el precio de compra" name="precio_compra" id="precio_compra" required>
               <p class="error">El precio de compra debe ser mayor a 0</p>
            </div>
            <div class="field" id="grupo_venta">
               <label class="grupo_label" for="">Precio de venta</label>
               <input type="number" class="grupo_input" placeholder="Ingresa el precio de venta" name="precio_venta" id="precio_venta" required>  
               <p class="error">El precio de venta no puede ser inferior al precio de compra, ni igual a 0</p>
            </div>
         </div>
         <div class="two fields">
            <div class="field" id="grupo_min">
               <label for="" class="grupo_label">Unidades mínimas</label>
               <input id="unidades_minimas" class="grupo_input" type="number" placeholder="Ingresa las unidades mínimas" name="unidades_minimas" required>
               <p class="error">Las unidades mínimas deben ser mayores a 0</p>
            </div>
            <div class="field" id="grupo_max">
               <label for="" class="grupo_label">Unidades máximas</label>
               <input id="unidades_maximas" class="grupo_input" type="number" placeholder="Ingresa las unidades máximas" name="unidades_maximas" required>
               <p class="error">Las unidades máximas no pueden ser inferiores a las unidades mínimas, ni iguales a 0</p>
            </div>
         </div>
         <div class="field" id="grupo_exi">
            <label for="" class="grupo_label">Unidades existentes</label>
            <input id="unidades_existentes" class="grupo_input" type="number" placeholder="Ingresa las existencias disponibles" name="unidades_existentes" required>
            <p class="error">Las unidades existentes no pueden ser iguales a 0</p>
            <p class="error2">Las unidades existentes no pueden ser mayores a las unidades máximas</p>
         </div>      
         <div class="row">
            <!--boton agregar producto -->
            <input class="ui yellow button registrar" type="submit" name="btn_insertar" value="REGISTRAR PRODUCTO">
            <!--BOTON RECUPERAR DATOS-->
            <input class="ui orange button" type="button" onclick="recuperarDatos()" value="RECUPERAR DATOS">
            <!--BOTON REFRESCAR-->
            <input class="ui red button" type="reset" value="BORRAR DATOS">
         </div>
      </form>
   </div>
<script src="validaciones/crearproducto.js"></script>
<script>

   // Función para recuperar los datos ingresados
   function recuperarDatos() {
      document.getElementById("codigo").value = localStorage.Codigo;
      document.getElementById("nombre").value = localStorage.Nombre;
      document.getElementById("precio_compra").value = localStorage.Precio_compra;
      document.getElementById("precio_venta").value = localStorage.Precio_venta;
      document.getElementById("descrip_pd").value = localStorage.Descripcion;
      document.getElementById("rut").value = localStorage.Rut;
      document.getElementById("categoria").value = localStorage.Categoria;
      document.getElementById("unidades_minimas").value = localStorage.Unidades_minimas;
      document.getElementById("unidades_maximas").value = localStorage.Unidades_maximas;
      document.getElementById("unidades_existentes").value = localStorage.Unidades_existentes;
   }

</script>
<?php   
}else{
   echo "<script>window.location='../menu.php'</script>";
}
?>