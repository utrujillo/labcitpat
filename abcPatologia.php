<?php
include_once("scripts/access.php");
$access = new Access("R,S");
	include_once("scripts/conecta.inc.php");
	$selDb = $_SESSION["db"];
	$conexion = new Conexion($selDb);
	
	$skipFields = array("hdMod","idPatologia");
	$renameFields = array("fk_idRegistro" => "hdReg");		
	$defaultValues = array("fechaResultadoPat");
	
	if($_POST["hdMod"]){
			$mov = "c";
			$cadena = "";
			$idPatologia = $_POST["idPatologia"];
		}else{
			$mov = "a"; 
		}
			
			foreach($_POST as $nameCampo => $value){		
				if(!in_array($nameCampo,$skipFields)){
					if(!in_array($nameCampo,$renameFields)){
							if(in_array($nameCampo,$defaultValues)){
								if($nameCampo == "fechaResultadoPat"){
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
						$$nameCampo = strtoupper(substr($value,0,strlen($value)));
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
			
			if($mov == "a")
				$sql = "insert into patologiatbl (". $campos .") values (". $valueCampos .")";
			
			if($mov == "c"){
				$sql = "update patologiatbl set ". $cadena ." where idPatologia =". $idPatologia;
			}
			
			if(!$conexion->consulta($sql))
				echo "Ocurrio un error al de ejecutar la consulta ". mysqli_error($conexion->getLink());
			else
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1; URL=dataCenter.php\">";
?>