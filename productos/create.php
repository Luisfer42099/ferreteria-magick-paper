<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header('Location: ../index.php');
} else {
}
require_once 'header.php';
require_once '../conrollers/productoscontroller.php';

$estu = new Producto();

$activador = $estu->getProv();
?>

<div class="container">
	<div class="col-md-12">
		<h3>Hola! <?php echo $_SESSION['user_id']->nombre; ?></h3>
	</div>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-8">
					<h2>Agregar <b>Producto</b></h2>
				</div>
				<div class="col-sm-4">
					<a href="../login/cerrarsession.php" class="btn btn-danger add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
							<path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
						</svg> Cerrar sesion</a>
					<a href="productos.php" class="btn btn-info add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
						</svg> Regresar</a>
				</div>
			</div>
		</div>
		<?php

		if (isset($_POST) && !empty($_POST)) {

			$proveedor = $estu->sanitize($_POST['proveedor']);
			$ubicacion = $estu->sanitize($_POST['ubicacion']);
			$nombre = $estu->sanitize($_POST['nombre']);
			$descripcion = $estu->sanitize($_POST['descripcion']);
			$stock = $estu->sanitize($_POST['stock']);
			$unidad = $estu->sanitize($_POST['unidad']);
			$venta = $estu->sanitize($_POST['venta']);

			$activa = $estu->getProd($nombre);
			if($activa == null){
				$res = $estu->create($proveedor, $ubicacion, $nombre, $descripcion, $stock, $unidad, $venta);
				if ($res) {
					$message = "Datos insertados con éxito";
					$class = "alert alert-success";
					header('Location: productos.php');
				} else {
					$message = "No se pudieron insertar los datos";
					$class = "alert alert-danger";
				}
			} else {
				$message = "No se pudieron insertar el producto por que ya existe";
				$class = "alert alert-danger";
			}
		?>
			<div class="<?php echo $class ?>">
				<?php echo $message; ?>
			</div>
		<?php
		}

		?>
		<div class="row">
			<form method="post">
				<div class="col-md-6">
					<label>Proveedor:</label>
					<select name="proveedor" id="">
						<?php while ($pro = mysqli_fetch_object($activador)) :
							$id = $pro->id;
							$nombre = $pro->nombre; ?>
							<option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-6">
					<label>Ubicacion:</label>
					<input type="text" name="ubicacion" id="ubicacion" class='form-control' maxlength="100" required>
				</div>
				<div class="col-md-6">
					<label>Nombre:</label>
					<input type="text" name="nombre" id="nombre" class='form-control' maxlength="100" required>
				</div>
				<div class="col-md-6">
					<label>Descripcion:</label>
					<input type="text" name="descripcion" id="descripcion" class='form-control' maxlength="100" required>
				</div>
				<div class="col-md-6">
					<label>Cantidad Stock:</label>
					<input type="text" name="stock" id="stock" class='form-control' maxlength="100" required>
				</div>
				<div class="col-md-6">
					<label>Valor Unidad</label>
					<input type="text" name="unidad" id="unidad" class='form-control' maxlength="100" required>
				</div>
				<div class="col-md-6">
					<label>Valor venta</label>
					<input type="text" name="venta" id="venta" class='form-control' maxlength="100" required>
				</div>
				<div class="col-md-12 pull-right">
					<hr>
					<button type="submit" class="btn btn-success">Guardar producto</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require_once '../partes/footer.php'; ?>