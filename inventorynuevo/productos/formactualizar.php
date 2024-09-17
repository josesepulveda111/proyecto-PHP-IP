<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$cod_producto=$_GET['id'];
$consulta="SELECT * FROM tbl_productos WHERE cod_producto='$cod_producto'";
$ejecutarconsulta=mysqli_query($conexion,$consulta);
$resultado=mysqli_fetch_array($ejecutarconsulta);
?>
<div class="ui container">
   <br>
   <h1>Formulario de actualización de productos</h1>
   <br>
   <form class="ui fluid form formulario" action="productos/actualizarp.php" method="POST" id="formulario">
        <div class="field" id="grupo_codigo">
            <label for="" class="grupo_label" id="grupo_label">Código de barras</label>
            <input class="grupo_input" type="number" name="cod_producto" id="codigo" value="<?php echo $resultado['cod_producto']; ?>" required>
            <p class="error">El código de barras debe contener sólo numeros (5 dígitos)</p>
        </div>
        <div class="field">
            <input type="hidden" name="producto" value="<?php echo $resultado['cod_producto']; ?>">
        </div>
        <div class="field" id="grupo_nombre">
            <label class="grupo_label" for="">Nombre del producto</label>
            <input id="nombre" class="grupo input" type="text" name="nombre_pd" value="<?php echo $resultado['nombre_pd']; ?>" required>
            <p class="error">El nombre del producto no puede tener carácteres especiales, ni números</p>
        </div>
        <div class="two fields">
            <div class="field">
                <label for="">Categoría</label>
                <select class="ui fluid dropdown texto" name="id_categoria" id="categoria" required>
                    <?php 
                        $categoria="SELECT id_categoria, nombre_ct FROM tbl_categoria_pd where estado_ct='Activo' ORDER BY id_categoria ASC";
                        $select=mysqli_query($conexion, $categoria);
                        $categ=$resultado['id_categoria']; 
                        while($categoria=mysqli_fetch_array($select)){
                            if($categ==$categoria['id_categoria']){?>
                                <option value="<?php echo $categoria['id_categoria'];?>" selected><?php echo $categoria['nombre_ct'];?></option>
                    <?php   }else{?>
                                <option value="<?php echo $categoria['id_categoria'];?>"><?php echo $categoria['nombre_ct'];?></option>
                    <?php }}?>
                </select>
            </div>
            <div class="field">
                <label for="">Proveedor</label>
                <select class="ui fluid dropdown texto" name="rut_nit_pv" id="rut" required>
                    <?php 
                        $proveedor="SELECT rut_nit_pv, nombre_pv FROM tbl_proveedores where estado_pv='Activo' ORDER BY fecha_creacion_pv ASC";
                        $select2=mysqli_query($conexion, $proveedor);
                        $prov=$resultado['rut_nit_pv']; 
                        while($proveedor=mysqli_fetch_array($select2)){
                            if($prov==$proveedor['rut_nit_pv']){?>
                                <option value="<?php echo $proveedor['rut_nit_pv'];?>" selected><?php echo $proveedor['nombre_pv'];?></option>
                    <?php   }else{?>
                                <option value="<?php echo $proveedor['rut_nit_pv'];?>"><?php echo $proveedor['nombre_pv'];?></option>
                    <?php }}?>
                </select>
            </div>
        </div>
        <div class="field">
            <label for="">Descripción del producto</label>
            <textarea id="descrip_pd" name="descrip_pd" class="ui input" rows="1" required><?php echo $resultado['descrip_pd']; ?></textarea>
        </div>
        <div class="two fields">
            <div class="field" id="grupo_pc">
                <label class="grupo_label" for="">Precio de compra</label>
                <input id="precio_compra" class="grupo_input" type="number" value="<?php echo $resultado['precio_compra']; ?>" name="precio_compra" required>
                <p class="error">El precio de compra debe ser mayor a 0</p>
            </div>
            <div class="field" id="grupo_venta">
                <label class="grupo_label" for="">Precio de venta</label>
                <input id="precio_venta" class="grupo_input" type="number" value="<?php echo $resultado['precio_venta']; ?>" name="precio_venta" required>
                <p class="error">El precio de venta no puede ser inferior al precio de compra, ni igual a 0</p>
            </div>
        </div>
        <div class="two fields">
            <div class="field" id="grupo_min">
                <label class="grupo_label" for="">Unidades mínimas</label>
                <input id="unidades_minimas" class="grupo_input" type="number" value="<?php echo $resultado['unidades_minimas']; ?>" name="unidades_minimas" required>
                <p class="error">Las unidades máximas deben ser mayores a 0</p>
            </div>
            <div class="field" id="grupo_max">
                <label class="grupo_label" for="">Unidades máximas</label>
                <input id="unidades_maximas" class="grupo_input" type="number" value="<?php echo $resultado['unidades_maximas']; ?>" name="unidades_maximas" required>
                <p class="error">Las unidades máximas no pueden ser inferiores a las unidades mínimas, ni iguales a 0</p>
            </div>
        </div>
        <div class="field" id="">
            <label class="grupo_label" for="">Unidades existentes</label>
            <input id="unidades_existentes" class="grupo_input" type="number" value="<?php echo $resultado['unidades_existentes']; ?>"name="unidades_existentes" required>
        </div>
        <br>
        <div class="row">
            <input class="ui yellow button registrar col-md-3 col-sm-12 col-lg-3 col-xs-12" type="submit" onclick="guardarDatos()" name="btn_actualizar" value="ACTUALIZAR PRODUCTO">
            <input class="ui orange button" type="button" onclick="recuperarDatos()" value="RECUPERAR DATOS">
        </div>
    </form>
</div>
<script src="validaciones/crearproducto.js"></script>

<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>