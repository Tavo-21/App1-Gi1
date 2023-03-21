<?php 
//Conexion a la tabla puestos de la base de datos
include("../../bd.php");
$sentencia=$conexion->prepare("SELECT  * FROM `tbl_puestos`");
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
                    foreach ($lista_tbl_puestos as $registro) {?>
                    <tr class="">
                        <td scope="row"><?php echo $registro['id'];?></td>
                        <td><?php echo $registro['nombredelpuesto'];?></td>
                        <td>
                            <input name="btneditar" id="btneditar" class="btn btn-info" type="button" value="Editar">
                            <input name="btneliminar" id="btneliminar" class="btn btn-danger" type="button" value="Eliminar">
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>