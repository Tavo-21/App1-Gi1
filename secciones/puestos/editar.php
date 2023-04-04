<?php
include("../../bd.php");
//primero traer el registro
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : '');
    $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
    $sentencia->bindParam('id', $txtID);
    $sentencia->execute();

    //llenar registro editar 
    $registro = $sentencia->fetch(PDO::FETCH_LAZY); //fetch lazy para que solo se cargue un registro
    $nombredelpuesto = $registro["nombredelpuesto"];
}
//recepcion de los datos por el envio del formulario
if ($_POST) {
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $nombredelpuesto = (isset($_POST["nombredelpuesto"]) ? $_POST["nombredelpuesto"] : "");
    $sentencia = $conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto 
    WHERE id=:id");

    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("location:index.php");
}
?>



<?php include("../../templates/header.php"); ?>
<br />
<div class="card">
    <div class="card-header">
        Puestos
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">Id</label>
                <input type="text" value="<?php echo $txtID ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="Id">
            </div>

            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre del Puesto</label>
                <input type="text" value="<?php echo $nombredelpuesto ?>" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del Puesto">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>
<?php include("../../templates/footer.php"); ?>