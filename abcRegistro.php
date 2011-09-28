<?php
include_once("scripts/access.php");
$access = new Access("R,S");
	include_once("scripts/conecta.inc.php");
	$selDb = $_SESSION["db"];
	$conexion = new Conexion($selDb);
		
		$skipFields = array("hdMod","hdRegistro");
		$renameFields = array("imgLocation" => "hdPos");		
		$defaultValues = array("edad", "semanas", "fechaRecepcion");
			
		if($_POST["hdMod"]){
			$mov = "c";
			$cadena = "";
			$idRegistro = $_POST["hdRegistro"];
		}else{
			$mov = "a"; 
		}
			
			foreach($_POST as $nameCampo => $value){		
				if(!in_array($nameCampo,$skipFields)){
					if(!in_array($nameCampo,$renameFields)){
							if(in_array($nameCampo,$defaultValues)){
								if($nameCampo == "fechaRecepcion"){
									if($value == "" || $value =="0000-00-00")
										$value = "0000-00-00";										
								}else{
									if($value == "")
										$value = 0;
								}
								
								$$nameCampo = $value;
							}else
								$$nameCampo = strtoupper($value);
						
					}else{			
						$nameCampo = array_search($nameCampo,$renameFields);
						$$nameCampo = strtoupper(substr($value,0,strlen($value)-1));
					}//fin renameFields
					
					if($mov == "a"){
						$campos .= $nameCampo.",";
						$valueCampos .= "'". $$nameCampo ."',";
					}
					if($mov == "c"){
						$cadena .= $nameCampo."='". $$nameCampo ."',";
					}
				}//fin skipFields
			}
			
			$campos = substr($campos,0,strlen($campos)-1);
			$valueCampos = substr($valueCampos,0,strlen($valueCampos)-1);
			$cadena = substr($cadena,0,strlen($cadena)-1);
			
			
			//$sql = "insert into registroTbl <br />(". $campos .") <br />values (". $valueCampos .")";
			
			
			if($mov == "a")
				$sql = "insert into registrotbl (". $campos .") values (". $valueCampos .")";
			
			if($mov == "c"){
				$sql = "update registrotbl set ". $cadena ." where idRegistro =". $idRegistro;
			}
			
			
			
			if(!$conexion->consulta($sql))
				echo "Ocurrio un error al de ejecutar la consulta ". mysqli_error($conexion->getLink());
			else
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=registro.php\">";