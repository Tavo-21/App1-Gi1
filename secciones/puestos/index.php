<?php
include("../../bd.php");

//envio de parametos a traves del metodo get
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    //asignado el valor que vamos a reccionar

    $sentencia = $conexion->prepare("DELETE FROM  tbl_puestos WHERE id =:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("location:index.php");
}

//Conexion a la tabla puestos de la base de datos
$sentencia = $conexion->prepare("SELECT  * FROM `tbl_puestos`");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//Consulta datos de la tabla puestos
//print_r($lista_tbl_puestos);

//a continuacion utlizar un ciclo para mostrar todos los registros
?>
<?php include("../../templates/header.php"); ?>
<br />
<h4>Puestos</h4>
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
                        <th scope="col">Nombre del Puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!---Informacion que se va a repetir cuando encuentre los registros-->
                    <?php
                    foreach ($lista_tbl_puestos as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id']; ?></td>
                            <td><?php echo $registro['nombredelpuesto']; ?></td>
                            <td>
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