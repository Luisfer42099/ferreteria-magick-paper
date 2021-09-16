<?php
    require_once '../conexion/database.php';
    class Usuarios{
        protected $con;

        
        public function __construct()
		{
			$this->con = Database::connect();
		}
        public function Registro($nom, $ema, $cla){
            $sql = "INSERT INTO `usuarios`(id, nombre, email, clave) VALUES (null,'{$nom}','{$ema}','{$cla}')";
            $res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
        }
    }
?>