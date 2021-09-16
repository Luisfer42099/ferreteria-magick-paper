<?php
	require_once '../conexion/database.php';
    class Producto{
		protected $con, $ciudad, $pais, $nav, $ip;

		public function getPais(){
            return $this->pais;
        }
        public function getCiudad(){
            return $this->ciudad;
        }
        public function getNav(){
            return $this->nav;
        }
        public function getIp(){
            return $this->ip;
        }
        public function setPais($pais){
            $this->pais = $pais;
        }
        public function setCiudad($ciu){
            $this->ciudad = $ciu;
        }
        public function setNav($nav){
            $this->nav = $nav;
        }
        public function setIp($ip){
            $this->ip = $ip;
        }
        public function __construct()
		{
			$this->con = Database::connect();
		}
        public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
        public function single_record($id){
			$sql = "SELECT * FROM productos where id='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return ;
		}
		public function buscarprod($id){
			$sql = "SELECT * FROM productos where id='$id'";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
        public function read(){
			$sql = "SELECT * FROM productos ORDER BY num_ventas DESC";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function getProv1($id){
			$sql = "SELECT * FROM proveedores WHERE id='$id';";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return;
		}
		public function getProv(){
			$sql = "SELECT * FROM proveedores";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
        public function create($proveedor,$ubicacion,$nombre,$descripcion,$cantidad,$unidad,$venta){
			$sql = "INSERT INTO productos (id, proveedor, ubicacion, nombre, descripcion, cantidad_stock, valor_unidad, valor_venta, fecha) 
			VALUES (null, '$proveedor','{$ubicacion}','{$nombre}','{$descripcion}','{$cantidad}','{$unidad}','{$venta}', CURDATE() )";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
        public function update($id,$ubicacion,$nombre,$descripcion,$stock, $unidad, $venta){
			$sql = "UPDATE productos SET ubicacion='{$ubicacion}', nombre='{$nombre}', descripcion='{$descripcion}', cantidad_stock='{$stock}', valor_unidad='{$unidad}', valor_venta='{$venta}' WHERE id='$id';";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return mysqli_error($this->con);
			}
		}
        public function delete($id){
			$sql = "DELETE FROM productos WHERE id=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
        public function getoneprod($id){
			$sql = "SELECT * FROM productos";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return;
		}
		public function getProd1($id){
			$sql = "SELECT * FROM productos WHERE id='$id';";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return ;
		}
		public function getProd($nombre){
			$sql = "SELECT * FROM productos WHERE nombre='$nombre';";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_object($res);
			return $return;
		}
		public function buscar($fechaini, $fechafin){
			$sql = "SELECT * FROM productos WHERE fecha BETWEEN '$fechaini' AND '$fechafin';";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}
		public function insertvisitante(){
            $sql = "INSERT INTO visitas_control (id, pais, ciudad, navegador, ip) VALUES (null,'{$this->getPais()}','{$this->getCiudad()}', '{$this->getNav()}', '{$this->getIp()}')";
            $res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
        }
    }
