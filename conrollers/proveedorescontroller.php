<?php
    include '../conexion/database.php';
    class Proveedores{
        protected $con;
        public function __construct()
		{
			$this->con = Database::connect();
		}
        public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
        public function getprove($id){
			$sql = "SELECT * FROM proveedores where id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return ;
		}
        public function getProv(){
			$sql = "SELECT * FROM proveedores";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
        public function getProv1($id){
			$sql = "SELECT * FROM proveedores WHERE id='$id';";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return ;
		}
        public function newprov($nombre,$telefono,$direccion){
			$sql = "INSERT INTO proveedores(id, nombre, telefono, direccion) 
			VALUES (null, '$nombre','{$telefono}','{$direccion}')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
        public function updateprov($id,$nombre,$telefono,$direccion){
			$sql = "UPDATE proveedores SET nombre='{$nombre}',telefono='{$telefono}',direccion='{$direccion}' WHERE id='{$id}'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return mysqli_error($this->con);
			}
		}
		public function single_record($id){
			$sql = "SELECT * FROM productos where id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return ;
		}
        public function deleteprov($id){
			$sql = "DELETE FROM proveedores WHERE id=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		
    }
?>