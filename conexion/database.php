<?php
	class Database{
		public $db;
		public static function connect(){
			$db = new mysqli('213.190.6.179', 'u558315427_magick', 'Magick-paper2021', 'u558315427_magick');
			$db->query("SET NAMES 'utf8'");
			return $db;
		}
	}

?>	

