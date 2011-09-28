<?php
include_once("scripts/access.php");
$access = new Access("R,S");

include_once("scripts/conecta.inc.php");
$db = $_SESSION["db"];
$conexion = new Conexion($db);	
	
	$idRegistro = $_REQUEST["id"];
	$sqlSrc = "SELECT * FROM patologiatbl WHERE fk_idRegistro=". $idRegistro;
	$dataSrc = $conexion->consulta($sqlSrc);
	$dataFind = mysqli_num_rows($dataSrc);
	$rowSrc = $dataSrc->fetch_array(MYSQLI_ASSOC);
	if($dataFind > 0){
		$btn = "Actualizar";
		$mod = true;
	}else{
		$btn = "Guardar";
		$mod = false;
	}
		
	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Registro de resultados de Patologia</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css">
<link href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css">
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script>
$(function(){
	$( "#fechaResultadoPat" ).datepicker({
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
			changeYear: true,
			dateFormat: "yy-mm-dd"
		});
});
</script>
<style>
#frontpage header{
	height:205px;
}
</style>
</head>
<body id="frontpage">
<section id="contenedorPrincipal">
<header>
    	<h1 id='logoPrincipal'><a>Laboratorio</a></h1>       
</header>

	<section id="contenedorCuerpo" class="frmSmall">
    	<form method="post" name="sendForm" id="sendForm" action="abcPatologia.php">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>Fecha del Resultado: 
            &nbsp;<input type="text" name="fechaResultadoPat" id="fechaResultadoPat" value="<?php echo $rowSrc['fechaResultadoPat']; ?>" class="inpuTextCnt" style="width:10%">
            </td>
          </tr>
          <tr>
            <td>Descripción Macroscopica:&nbsp;</td>
          </tr>
          <tr>
            <td>
            <textarea name="descMacroscopica" id="descMacroscopica" class="txtArea" style="width:100%; height:100px;"><?php echo $rowSrc['descMacroscopica']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td>Descripción Microscopica:&nbsp;</td>
          </tr>
          <tr>
            <td>
            <textarea name="descMicroscopica" id="descMicroscopica" class="txtArea" style="width:100%; height:100px;"><?php echo $rowSrc['descMicroscopica']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td>Diagnostico:&nbsp;</td>
          </tr>
          <tr>
            <td>
            <textarea name="diagnostico" id="diagnostico" class="txtArea" style="width:100%; height:100px;"><?php echo $rowSrc['diagnostico']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td class="cen">
            <input name="hdReg" id="hdReg" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
            <input type="hidden" name="hdMod" id="hdMod" value="<?php echo $mod; ?>">
            <input type="hidden" name="idPatologia" id="idPatatologia" value="<?php echo $rowSrc["idPatologia"]; ?>">
            <input type="submit" class="submitBtn bigBtn" value="<?php echo $btn; ?>" />&nbsp;</td>
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