<?php require_once 'header.php';
require_once '../conrollers/ventascontroller.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
} else {
}

$prod = new Ventas();
$lista = $prod->read();

if (isset($_GET['articulo'])) {
    $art = $_GET['articulo'];
    $producto = $prod->getProd1($art);
}
?>

<script type="text/javascript">
    function buscar() {
        var articulo = document.getElementById('articuloid').value;
        window.location.href = 'http://localhost/inventario/ventas/addventa.php?articulo=' + articulo;
    }
</script>


<div class="container">
    <div class="col-md-12">
        <h3>Hola! <?php echo $_SESSION['user_id']->nombre; ?></h3>
    </div>
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Agregar <b>Venta</b></h2>
                </div>
                <div class="col-sm-4">
                    <a href="../login/cerrarsession.php" class="btn btn-danger add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                        </svg> Cerrar sesion</a>
                    <a href="ventas.php" class="btn btn-info add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                        </svg> Regresar</a>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="procesar.php" method="POST">
                        <div class="col-md-6">
                            <label for="articulo">Articulo</label>
                            <select name="articuloid" id="articuloid" onchange="return buscar();" required>
                                <?php if ($producto) : ?>
                                    <option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
                                <?php else : ?>
                                    <option value="">Seleccione</option>
                                <?php endif; ?>
                                <?php while ($li = mysqli_fetch_object($lista)) : ?>
                                    <option value="<?php echo $li->id; ?>"><?php echo $li->nombre; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre">Nombre</label>
                            <?php if (isset($producto)) : ?>
                                <input type="text" name="nombre" id="nombre" value="<?php echo $producto->nombre; ?>" disabled>
                            <?php else : ?>
                                <input type="text" name="nombre" id="nombre" value="" disabled>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre">Descuento:</label>
                            <input type="number" name="descuento" id="descuento" value="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre">Valor unidad:</label>
                            <?php if (isset($producto)) : ?>
                                <input type="text" name="unidad" id="unidad" value="<?php echo $producto->valor_venta; ?>" disabled>
                            <?php else : ?>
                                <input type="text" name="unidad" id="unidad" value="" disabled>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre">Forma de pago:</label>
                            <select name="forma" id="forma" required>
                                <option value="">Seleccione</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Credito">Credito</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="QR">QR</option>
                            </select>
                            <div class="col-md-6">
                                <input type="submit" value="Procesar" name="Procesar" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once '../partes/footer.php'; ?>