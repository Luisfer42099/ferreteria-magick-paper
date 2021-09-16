<?php require_once 'header.php';

require_once '../geoplugin.class/geoplugin.class.php';
require_once '../conrollers/productoscontroller.php';

$estu = new Producto();
$listado = $estu->read();

session_start();

$geoplugin = new geoPlugin();
$geoplugin->locate();

$cont = 0;
if ($cont == 0) {

    $estu->setIp($geoplugin->ip);
    $estu->setPais($geoplugin->countryName);
    $estu->setCiudad($geoplugin->timezone);
    $estu->setNav(getenv("HTTP_USER_AGENT"));
    $activa = $estu->insertvisitante();
    $cont +1;
}else {

}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
} else {
}

?>

<div class="container">
    <div class="col-md-12">
        <h3>Hola! <?php echo $_SESSION['user_id']->nombre; ?></h3>
    </div>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Listado de <b>Productos</b></h2>
                </div>
                <div class="col-sm-4">
                    <a href="../login/cerrarsession.php" class="btn btn-danger add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                        </svg> Cerrar sesion</a>
                    <a href="create.php" class="btn btn-primary add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg> Agregar Producto</a>
                </div>
                <div class="col-md-12">
                    <div class="buscar">
                        <form action="buscar.php" method="POST">
                            <h2>Busqueda de productos por fecha de iinsercion</h2>
                            <!--<label for="id">Buscar ID</label>-->
                            <label for="fevhaini">Desde</label>
                            <input type="date" name="fechaini" id="">
                            <label for="fechafin">Hasta</label>
                            <input type="date" name="fechafin" id="">
                            <!--<input type="text" name="idpro" id="idpro" placeholder="id del producto">-->
                            <input type="submit" value="buscar" name="buscar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Ubi.</th>
                    <th>Valor Uni</th>
                    <th>Valor Vent</th>
                    <th>N° Ventas</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($row = mysqli_fetch_object($listado)) {
                    $id = $row->id;
                    $fecha = $row->fecha;
                    $Nombre = $row->nombre;
                    $descripcion = $row->descripcion;
                    $stock = $row->cantidad_stock;
                    $ubi = $row->ubicacion;
                    $val_uni = $row->valor_unidad;
                    $val_vent = $row->valor_venta;
                    $ventas = $row->num_ventas;
                ?>
                    <tr>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $Nombre; ?></td>
                        <td><?php echo $descripcion; ?></td>
                        <?php if ($stock > 10) : ?>
                            <td class="normal"><?php echo $stock; ?></td>
                        <?php else : ?>
                            <td class="poco"><?php echo $stock; ?></td>
                        <?php endif; ?>
                        <td><?php echo $ubi; ?></td>
                        <td><?php echo $val_uni; ?></td>
                        <td><?php echo $val_vent; ?></td>
                        <td><?php echo $ventas; ?></td>

                        <td>
                            <a href="update.php?id=<?php echo $id; ?>" class="edit" title="Editar" data-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                </svg></a>
                            <a href="delete.php?id=<?php echo $id; ?>" class="delete" title="Eliminar" data-toggle="tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once '../partes/footer.php'; ?>