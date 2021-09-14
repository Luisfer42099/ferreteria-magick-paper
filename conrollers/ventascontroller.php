<?php  
    require_once '../conexion/database.php';
    class Ventas{
        protected $con;
        public function __construct()
		{
			$this->con = Database::connect();
		}
		public function read(){
			$sql = "SELECT * FROM productos";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function getProd1($id){
			$sql = "SELECT * FROM productos WHERE id='$id';";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return ;
		}
        public function saveventa($art, $cant, $uni, $desc, $tot, $form){
			$sql = "INSERT INTO ventas(id, fecha, articulo, cantidad, vlr_unidad, descuento, vlr_total, forma_pago) 
			VALUES (null,CURDATE(),'{$art}','{$cant}','{$uni}','{$desc}','{$tot}','{$form}')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return mysqli_error($this->conn);
			}
		}
        public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
        public function getventas(){
			$sql = "SELECT * FROM `ventas` order by id DESC";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function getventasporfecha($fe1, $fe2){
			$sql = "SELECT * FROM ventas WHERE fecha BETWEEN '$fe1' AND '$fe2'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function updatestock($id, $stock){
			$sql = "UPDATE productos SET cantidad_stock='{$stock}' WHERE id='{$id}'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		public function updatecantventas($id, $vent){
			$sql = "UPDATE productos SET num_ventas='{$vent}' WHERE id='{$id}'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				//return mysqli_error($this->conn);
				return false;
			}
		}
		public function getTotal($fe1, $fe2){
			$sql = "SELECT sum(vlr_total)as total FROM ventas WHERE fecha BETWEEN '$fe1' AND '$fe2'";
			$res = mysqli_query($this->con, $sql);
			$resul = mysqli_fetch_object($res);
			return $resul;
		}
		
    }
?>