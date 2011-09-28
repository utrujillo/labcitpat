<?php
include_once("scripts/access.php");
$access = new Access("R,S");
	include_once("scripts/conecta.inc.php");
	$selDb = $_SESSION["db"];
	$conexion = new Conexion($selDb);
	
	$arrConcepto 	= array();
	$arrValor		= array();
	$arrIndex		= array();
	$cC 			= 0;
	$cV				= 0;

	$skipFields = array("hdMod","idCitologia","selConcepto");
	$renameFields = array("fk_idRegistro" => "hdReg");		
	$defaultValues = array("fechaResultadoCit");
	
	if($_POST["hdMod"]){
			$mov = "c";
			$cadena = "";
			$idCitologia = $_POST["idCitologia"];
		}else{
			$mov = "a"; 
		}

	foreach($_POST as $nameCampo => $value){
		if($mov == "a"){
			if(strlen($nameCampo) == 2){ $arrConcepto[$cC] = strtoupper($nameCampo); $cC++; }
			if(strlen($nameCampo) == 7){ $arrValor[$cV] = strtoupper($value); $cV++; }
		}
		
		if($mov == "c"){
			if(substr($nameCampo,0,6) == "calif_"){
				list($name,$idConcepto) = explode("_",$nameCampo);
				$arrIndex[$cV] = $idConcepto;
				$arrValor[$cV] = $value;
				$cV++;
			}
		}
		
		if((strlen($nameCampo) != 2) && (strlen($nameCampo) != 7)){
			//echo $nameCampo ." => ". $value."<br />";
			if(!in_array($nameCampo,$skipFields)){
					if(!in_array($nameCampo,$renameFields)){
							if(in_array($nameCampo,$defaultValues)){
								if($nameCampo == "fechaResultadoCit"){
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
		}//fin nameCampo != 2 && nameCampo != 7
	}//foreach nameCampos => value
	
			$campos = substr($campos,0,strlen($campos)-1);
			$valueCampos = substr($valueCampos,0,strlen($valueCampos)-1);
			$cadena = substr($cadena,0,strlen($cadena)-1);
			
			
			if($mov == "a"){
				$sql = "insert into citologiatbl (". $campos .") values (". $valueCampos .")";
				//echo $sql."<br />"; 
				$lastId = $conexion->consulta_getid($sql);
				
				for($i = 0; $i < sizeof($arrConcepto); $i++){
				$sqlConcept = "insert into conceptotbl (fk_idCitologia,concepto,calificacion) values ($lastId,'$arrConcepto[$i]','$arrValor[$i]')";
					//echo $sqlConcept."<br />";
					if(!$conexion->consulta($sqlConcept))
						echo "Ocurrio un error al de ejecutar la consulta ". mysqli_error($conexion->getLink());
				}
				
				$msn = "Los datos han sido Almacenados";
			}
				
			
			if($mov == "c"){
				$sql = "update citologiatbl set ". $cadena ." where idCitologia =". $idCitologia;
				if(!$conexion->consulta($sql))
					echo "Ocurrio un error al de ejecutar la consulta ". mysqli_error($conexion->getLink());
				
				for($i = 0; $i < sizeof($arrIndex); $i++){
				$sqlConcept = "update conceptotbl set calificacion = '$arrValor[$i]' where idConcepto = ".$arrIndex[$i];
					//echo $sqlConcept."<br />";
					if(!$conexion->consulta($sqlConcept))
						echo "Ocurrio un error al de ejecutar la consulta ". mysqli_error($conexion->getLink());
				}
				
				$msn = "Los datos han sido Actualizados";
				
				
			}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Area Restringida</title>
</head>
<style>
#message{
	position:absolute;
	/*margin:275px auto 0px;*/
	background: url(img/message.png) no-repeat;
	width:340px; height:120px;
	top:50%;
	left:50%;
	margin-top:-110px;
	margin-left:-170px;
	padding:55px 30px 0 30px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000;
}
div{
	padding:0 0 0 100px;
	width:250px;
	text-align:center
}
</style>
<body>
<div id="message">
	<div>
		<?php
			echo $msn;
    	?>
        <br />
        <a onclick="window.close()" href="#">[ Cerrar Ventana ] </a>
    </div>
</div>
</body>
</html>
