<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
   page_require_level(3);

?>

<?php include_once('layouts/header.php'); ?>
<head>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/qrcode.js"></script>
	<script>
		function goback() {
            window.location.href = document.referrer;
 }
	</script>
	
</head>
<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
		<br>
	  <p>
     <script>
              document.write(document.referrer);
      </script>
</p>
    	<form onsubmit="generate();return false;">
					<input type="text" id="qr" name=""> <button onclick="generate();return false;" class="btn btn-primary" >Generar QR</button>	
				</form>
				

				
				<br>
				<br>
				<div id="qrResult" style="height: 300px;width: 300px">
					
				</div>

				<script type="text/javascript">
					var qrcode=new QRCode(document.getElementById('qrResult'),{
						width:300,
						height:300
					});

					function generate(){
						var message=document.getElementById('qr');
						if(!message.value){
							alert("Input a text");
							message.focus();
							return;
						}

						qrcode.makeCode(message.value);
					}

				</script>
				<br>
				<button onclick="goback()" class="btn btn-primary"  >Atrás</button>
			  	<br>
      </div>

    </div>
  </div>
  
  <?php include_once('layouts/footer.php'); ?>
