<?php
include_once("scripts/access.php");
$access = new Access("R,S");

include_once("scripts/conecta.inc.php");
$db = $_SESSION["db"];
$conexion = new Conexion($db);
	($_REQUEST["mod"])?($mod = true):($mod = false);
	$btn = "Registrar";
	$position = 0;
	if($mod){
		$idRegistro = $_REQUEST["mod"];
		$sqlSrc = "SELECT * FROM registrotbl WHERE idRegistro=". $idRegistro;
		$dataSrc = $conexion->consulta($sqlSrc);
		$rowSrc = $dataSrc->fetch_array(MYSQLI_ASSOC);
		$position = $rowSrc["imgLocation"];
		$btn = "Actualizar";
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Laboratorio de Citologia y Patologia S.A de C.V - Red Interna</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css" />
<link href="css/googleButtons.css" rel="stylesheet" type="text/css" />
<link href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<style>
#frontpage header{
	height:205px;
}
</style>
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type='text/javascript' src="js/jquery.utcValidationForm.js"></script>
<script>
$(function(){
	
	$("#sendForm").utcValidationForm();
	
	$( "#fechaRecepcion" ).datepicker({
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
	
		
	
	var canvas = document.getElementById("circleDisplay");
	var c = canvas.getContext('2d');
	var img = new Image();
	var position = $("#hdPos").val().split('|'),
		posVal	= $("#hdPos").val();
	
	var tam = 10,
		newPos = 0, 
		oldPos = 0,
		color = "#BC1010";
	
	img.src = "img/selection2.png";
	
	img.onload = function(){
		c.drawImage(img,0,0);
		if(posVal == 0){
			canvas.addEventListener("click",function(e){
				//alert(e.clientX +" "+ e.clientY);
					var pos = findPos(canvas);
					//Paint Rect
					//var x = (e.pageX - pos.x)*2 - tam;
					//var y = (e.pageY - pos.y)*2 - tam;
					//Paint Circle
					var x = (e.pageX - pos.x)*2;
					var y = (e.pageY - pos.y)*2 - (tam/2);
					
					if(oldPos == 0){
						newPos = x + "," + y +"|";
						oldPos = newPos;
					}else{
						oldPos = newPos;
						newPos =  x + "," + y +"|" + oldPos;
					}				
					
					$("#hdPos").val(newPos);
						c.fillStyle = color;
						c.beginPath();
						c.arc(x, y, tam, 0, Math.PI*2, true); 
						c.closePath;
						c.fill();
			},false);
		}else{
			c.fillStyle = color;
			for(var i=0; i < position.length; i++){
				var posXY = position[i].split(",");
				c.beginPath();
				c.arc(posXY[0], posXY[1], tam, 0, Math.PI*2, true); 
				c.closePath;
				c.fill();
			}
		}
	  }
	
	function findPos(obj) {
    	var curleft = 0, curtop = 0;
		if (obj.offsetParent) {
			do {
				curleft += obj.offsetLeft;
				curtop += obj.offsetTop;
			} while (obj = obj.offsetParent);
			return { x: curleft, y: curtop };
		}
		return undefined;
	}
	
	/*function limpiar(){
	 ctx.fillStyle = "white";
	 ctx.fillRect(0, 0, 500, 500);
	}*/
});
</script>
<body id="frontpage">

<section id="contenedorPrincipal">
<header>
    	<h1 id='logoPrincipal'><a>Laboratorio</a></h1>
        <nav>
        	<?php include_once("scripts/intranetMenu.php"); ?>
        </nav>        
    </header>

	<section id="contenedorCuerpo" class="frmSmall">

    	 <form id="sendForm" name="sendForm" method="post" action="abcRegistro.php">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="der bold">Clave:&nbsp;</td>
            <td><input name="claveFolio" type="text" class="inpuTextCnt required" id="claveFolio" value="<?php echo $rowSrc["claveFolio"]; ?>"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="30%" class="der bold">Fecha de Registro:&nbsp;</td>
            <td width="35%"><input name="fechaRecepcion" type="text" class="inpuTextCnt" id="fechaRecepcion"  value="<?php echo $rowSrc["fechaRecepcion"]; ?>"></td>
            <td width="10%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Nombre:&nbsp;</td>
            <td colspan="2"><input name="nombre" type="text" class="inpuTextCnt required" id="nombre"  value="<?php echo $rowSrc["nombre"]; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Apellido Paterno:&nbsp;</td>
            <td colspan="2"><input name="apellidoPaterno" type="text" class="inpuTextCnt required" id="apellidoPaterno" value="<?php echo $rowSrc["apellidoPaterno"]; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Apellido Materno&nbsp;</td>
            <td colspan="2"><input name="apellidoMaterno" type="text" class="inpuTextCnt" id="apellidoMaterno" value="<?php echo $rowSrc["apellidoMaterno"]; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Sexo:&nbsp;</td>
            <td>
            <select name="sexo" id="sexo" class="inpuTextCnt">
            <?php
				($rowSrc["sexo"] == "M")?($M = '<option value="M" selected="selected">M</option>'):($M = '<option value="M">M</option>');
				($rowSrc["sexo"] == "F")?($F = '<option value="F" selected="selected">F</option>'):($F = '<option value="F">F</option>');
				
				echo $M." ".$F;
			?>
            </select>
            </td>
            <td class="der bold">Edad:&nbsp;</td>
            <td><input name="edad" type="text" class="inpuTextCnt" id="edad" value="<?php echo $rowSrc['edad']; ?>"></td>
          </tr>
          <tr>
            <td class="der bold">Material Enviado:&nbsp;</td>
            <td colspan="3"><input name="materialEnviado" type="text" class="inpuTextCnt" id="materialEnviado" value="<?php echo $rowSrc['materialEnviado']; ?>"></td>
           </tr>
          <tr>
            <td class="der bold">Estudio Solicitado:&nbsp;</td>
            <td><select name="estudioSolicitado" id="estudioSolicitado" class="inpuTextCnt">
              <?php
				($rowSrc["estudioSolicitado"] == "CITOLOGIA")?($cit = '<option value="Citologia" selected="selected">Citologia</option>'):($cit = '<option value="Citologia">Citologia</option>');
				($rowSrc["estudioSolicitado"] == "PATOLOGIA")?($pat = '<option value="Patologia" selected="selected">Patologia</option>'):($pat = '<option value="Patologia">Patologia</option>');
				
				echo $cit." ".$pat;
			?>
            </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
           </tr>
          <tr>
            <td class="der bold">Diagn&oacute;stico Cl&iacute;nico&nbsp;</td>
            <td colspan="3"><input name="diagnosticoClinico" type="text" class="inpuTextCnt" id="diagnosticoClinico" value="<?php echo $rowSrc['diagnosticoClinico']; ?>"></td>
           </tr>
          <tr>
            <td class="der bold">Biopsia o Citolog&iacute;a anterior:&nbsp;</td>
            <td colspan="3"><input name="bioCitBefore" type="text" class="inpuTextCnt" id="bioCitBefore" value="<?php echo $rowSrc['bioCitBefore']; ?>"></td>
           </tr>
          <tr>
            <td class="der bold">F.U.R&nbsp;</td>
            <td><input name="FUR" type="text" class="inpuTextCnt" id="FUR" value="<?php echo $rowSrc['FUR']; ?>"></td>
            <td class="der bold">Ritmo:&nbsp;</td>
            <td><input name="ritmo" type="text" class="inpuTextCnt" id="ritmo" value="<?php echo $rowSrc['ritmo']; ?>"></td>
          </tr>
          <tr>
            <td class="der bold">Embarazo:&nbsp;</td>
            <td>
              	<select name="embarazo" id="embarazo" class="inpuTextCnt">
                	<?php
						($rowSrc["embarazo"] == "No")?($No = '<option value="No" selected="selected">No</option>'):($No = '<option value="No">No</option>');
						($rowSrc["embarazo"] == "Si")?($Si = '<option value="Si" selected="selected">Si</option>'):($Si = '<option value="Si">Si</option>');
						echo $No." ".$Si;
					?>
                    
                    
            	</select>
            </td>
            <td class="der bold">Semanas&nbsp;</td>
            <td><input name="semanas" type="text" class="inpuTextCnt" id="semanas" value="<?php echo $rowSrc['semanas']; ?>"></td>
          </tr>
          <tr>
            <td colspan="4">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="20%" rowspan="2">
                    	<canvas id="circleDisplay">
                        	Tu navegador No soporta Canvas, favor de actualizarlo
                        </canvas>
                    </td>
                    <td width="10%" class="der bold">Metrorragia:&nbsp;</td>
                    <td width="25%"><input name="metrorragia" type="text" class="inpuTextCnt" id="metrorragia" value="<?php echo $rowSrc['metrorragia']; ?>"></td>
                    <td width="20%" class="der bold">Leucorrea:&nbsp;</td>
                    <td width="25%"><input name="leucorrea" type="text" class="inpuTextCnt" id="leucorrea" value="<?php echo $rowSrc['leucorrea']; ?>"></td>
                  </tr>
                  <tr>
                    <td class="der bold">Ulceracion:&nbsp;</td>
                    <td><input name="ulceracion" type="text" class="inpuTextCnt" id="ulceracion" value="<?php echo $rowSrc['ulceracion']; ?>"></td>
                    <td class="der bold">Tumor Cervical:&nbsp;</td>
                    <td><input name="tumorCervical" type="text" class="inpuTextCnt" id="tumorCervical" value="<?php echo $rowSrc['tumorCervical']; ?>"></td>
                  </tr>
                </table>
            </td>
           </tr>
          <tr>
            <td class="der bold">Tratamiento Hormonal tipo y Dosis:&nbsp;</td>
            <td><input name="tratHormonal" type="text" class="inpuTextCnt" id="tratHormonal" value="<?php echo $rowSrc['tratHormonal']; ?>"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Datos Clinicos:&nbsp;</td>
            <td><input name="datosClinicos" type="text" class="inpuTextCnt" id="datosClinicos" value="<?php echo $rowSrc['datosClinicos']; ?>"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Radiaciones&nbsp;</td>
            <td><input name="radiaciones" type="text" class="inpuTextCnt" id="radiaciones" value="<?php echo $rowSrc['radiaciones']; ?>"></td>
            <td class="der bold">Electrocoagulaci&oacute;n:</td>
            <td><input name="electrocoagulacion" type="text" class="inpuTextCnt" id="electrocoagulacion" value="<?php echo $rowSrc['electrocoagulacion']; ?>"></td>
          </tr>
          <tr>
            <td class="der bold">Nombre Solicitante:&nbsp;</td>
            <td colspan="2"><input name="nombreSolicitante" type="text" class="inpuTextCnt" id="nombreSolicitante" value="<?php echo $rowSrc['nombreSolicitante']; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Apellido Paterno:&nbsp;</td>
            <td colspan="2"><input name="apPaternoSolicitante" type="text" class="inpuTextCnt" id="apPaternoSolicitante" value="<?php echo $rowSrc['apPaternoSolicitante']; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Apellido Materno:&nbsp;</td>
            <td colspan="2"><input name="apMaternoSolicitante" type="text" class="inpuTextCnt" id="apMaternoSolicitante" value="<?php echo $rowSrc['apMaternoSolicitante']; ?>"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
            <input name="hdPos" type="hidden" id="hdPos" value="<?php echo $position; ?>">
            <input type="hidden" name="hdMod" id="hdMod" value="<?php echo $mod; ?>">
            <input type="hidden" name="hdRegistro" id="hdRegistro" value="<?php echo $idRegistro; ?>"></td>
            <td><input type="submit" class="submitBtn bigBtn" value="<?php echo $btn; ?>" />&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		</form>
    </section><!-- contenedorCuerpo -->
    
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
    
</section><!-- contenedorPrincipal -->
</body>
</html>