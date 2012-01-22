<!DOCTYPE HTML>
<html>
<head>
<title>Laboratorio de Citologia y Patologia S.A de C.V</title>
<link href="css/styleIni.css" rel="stylesheet" type="text/css" />
<link href="css/default/default.css" rel="stylesheet" type="text/css" />
<link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />
</head>
<script type='text/javascript' src="js/jquery-1.6.2.min.js"></script>
<script type='text/javascript' src="js/jquery.boxShow.js"></script>
<script type='text/javascript' src="js/jquery.utcValidationForm.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script>
$(function(){
	$("#box").boxShow();
    $("form").utcValidationForm({ showTips: false });
});
$(window).load(function(){ // starts executing after all images have loaded to ensure best performance
	$('#slider').nivoSlider();
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
                <h2>Acerca De</h2>
                <p style="text-align: left;"><img class="alignleft" src="img/photo.png" />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam vel turpis. Duis sit amet lectus ac mauris porta viverra. Aliquam erat volutpat. Praesent ipsum pede, pretium sed, congue nec, pretium quis, urna. Suspendisse dignissim, elit in ultrices sollicitudin, nisl est accumsan orci, a venenatis dui mi porta pede. Aenean et pede quis est tincidunt varius.</p>
                <p>Cras aliquet. Integer faucibus, eros ac molestie placerat, enim tellus varius lacus, nec dictum nunc tortor id urna. Suspendisse dapibus ullamcorper pede. Vivamus ligula ipsum, faucibus at, tincidunt eget, porttitor non, dolor. Ut dui lectus, ultrices ut, sodales tincidunt, viverra sed, nisl.</p>
<p><img src="img/photo.png" class="alignright" />Praesent ac quam vulputate felis ultrices scelerisque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In in arcu. Vestibulum eget nisi quis tellus elementum dapibus. Cras facilisis venenatis libero. Nunc accumsan viverra augue. Suspendisse potenti. Suspendisse eleifend. Maecenas sit amet justo.</p>
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