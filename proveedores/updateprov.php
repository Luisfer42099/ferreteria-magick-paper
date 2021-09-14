<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header('Location: ../index.php');
} else {
}
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
} else {
	header('Location: ../index.php');
}

require_once 'header.php';
?>

<div class="container">
	<div class="col-md-12">
		<h3>Hola! <?php echo $_SESSION['user_id']->nombre; ?></h3>
	</div>
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-8">
					<h2>Editar <b>Proveedor</b></h2>
				</div>
				<div class="col-sm-4">
					<a href="../login/cerrarsession.php" class="btn btn-danger add-new"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
							<path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
						</svg> Cerrar sesion</a>
					<a href="Proveedores.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
				</div>
			</div>
		</div>
		<?php

		include("../conrollers/proveedorescontroller.php");
		$estu = new Proveedores();

		if (isset($_POST) && !empty($_POST)) {
			$int = (int)$id;
			$id = $estu->single_record($_POST['id']);
			$Nombre = $estu->sanitize($_POST['nombre']);
			$telefono = $estu->sanitize($_POST['telefono']);
			$direccion = $estu->sanitize($_POST['direccion']);

			$res = $estu->updateprov($int, $Nombre, $telefono, $direccion);
			if ($res) {
				$message = "Datos actualizados con éxito";
				$class = "alert alert-success";

				header('Location: Proveedores.php');
			} else {
				$message = "No se pudieron actualizar los datos";
				$class = "alert alert-danger";
			}

		?>
			<div class="<?php echo $class ?>">
				<?php echo $message; ?>
			</div>
		<?php
		}
		$datos_cliente = $estu->getprove($id);

		?>
		<div class="row">
			<form method="post">
				<input type="hidden" name="id" value="<?php echo $datos_cliente->id; ?>">
				<div class="col-md-6">
					<label>Nombre:</label>
					<input type="text" name="nombre" id="nombre" class='form-control' maxlength="100" required value="<?php echo $datos_cliente->nombre; ?>">
				</div>
				<div class="col-md-6">
					<label>Telefono:</label>
					<input type="text" name="telefono" id="telefono" class='form-control' maxlength="100" required value="<?php echo $datos_cliente->telefono; ?>">
				</div>
				<div class="col-md-6">
					<label>Direccion:</label>
					<input type="text" name="direccion" id="direccion" class='form-control' maxlength="100" required value="<?php echo $datos_cliente->direccion; ?>">
				</div>

				<div class="col-md-12 pull-right">
					<hr>
					<button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php require_once '../partes/footer.php'; ?>