<!DOCTYPE HTML>
<html>
<head>
<title>Laboratorio de Citologia y Patologia S.A de C.V</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css" />
<link href="css/googleButtons.css" rel="stylesheet" type="text/css" />
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery.transition.js"></script>
<script type='text/javascript' src="js/jquery.boxShow.js"></script>
<script type='text/javascript' src="js/jquery.utcValidationForm.js"></script>
<script>
$(function(){
	$("#sendForm").utcValidationForm();
	$("#box").boxShow();
});

$(window).load(function(){ 
	$("#transicion").transitionTool({
		block_size	: 80,
		duration	: 1000,
		display_for	: 10000
	}); //Poner menos de 6000 en duracion puede ocasionar errores
});
</script>
<body id="frontpage">
<section id="contenedorPrincipal">
	<header>
    	<h1 id='logoPrincipal'><a>Laboratorio</a></h1>
        <nav>
        	<?php include_once("scripts/menuPrincipal.php"); ?>
        </nav>
        
         <?php include_once("scripts/transicion.php"); ?>
         
    </header>
    <!--			Termino de la parte superior de la pagina				-->
    <div id="contenedorCuerpo">
    	<div class="barraLateral">
        	<div class="widget widget_text">			
          		<div class="textwidget"><strong>This Text</strong> is applied via sidebar text widgets. The theme comes with basic styles for all built in Wordpress Widgets!<br/><br/>

			<img src="img/Untitled-3.png" />

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex



				</div>
			</div>
        </div><!-- fin sideBar -->
        
        
        <article>
       
        	<div class="articuloContenido">
            <form id="sendForm" name="sendForm" method="post">
        	  <table width="570" border="0" cellspacing="0" cellpadding="0">
        	    <tr height="50">
        	      <td class="bold der">Nombre Completo:&nbsp;</td>
        	      <td><input name="textfield" type="text" class="inpuTextCnt required" id="nombreCompleto" size="50"></td>
      	      </tr>
        	    <tr height="50">
        	      <td class="bold der">Correo Electronico:&nbsp;</td>
        	      <td><input name="eMail" type="text" class="inpuTextCnt required regExp" id="eMail" size="50"></td>
      	      </tr>
        	    <tr height="50">
        	      <td class="bold der" valign="top">Mensaje:&nbsp;</td>
        	      <td><textarea name="textarea" rows="5" class="txtArea required" id="mensaje"></textarea></td>
      	      </tr>
        	    <tr height="50">
        	      <td colspan="2" align="right">&nbsp;</td>
       	        </tr>
        	    <tr>
        	      <td>&nbsp;</td>
        	      <td><input type="submit" class="submitBtn bigBtn" value="Enviar" /></td>
      	      </tr>
        	    <tr>
        	      <td>&nbsp;</td>
        	      <td>&nbsp;</td>
      	      </tr>
      	    </table>
            </form>
            </div>
        </article>
        <div class="limpiar"></div>
    </div><!-- fin de contenedorCuerpo -->
    
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
</section>

<?php include_once("scripts/boxLogin.php"); ?>
</body>
</html>