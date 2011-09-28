<!DOCTYPE HTML>
<html>
<head>
<title>Laboratorio de Citologia y Patologia S.A de C.V</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css" />
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery.transition.js"></script>
<script>
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
    <div id="contenedorCuerpo">
    	<div class="barraLateral">
          <?php include_once("scripts/subMenu.php"); ?>
        </div><!-- fin sideBar -->
        <article>
        	<div class="articuloContenido">
                <h2>Misi&oacute;n</h2>
                <p style="text-align: left;">Brindar el diagn&oacute;stico (histopatol&oacute;gico y  citol&oacute;gico) de las piezas quir&uacute;rgicas y frotis preciso  y oportuno  a nuestros clientes, a m&eacute;dicos independientes y laboratorios de referencia,  garantizando la prontitud necesaria reconociendo el valor del diagnóstico para el tratamiento adecuado.</p>
                <h2>Visi&oacute;n</h2>
                <p style="text-align: left;">Queremos ser el laboratorio de preferencia con el servicio  m&aacute;s oportuno, confiable a trav&eacute;s del procesamiento eficiente en el análisis de las muestras, desarrollando todas las técnicas y metodologías necesarias y actuales para otorgar un diagn&oacute;stico certero en el tiempo m&iacute;nimo necesario. </p>
                <h2>Valores</h2>
                <p>
                    <ul>
                        <li>&Eacute;tica M&eacute;dica</li>
                        <li>Confiabilidad y presici&oacute;n en el diagn&oacute;stico</li>
                        <li>Capacidad Laboral</li>
                    </ul>
                </p>
            </div>
        </article>
        <div class="limpiar"></div>
    </div><!-- fin de contenedorCuerpo -->
    
    <footer>
    	Vasco Nu&ntilde;ez de Balboa y Malaespina, Despacho 106 - 107 | Tel. 485 11 45 Acapulco, Gro. <br />
        correo-electronico: marior8a@hotmail.com
    </footer>
</section>
</body>
</html>