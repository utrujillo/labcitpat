<?php
include_once("scripts/access.php");
$access = new Access("R,S");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Imagenes del Paciente</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css">
<link href="css/colorbox.css" type="text/css" rel="stylesheet" />
<link href="css/custom-theme/jquery-ui-1.8.16.custom.css" type="text/css" rel="stylesheet" />
<link href="css/jquery.fileupload-ui.css" type="text/css" rel="stylesheet" />


<style>
#frontpage header{
	height:205px;
}
</style>
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type='text/javascript' src="js/jquery.fileupload.js"></script>
<script type='text/javascript' src="js/jquery.fileupload-ui.js"></script>
<script type='text/javascript' src="js/jquery.tmpl.min.js"></script>
<script type='text/javascript' src="js/jquery.colorbox.js"></script>
<script>
$(function(){
	 'use strict';
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload();
	$('.refresh')
		.button({
			 icons: {
					primary: "ui-icon-refresh"
				}
		})
		.click(function(){
			window.location.reload();
		}
	);
		
	$("a[rel='showImg']").colorbox();
});
</script>
<body id="frontpage">
<section id="contenedorPrincipal">
	<header>
    	<h1 id='logoPrincipal'><a>Laboratorio</a></h1>       
    </header>

	<section id="contenedorCuerpo" class="frmSmall">
    <div id="fileupload">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input name="hdValue" id="hdValue" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
            <div class="fileupload-buttonbar">
                <label class="fileinput-button">
                    <span>Agregar...</span>
                    <input type="file" name="files[]" multiple>
                </label>
                <button type="submit" class="start">Iniciar Subida</button>
                <button type="reset" class="cancel">Cancelar Subida</button>
                 <button type="button" class="refresh">Recargar</button>
            </div>
        </form>
        <div class="fileupload-content">
            <table class="files"></table>
            <div class="fileupload-progressbar"></div>
        </div>
	</div>
    <script id="template-upload" type="text/x-jquery-tmpl">
		<tr class="template-upload{{if error}} ui-state-error{{/if}}">
			<td class="preview"></td>
			<td class="name">${name}</td>
			<td class="size">${sizef}</td>
			{{if error}}
				<td class="error" colspan="2">Error:
					{{if error === 'maxFileSize'}}File is too big
					{{else error === 'minFileSize'}}File is too small
					{{else error === 'acceptFileTypes'}}Filetype not allowed
					{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
					{{else}}${error}
					{{/if}}
				</td>
			{{else}}
				<td class="progress"><div></div></td>
				<td class="start"><button>Start</button></td>
			{{/if}}
			<td class="cancel"><button>Cancel</button></td>
		</tr>
	</script>
	<script id="template-download" type="text/x-jquery-tmpl">
		<tr class="template-download{{if error}} ui-state-error{{/if}}">
			{{if error}}
				<td></td>
				<td class="name">${name}</td>
				<td class="size">${sizef}</td>
				<td class="error" colspan="2">Error:
					{{if error === 1}}File exceeds upload_max_filesize (php.ini directive)
					{{else error === 2}}File exceeds MAX_FILE_SIZE (HTML form directive)
					{{else error === 3}}File was only partially uploaded
					{{else error === 4}}No File was uploaded
					{{else error === 5}}Missing a temporary folder
					{{else error === 6}}Failed to write file to disk
					{{else error === 7}}File upload stopped by extension
					{{else error === 'maxFileSize'}}File is too big
					{{else error === 'minFileSize'}}File is too small
					{{else error === 'acceptFileTypes'}}Filetype not allowed
					{{else error === 'maxNumberOfFiles'}}Max number of files exceeded
					{{else error === 'uploadedBytes'}}Uploaded bytes exceed file size
					{{else error === 'emptyResult'}}Empty file upload result
					{{else}}${error}
					{{/if}}
				</td>
			{{else}}
				<td class="preview">
					{{if thumbnail_url}}
						<a href="${url}" target="_blank"><img src="${thumbnail_url}"></a>
					{{/if}}
				</td>
				<td class="name">
					<a>${name}</a>
				</td>
				<td class="size">${sizef}</td>
				<td colspan="2"></td>
			{{/if}}
			<td class="delete">
				&nbsp;
			</td>
		</tr>
	</script>
    <table width="100%" id="toPaginate" class="table">
			<caption>Relacion de Fotografias</caption>
			<thead>
				<tr>
                    <th scope="col" width="12%">No. Fotografia</th>
                    <th scope="col" width="13%">Ver Fotografia</th>
                    <th scope="col" width="80%">Nombre de la Fotografia</th>
			 	</tr>
			</thead>	
			<tbody> 
				<?php
                $path = "uploads/".$_REQUEST["id"];
                $conta = 1;
				if(is_dir($path)){
					if ($handle = opendir($path)) {
						/* This is the correct way to loop over the directory. */
						while (false !== ($file = readdir($handle))) {
							if($file != "." && $file != ".."){
								
								$enlace = '<p>';
								$enlace .= '<a href="'. $path."/".$file .'" rel="showImg" title="Imagen '. $conta .'" >';
								$enlace .= '&nbsp;Ver Imagen&nbsp;</a></p>';
								
								if($conta%2 == 0){
									echo '<tr class="odd">';
										echo '<td class="cen">'. $conta .'</td>';
										echo '<td class="cen">'. $enlace .'</td>';
										echo '<td>'. $file .'</td>';
									echo '</tr>';
								}else{
									echo '<tr>';
										echo '<td class="cen">'. $conta .'</td>';
										echo '<td class="cen">'. $enlace .'</td>';
										echo '<td>'. $file .'</td>';
									echo '</tr>';
								}
							$conta++;
							}
						}
						closedir($handle);
					}
				}else{
					echo '<tr>';
						echo '<td  colspan="3" class="cen">Este paciente no cuenta con Fotografias</td>';
					echo '</tr>';
				}
                ?>
       		</tbody>
			<tfoot>
				<tr>
					<td colspan="3">&nbsp;</td>
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