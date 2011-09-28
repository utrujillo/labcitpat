<?php
class Conexion {
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	//private $user = "inversionoax";
	//private $pass = "1nv3rs10n0@xQQ";
	//private $user = "root";
	//private $pass = "YK7hmvRBHl";
	//private $user = "intellim_peasa";
	//private $pass = "qwerty1122";
	private $conectar;
	
	public function Conexion($db){
		$this->conectar = mysqli_connect($this->host,$this->user,$this->pass) or die(mysqli_error($this->conectar));
		mysqli_select_db($this->conectar, $db) or die(mysqli_error($this->conectar));
		if (mysqli_connect_errno()) {
			printf("Conexion Fallida: %s\n", mysqli_connect_error());
			exit();
		}
	}
	
	public function consulta($sql){
		$result = mysqli_query($this->conectar,$sql);
		echo mysqli_error($this->conectar);
		return $result;
	}
	
	public function consulta_getid($sql){
		$result = mysqli_query($this->conectar,$sql);
		$LastId = mysqli_insert_id($this->conectar);
		echo mysqli_error($this->conectar);
		return $LastId;
	}
	
	public function preparaConsulta($sql){
		$stmt = mysqli_prepare($this->conectar, $sql);
		return $stmt;
	}
	
	public function getLink(){
		return $this->conectar;
	}
}
?>
