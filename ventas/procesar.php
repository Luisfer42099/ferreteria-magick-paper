<?php 
    require_once 'header.php'; 
    require_once '../conrollers/ventascontroller.php'; 
    session_start();
 
	if(!isset($_SESSION['user_id'])){
		header('Location: ../index.php');
	} else {
		
	}
    $prod = new Ventas();
    
    if(isset($_POST['Procesar'])){
        $articuloid = $_POST['articuloid'];
        $producto = $prod->getProd1($articuloid);
        $nombre = $producto->nombre;
        $unidad = $producto->valor_venta;
        $cantidad = $_POST['cantidad'];
        $forma = $_POST['forma'];
        $descuento = $_POST['descuento'];
        $subtotal = $unidad*$cantidad;
        $activa = $prod->getProd1($articuloid);
        $stock = $activa->cantidad_stock-$cantidad;
        $total = $subtotal-$descuento;        
        $numeroventas = $producto->num_ventas;
        $newventas = $numeroventas + 1;
        $conv = intval($newventas);

        if($activa->cantidad_stock >= $cantidad){
            $activador = $prod->saveventa($nombre, $cantidad, $unidad, $descuento, $total, $forma);
            $actua = $prod->updatestock($articuloid, $stock);
            $actualiza = $prod->updatecantventas($articuloid, $conv);
        }else{
            $actua = false;
            $activador = false;
            $actualiza = false;
        }

        if($activador && $actua && $actualiza){
            echo "<script>alert('venta procesada con exito');</script>";

        }else{
            echo "<script>alert('no hay suficientes en stock.'); window.location.href='addventa.php';</script>";
        }
    }
?>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Factura de <b>Venta</b></h2>
                </div>
                <div class="col-sm-4">
                    <a href="ventas.php" class="btn btn-info add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/></svg> Regresar</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col md-12">
                    <h1>Factura</h1>
                    <form action="" method="POST">
                        <div class="col-md-6">
                            <label for="producto">Producto</label>
                            <input type="text" name="nombre1" id="nombre1" value="<?php echo $nombre; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="producto">Cantidad</label>
                            <input type="text" name="cantidad1" id="cantidad1" value="<?php echo $cantidad; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="producto">Descuento</label>
                            <input type="text" name="descuento1" id="descuento1" value="<?php echo $descuento; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="producto">Precio por unidad</label>
                            <input type="text" name="unidad1" id="unidad1" value="<?php echo $unidad; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="producto">Subtotal</label>
                            <input type="text" name="subtotal1" id="subtotal1" value="<?php echo $subtotal; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="producto">Precio total:</label>
                            <input type="text" name="total1" id="total1" value="<?php echo $total; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="producto">forma de pago</label>
                            <input type="text" name="forma1" id="forma1" value="<?php echo $forma; ?>" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../partes/footer.php'; ?>