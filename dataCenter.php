<?php
include_once("scripts/access.php");
$access = new Access("R,S");
	include_once("scripts/conecta.inc.php");
	$db = $_SESSION["db"];
		$conexion = new Conexion($db);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Centro de Datos</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css">
<link href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css">

<style>
#frontpage header{
	height:205px;
}
</style>
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type='text/javascript' src="js/jquery.tablePagination.js"></script>

<script>
$(function(){
	$('#toPaginate').tablePagination({
		rowsPerPage : 10,
		optionsForRows : [10,25,50,100]
	});
	
	$("img").click(function(){
		var toRealize = $(this).attr("class").split(" ");
		var id		= $(this).attr("id");
			switch(toRealize[0]){
				case "viewData": { window.open("viewData.php?id=" + id); } break;
				case "updateData": { 
						window.location = "registro.php?mod="+ id;
					} break;
				case "galleryImage": { 
					window.open("showPicture.php?id="+id);
				} break;
				case "uploadDocument": {
					var data = id.split("|");
					if(data[1] == "CITOLOGIA")
						window.open("citologia.php?id="+ data[0]);
					else
						window.open("patologia.php?id="+ data[0]);
					 } break;
			}
	});
	
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
			<table width="100%" id="toPaginate" class="table">
			<caption>Registro de Pacientes</caption>
			<thead>
				<tr>
                    <th scope="col" width="10%">Clave</th>
                    <th scope="col" width="25%">Nombre del Paciente</th>
                    <th scope="col" width="10%">Fecha de Registro</th>
                    <th scope="col" width="25%">Estudio Solicitado</th>
                    <th scope="col" width="20%">Opcion</th>
			 	</tr>
			</thead>	
			<tbody> 
            <?php
				$sqlFind = "select idRegistro,claveFolio,fechaRecepcion,
									concat(nombre,' ',apellidoPaterno,' ',apellidoMaterno) as nombrePaciente
									,estudioSolicitado 
									from registrotbl";
				$dataFind = $conexion->consulta($sqlFind);
				
				$even = 0;
				while($rowFind = $dataFind->fetch_array(MYSQLI_ASSOC)){
					
					$viewData		= '<img src="img/viewData.gif" class="viewData imgPad" style="cursor:pointer" id="'. $rowFind["idRegistro"] .'" ';
					$viewData		.= ' alt="ver datos del Registro" title="ver datos del Registro" />';
					
					$updateData		= '<img src="img/updateData.png" class="updateData imgPad" style="cursor:pointer" id="'. $rowFind["idRegistro"] .'" ';
					$updateData		.= ' alt="Actualizar Datos del Registro" title="Actualizar Datos del Registro" />';
					
					$showGallery = '<img src="img/pictureSave.png" class="galleryImage imgPad" style="cursor:pointer" id="'. $rowFind["idRegistro"] .'"';
					$showGallery .= ' alt="Ver Galeria de Imagenes" title="Ver Galeria de Imagenes" />';
					
					$uploadDocument = '<img src="img/document.png" class="uploadDocument imgPad" style="cursor:pointer" id="'. $rowFind["idRegistro"].'|'.$rowFind["estudioSolicitado"] .'" ';
					$uploadDocument .= ' alt="Ingresar Resultados" title="Ingresar Resultados" />';
					
					if($even%2 == 0){
						echo '<tr>';
							echo '<td>'. $rowFind["claveFolio"] .'</td>';
							echo '<td>'. htmlentities($rowFind["nombrePaciente"]) .'</td>';
							echo '<td>'. $rowFind["fechaRecepcion"] .'</td>';
							echo '<td>'. $rowFind["estudioSolicitado"] .'</td>';
							echo '<td class="cen">'. 
										$viewData .''. $updateData .''. $uploadPicture .''. 
										$showGallery .''. $uploadDocument
								.'</td>';
						echo '</tr>';
					}else{
						echo '<tr class="odd">';
							echo '<td>'. $rowFind["claveFolio"] .'</td>';
							echo '<td>'. htmlentities($rowFind["nombrePaciente"]) .'</td>';
							echo '<td>'. $rowFind["fechaRecepcion"] .'</td>';
							echo '<td>'. $rowFind["estudioSolicitado"] .'</td>';
							echo '<td class="cen">'. 
										$viewData .''. $updateData .''. 
										$showGallery .''. $uploadDocument
								.'</td>';
						echo '</tr>';
					}
					$even++;
				}
			?>
			</tbody>
<tfoot>
				<tr>
					<td colspan="5">Pacientes Totales&nbsp;&nbsp;<?php echo $even++; ?></td>
				</tr>
			</tfoot>
            </table>
</section><!-- contenedorCuerpo -->
  
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
</section><!-- contenedorPrincipal -->
</body>
</html>