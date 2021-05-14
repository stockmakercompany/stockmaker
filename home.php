<?php
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <link rel="stylesheet" href="assets/css/index_style.css">
	<div class="centrador">
		<div class="contenedor" id="uno">
			<img class="icons" src="pictures/icon1.png">
			<a href="product.php" class="texto">Invetario</a>
		</div>
		<div class="contenedor" id="dos">
			<img class="icons" src="pictures/icon2.png">
		<a href="alerts.php" class="texto">Alertas</a>
		</div>
		<br>
		<br>
		<div class="contenedor" id="tres">
			<img class="icons" src="pictures/icon3.png">
			<a href="scanner-qr.html" class="texto">Escaner QR</a>
		</div>
	
		<div class="contenedor" id="cuatro">
			<img class="icons" src="pictures/icon4.png">
			<a href="historial.php" class="texto">Historial</a>
		</div>
	</div>
     
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
