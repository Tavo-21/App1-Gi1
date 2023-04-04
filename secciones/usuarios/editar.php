<?php
include("../../bd.php");
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam('id', $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY); 

    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
}

if ($_POST) {
    //recolectamos datos
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");

    //insertar registros
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET 
    usuario=:usuario,
    password=:password,
    correo=:correo
    WHERE id=:id
    ");

    //datos que se van a llenar dentro de la sentencia sql
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();
    header("location:index.php");
}

?>


<?php include("../../templates/header.php"); ?>
<br />
<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">

        <div class="mb-3">
                <label for="txtID" class="form-label">Id</label>
                <input type="text" value="<?php echo $txtID ?>" class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="Id">
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" value="<?php echo $usuario ?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" value="<?php echo $password ?>" name="password" id="password" aria-describedby="helpId" placeholder="Password">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" value="<?php echo $correo ?>" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
            </div>

            <input class="btn btn-success" type="submit" value="Editar">
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
<?php include("../../templates/footer.php"); ?>