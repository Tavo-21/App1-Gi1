<?php
include("../../bd.php");
//Consulta sencilla de lo que se envia
//para insertar datos primero necesitamos una validadcion
if ($_POST) {
    //print_r($_POST);

    $nombredelpuesto = (isset($_POST['nombredelpuesto']) ? $_POST['nombredelpuesto'] : "");
    //Validamos que exista la info enviada                           si no existe lo pondra en blanco

    //Preparar insercion a la base de datos
    $sentencia = $conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto)
    VALUES (null, :nombredelpuesto)");
    //asiganado los valores que vienene del metodo post(los que vienene del formulario)
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto);
    //Pasamos los paremetos a esa sentencia hacemos referencia a ese dato para reemplazar ese dato por el que nos enviaros el binparm
    $sentencia->execute();

    //redireccionar vista
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
                <label for="nombredelpuesto" class="form-label">Nombre del Puesto</label>
                <input type="text" class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del Puesto">
            </div>

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>
<?php include("../../templates/footer.php"); ?>