<?php 
session_start();
 
if(!isset($_SESSION['user_id'])){
    header('Location: ../index.php');
} else {
    
}
if (isset($_GET['id'])){
	
	include('../conrollers/productoscontroller.php');
	$estu = new Producto();
	$id=intval($_GET['id']);
	$res = $estu->delete($id);
	if($res){
		header('location: productos.php');
	}else{
		echo "Error al eliminar el registro";
	}
}
?>