<?php
include_once("scripts/access.php");
$access = new Access("R,S");

	include_once("scripts/conecta.inc.php");
	$db = $_SESSION["db"];
	$conexion = new Conexion($db);
		
		$idFind = $_REQUEST["id"];
		$sqlFind = "select * from registrotbl where idRegistro = ".$idFind;
		$dataFind = $conexion->consulta($sqlFind);
		$rowFind = $dataFind->fetch_array(MYSQLI_ASSOC);
		
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Laboratorio de Citologia y Patologia S.A de C.V - Red Interna</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css" />
<link href="css/googleButtons.css" rel="stylesheet" type="text/css" />
<style>
#frontpage header{
	height:205px;
}
.textBlack{
	color:#000;
}
</style>
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script>
$(function(){
	var canvas = document.getElementById("circleDisplay");
	var c = canvas.getContext('2d');
	var img = new Image();
	var position = $("#position").val().split("|");
	
	var color = "#BC1010",
		tam = 10;
	
	img.src = "img/selection2.png";
	
	img.onload = function(){
		c.drawImage(img,0,0);
		
		c.fillStyle = color;
		for(var i=0; i < position.length; i++){
			var posXY = position[i].split(",");
			c.beginPath();
			c.arc(posXY[0], posXY[1], tam, 0, Math.PI*2, true); 
			c.closePath;
			c.fill();
		}
	  }
});
</script>
<body id="frontpage">

<section id="contenedorPrincipal">
<header>
    	<h1 id='logoPrincipal'><a>Laboratorio</a></h1>
        <nav>
        	&nbsp;
        </nav>        
  </header>

	<section id="contenedorCuerpo" class="frmSmall">
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="der bold">Clave:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["claveFolio"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="30%" class="der bold">Fecha de Registro:&nbsp;</td>
            <td width="35%" class="textBlack"><?php echo $rowFind["fechaRecepcion"]; ?></td>
            <td width="10%" class="textBlack">&nbsp;</td>
            <td width="25%">&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Nombre:&nbsp;</td>
            <td colspan="2" class="textBlack"><?php echo $rowFind["nombre"]." ".$rowFind["apellidoPaterno"]." ".$rowFind["apellidoMaterno"]; ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Sexo:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["sexo"]; ?></td>
            <td class="der bold">Edad:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["edad"]; ?></td>
          </tr>
          <tr>
            <td class="der bold">Material Enviado:&nbsp;</td>
            <td colspan="3" class="textBlack"><?php echo $rowFind["materialEnviado"]; ?></td>
           </tr>
          <tr>
            <td class="der bold">Estudio Solicitado:&nbsp;</td>
            <td colspan="3" class="textBlack"><?php echo $rowFind["estudioSolicitado"]; ?></td>
           </tr>
          <tr>
            <td class="der bold">Diagn&oacute;stico Cl&iacute;nico&nbsp;</td>
            <td colspan="3" class="textBlack"><?php echo $rowFind["diagnosticoClinico"]; ?></td>
           </tr>
          <tr>
            <td class="der bold">Biopsia o Citolog&iacute;a anterior:&nbsp;</td>
            <td colspan="3" class="textBlack"><?php echo $rowFind["bioCitBefore"]; ?></td>
           </tr>
          <tr>
            <td class="der bold">F.U.R&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["FUR"]; ?></td>
            <td class="der bold">Ritmo:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["ritmo"]; ?></td>
          </tr>
          <tr>
            <td class="der bold">Embarazo:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["embarazo"]; ?></td>
            <td class="der bold">Semanas&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["semanas"]; ?></td>
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
                    <td width="25%" class="textBlack"><?php echo $rowFind["metrorragia"]; ?></td>
                    <td width="20%" class="der bold">Leucorrea:&nbsp;</td>
                    <td width="25%" class="textBlack"><?php echo $rowFind["leucorrea"]; ?></td>
                  </tr>
                  <tr>
                    <td class="der bold">Ulceracion:&nbsp;</td>
                    <td class="textBlack"><?php echo $rowFind["ulceracion"]; ?></td>
                    <td class="der bold">Tumor Cervical:&nbsp;</td>
                    <td class="textBlack"><?php echo $rowFind["tumorCervical"]; ?></td>
                  </tr>
                </table>
            </td>
           </tr>
          <tr>
            <td class="der bold">Tratamiento Hormonal tipo y Dosis:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["tratHormonal"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Datos Clinicos:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["datosClinicos"]; ?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="der bold">Radiaciones&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["radiaciones"]; ?></td>
            <td class="der bold">Electrocoagulaci&oacute;n:&nbsp;</td>
            <td class="textBlack"><?php echo $rowFind["electrocoagulacion"]; ?></td>
          </tr>
          <tr>
            <td class="der bold">Nombre Solicitante:&nbsp;</td>
            <td colspan="2" class="textBlack"><?php echo $rowFind["nombreSolicitante"]." ".$rowFind["apPaternoSolicitante"]." ".$rowFind["apMaternoSolicitante"]; ?></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="position" id="position" type="hidden" value="<?php echo $rowFind["imgLocation"]; ?>"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
	</section><!-- contenedorCuerpo -->
    
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
    
</section><!-- contenedorPrincipal -->
</body>
</html>