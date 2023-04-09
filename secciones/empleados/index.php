<?php
include("../../bd.php");

#Obtener y borrar
if(isset($_GET['txtID'])){
    
    $txtID=(isset($_GET['txtID'])?$_GET['txtID'] : '');
    //buscar archivo relacionado con el empleado 
    $sentencia=$conexion->prepare("SELECT foto, cv FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    echo print_r($registro_recuperado);

    //preugntar si el archivo existe
    if(isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=""){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }

    if(isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=""){
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado["cv"]);
        }
    }

    #borrado
    $sentencia=$conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("location: index.php");

}


$sentencia = $conexion->prepare("SELECT *,
#hacer una subconsulta para sacar el valor de puesto
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto 
FROM tbl_empleados");
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>
<br />
<h4>Empleados</h4>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Cv</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lista_tbl_empleados as $registro) {
                    ?>
                        <tr class="">
                            <td><?php echo $registro['id']; ?></td>
                            <td scope="row">
                                <?php echo $registro['primernombre']; ?>
                                <?php echo $registro['segundonombre']; ?>
                                <?php echo $registro['primerapellido']; ?>
                                <?php echo $registro['segundoapellido'] ?></td>
                            <td>
                                <img width="90" src="<?php echo $registro['foto']; ?>" class="img-fluid rounded" alt="">
                            </td>
                            <td><?php echo $registro['cv'] ?></td>
                            <!--Se hizo una subconsulta para sacar el nombre del puesto-->
                            <td><?php echo $registro['puesto'] ?></td>
                            <td><?php echo $registro['fechadeingreso'] ?></td>
                            <td><a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>" role="button">Eliminar</a>
                                <!--Esta enviando un dato id a traves de la url y quien lo hace es la url eliminar-->
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>


    </div>
</div>
<?php include("../../templates/footer.php"); ?>