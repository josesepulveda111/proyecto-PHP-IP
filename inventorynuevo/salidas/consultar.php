<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$consulta="SELECT id_salida, fecha_salida, total_salida, s.nombre_cli FROM tbl_salidas inner join tbl_supermercados as s on s.rut_nit_cli=tbl_salidas.rut_nit_cli order by fecha_salida desc";
$resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");

?>
<div class="ui container">
<br>
<h1>Salidas registradas</h1>
<br>
<table class="ui red table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Total salida</th>
            <th>Supermercado</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($columna=mysqli_fetch_array($resultado)){ ?>
        <tr>
            <td><?php echo $columna['fecha_salida'];?></td>
            <td>$<?php echo $columna['total_salida'];?></td>
            <td><?php echo $columna['nombre_cli'];?></td>
            <td><a href="menu.php?mod=detallesalida&id=<?php echo $columna['id_salida'];?>"><i class="bx bxs-file-blank icon"></i></a></td>
        </tr>
        <?php } 
        mysqli_close($conexion);
        ?>
    </tbody>
</table>
<br>
</div>
<?php   
}else{
echo "<script>window.location='../menu.php'</script>";
}
?>