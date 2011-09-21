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
	$("#box").boxShow();
	$("#sendLogin").utcValidationForm({
		showTips  	: false
	});
});
$(window).load(function(){ // starts executing after all images have loaded to ensure best performance
	$("#transicion").transitionTool({
		block_size	: 80,
		duration	: 1000,
		display_for	: 10000
	}); //dont set lower then 6000 or it will produce errors
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
    <section id="contenedorCuerpo">
    	<div class="caja">
            <div class="cajaImage"><img src="img/Untitled-2.png" alt="" /></div>
                    <h2>Titulo 1</h2>
                    <p>Una p&aacute;gina web est&aacute; compuesta principalmente por informaci&oacute;n (s&oacute;lo texto y/o m&oacute;dulos multimedia) as&iacute; como por hiperenlaces</p>
					<p>as p&aacute;ginas web son escritas en un lenguaje de marcado que provee la capacidad de manejar e insertar hiperenlaces, generalmente HTML</p>
        </div>
        
        <div class="caja">
            <div class="cajaImage"><img src="img/Untitled-3.png" alt="" /></div>
                    <h2>Titulo 2</h2>
                    <p>Una p&aacute;gina web est&aacute; compuesta principalmente por informaci&oacute;n (s&oacute;lo texto y/o m&oacute;dulos multimedia) as&iacute; como por hiperenlaces</p>
					<p>as p&aacute;ginas web son escritas en un lenguaje de marcado que provee la capacidad de manejar e insertar hiperenlaces, generalmente HTML</p>
        </div>
        
        <div class="caja caja3">
            <div class="cajaImage"><img src="img/Untitled-4.png" alt="" /></div>
                    <h2>Titulo 2</h2>
                    <p>Una p&aacute;gina web est&aacute; compuesta principalmente por informaci&oacute;n (s&oacute;lo texto y/o m&oacute;dulos multimedia) as&iacute; como por hiperenlaces</p>
					<p>as p&aacute;ginas web son escritas en un lenguaje de marcado que provee la capacidad de manejar e insertar hiperenlaces, generalmente HTML</p>
        </div>
        <div class="limpiar"></div>
    </section><!-- fin de contenedorCuerpo -->
    
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
</section>

<?php include_once("scripts/boxLogin.php"); ?>
</body>
</html>