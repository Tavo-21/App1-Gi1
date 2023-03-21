<?php include("../../templates/header.php"); ?>
<br />
<div class="card">
    <div class="card-header">
        Datos del Usuario
    </div>
    <div class="card-body">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre usuario">
            </div>
            <div class="mb-3">
              <label for="contraseña" class="form-label">Password</label>
              <input type="password"
                class="form-control" name="contraseña" id="contraseña" aria-describedby="helpId" placeholder="Contraseña">
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Correo</label>
              <input type="email"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
            </div>

            <input name="" id="" class="btn btn-success" type="submit" value="Agregar">
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
</div>
<?php include("../../templates/footer.php"); ?>