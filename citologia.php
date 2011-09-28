<?php
include_once("scripts/access.php");
$access = new Access("R,S");

include_once("scripts/conecta.inc.php");
$db = $_SESSION["db"];
$conexion = new Conexion($db);	
	
	$idRegistro = $_REQUEST["id"];
	$sqlSrc = "SELECT * FROM citologiatbl WHERE fk_idRegistro=". $idRegistro;
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
	var concepto = $("#selConcepto"),
		cuerpo	 = $("tbody.toAdd");
	if($("#hdMod").val())
		$("#selConcepto").attr("disabled",true);
	
	$("#addConcept").click(function(){
		if(concepto.val() != 0){
			var hdInput = '<input name="'+ concepto.val() +'" id="'+ concepto.val() +'" type="hidden" value="'+ concepto.val() +'">';
			var nameCal = 'calif'+ concepto.val();
			var input 	= '<input name="'+ nameCal +'" type="text" class="inpuTextCnt">';
			
			cuerpo.append('<tr class="'+ concepto.val() +'">');
			cuerpo.append('<td class="'+ concepto.val() +' cen"><img src="img/del.gif" class="'+ concepto.val() +'" /></td>');
			cuerpo.append('<td class="'+ concepto.val() +' cen">'+ hdInput +''+ concepto.val() +'</td>');
			cuerpo.append('<td class="'+ concepto.val() +'">'+ input +'</td>');
			cuerpo.append('</tr>');
		}	
		
		$("#selConcepto option[value='0']").attr("selected",true);	
	});
	
	$("img").live("click", function(){
		var rm = "."+ $(this).attr("class");
		$(rm).remove();
		
	});
	
	$("#fechaResultadoCit" ).datepicker({
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
.barraLateral{
	margin-right:10px;
	width:320px;
}
</style>
</head>
<body id="frontpage">
<section id="contenedorPrincipal">
<header>
    	<h1 id='logoPrincipal'><a>Laboratorio</a></h1>       
</header>

	<section id="contenedorCuerpo">
    <form method="post" name="sendForm" id="sendForm" action="abcCitologia.php">
    	<div class="barraLateral">
        	
        	<table width="100%" class="table">
            	<thead>
                	<tr>
                    	<th scope="col" width="10%">
                        <th scope="col" width="70%">
                        <select name="selConcepto" id="selConcepto" class="inpuTextCnt">
                            <option value="0">- Seleccionar -</option>
                            <option value="c1">Concepto 1</option>
                            <option value="c2">Concepto 2</option>
							<option value="c3">Concepto 3</option>
                        </select>
                        </th>
                        <th scope="col" width="20%"><input type="button" class="submitBtn" id="addConcept" value="Agregar" /></th>
                    </tr>
                </thead>
                <tbody class="toAdd frmSmall">
                	<?php
						if($mod){
							$sqlFindConcept = "select * from conceptotbl where fk_idCitologia = ". $rowSrc["idCitologia"];
							$dataConcept = $conexion->consulta($sqlFindConcept);
							while($rowConcept = $dataConcept->fetch_array(MYSQLI_ASSOC)){
								
								$input =  '<input name="calif_'. $rowConcept["idConcepto"] .'" type="text" class="inpuTextCnt" value="'. $rowConcept["calificacion"] .'">';
								echo '<tr>';
									echo '<td></td>';
									echo '<td class="cen">'. $rowConcept["concepto"] .'</td>';
									echo '<td>'. $input .'</td>';
								echo '</tr>';
							}
						}
					?>
                </tbody>
            </table>  
        </div>
        <article>
        <div class="articuloContenido">
        	<table width="100%" class="table">
                	<tr>	
                    	<td width="26%" class="der bold">Fecha:&nbsp;</td>
                        <td width="74%"><input value="<?php echo $rowSrc["fechaResultadoCit"]; ?>" name="fechaResultadoCit" type="text" class="inpuTextCnt" id="fechaResultadoCit"></td>
                    </tr>
                	<tr>
                	  <td class="der bold">Calidad de Muestra:&nbsp;</td>
                	  <td><input value="<?php echo $rowSrc["calidadMuestra"]; ?>" name="calidadMuestra" type="text" class="inpuTextCnt" id="calidadMuestra"></td>
              	  </tr>
                	<tr>
                	  <td class="der bold">Valor Estrogenico:&nbsp;</td>
                	  <td><input value="<?php echo $rowSrc["valorEstrogenico"]; ?>" name="valorEstrogenico" type="text" class="inpuTextCnt" id="valorEstrogenico"></td>
              	  </tr>
                	<tr>
                	  <td class="der bold">Resultado:&nbsp;</td>
                	  <td><textarea name="resultado" id="resultado" class="txtArea" style="height:100px; padding:10px 5px;"><?php echo $rowSrc["resultado"]; ?></textarea></td>
              	  </tr>
                	<tr>
                	  <td>
                	    <input name="hdReg" id="hdReg" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
               	      	<input type="hidden" name="hdMod" id="hdMod" value="<?php echo $mod; ?>">
                	  	<input type="hidden" name="idCitologia" id="idCitologia" value="<?php echo $rowSrc["idCitologia"]; ?>">
                	  </td>
                	  <td><input type="submit" class="submitBtn bigBtn" value="<?php echo $btn; ?>" />&nbsp;</td>
              	  </tr>
            </table>
        </div>
        </article>
        </form>
        <div class="limpiar"></div>
  	</section><!-- contenedorCuerpo -->
  
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
</section><!-- contenedorPrincipal -->
</body>
</html>