<?php require_once 'header.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
}
?>

<div class="container">
    <div class="col-md-12">
        <h3>Hola! <?php echo $_SESSION['user_id']->nombre; ?></h3>
    </div>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Listado de <b>Ventas</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="../login/cerrarsession.php" class="btn btn-danger add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                        </svg> Cerrar sesion</a>
                    <button type="button" class="btn btn-success add-new" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z" />
                        </svg> Generar Reportes De Ventas</button>
                    <a href="addventa.php" class="btn btn-primary add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg> Agregar venta</a>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Articulo</th>
                    <th>cantidad</th>
                    <th>Vlr. Unidad</th>
                    <th>Descuento</th>
                    <th>Vlr. Total</th>
                    <th>Forma pago</th>
                </tr>
            </thead>
            <?php
            require_once '../conrollers/ventascontroller.php';
            $estu = new Ventas();
            $listado = $estu->getventas();
            ?>
            <tbody>
                <?php
                while ($row = mysqli_fetch_object($listado)) {
                    $id = $row->id;
                    $fecha = $row->fecha;
                    $articulo = $row->articulo;
                    $cantidad = $row->cantidad;
                    $vlr_unidad = $row->vlr_unidad;
                    $descuento = $row->descuento;
                    $vlr_total = $row->vlr_total;
                    $forma_pago = $row->forma_pago;

                ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $fecha; ?></td>
                        <td><?php echo $articulo; ?></td>
                        <td><?php echo $cantidad; ?></td>
                        <td><?php echo $vlr_unidad; ?></td>
                        <td><?php echo $descuento; ?></td>
                        <td><?php echo $vlr_total; ?></td>
                        <td><?php echo $forma_pago; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../partes/footer.php'; ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Seleccione las fechas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="reportes.php" method="POST">
                    <div class="mb-6">
                        <label for="recipient-name" class="col-form-label">Desde:</label>
                        <input type="date" class="form-control" name="fecha1" id="fecha1" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Hasta:</label>
                        <input type="date" class="form-control" name="fecha2" id="fecha2" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" value="Generar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>