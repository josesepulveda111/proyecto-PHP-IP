<?php

if(basename($_SERVER['PHP_SELF'])=="menu.php"){

include "conexion.php";
$consulta="SELECT * FROM tbl_entradas order by fecha_entrada desc";
$resultado=mysqli_query($conexion,$consulta) or die ("Fallas en la consulta");

?>
<div class="ui container">
<br>
<h1>Entradas registradas</h1>
<br>
<table class="ui red table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Total entrada</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($columna=mysqli_fetch_array($resultado)){ ?>
        <tr>
            <td><?php echo $columna['fecha_entrada'];?></td>
            <td>$<?php echo $columna['total_entrada'];?></td>
            <td><a href="menu.php?mod=detalleentrada&id=<?php echo $columna['id_entrada'];?>"><i class="bx bxs-file-blank icon"></i></a></td>
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