<?php
    $page_title = 'Generador QR';
    require_once('includes/load.php');
    // Checkin What level user has permission to view this page
    page_require_level(3);
?>
<?php include_once('layouts/header.php'); ?>
<head>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/qrcode.js"></script>
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

				<form onsubmit="generate();return false;">
					<input type="text" id="qr" name="">
				</form>
				<a href="product.php" class="btn btn-primary">Invetario</a>

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
			</div>
        </div>
    </div>
</div>
</body>