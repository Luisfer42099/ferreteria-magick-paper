<?php 
session_start();
 
if(!isset($_SESSION['user_id'])){
	header('Location: ../index.php');
} else {
	
}
if (isset($_GET['id'])){
	include('../conrollers/proveedorescontroller.php');
	$estu = new Proveedores;
	$id=intval($_GET['id']);
	$res = $estu->deleteprov($id);
	if($res){
		header('location: proveedores.php');
	}else{
		echo "Error al eliminar el registro";
	}
}
?>