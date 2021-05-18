<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
   $conex = mysqli_connect("localhost","root","","stockmaker_inv");
?>

<?php include_once('layouts/header.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escaner QR</title>
    <style>
        #preview{
            width:500px;
            height: 500px;
            margin:0px auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" 
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" 
            crossorigin="anonymous"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
      <div class="panel-body">
                <div class="et_pb_code_inner"></div>
                
                <div class="et_pb_module et_pb_code et_pb_code_1">
                    <div class="et_pb_code_inner">
                        <video id="preview"></video>
                    </div>
                </div>
                
                <div class="et_pb_module et_pb_code et_pb_code_2">
                    <div class="et_pb_code_inner">
                        <script type="text/javascript">
                            var scanner = new Instascan.Scanner({
                                video: document.getElementById('preview'), 
                                scanPeriod: 5, 
                                mirror: false, 
                                refractoryPeriod: 10000 
                            });
                            scanner.addListener('scan',function(content){
                                //alert(content);
                                //window.open(content);
                                window.location.href=content;
                            });
                            Instascan.Camera.getCameras().then(function (cameras){
                                if(cameras.length>0){
                                    scanner.start(cameras[0]);
                                    $('[name="options"]').on('change',function(){
                                        if($(this).val()==1) {
                                            if(cameras[0]!=""){
                                                scanner.start(cameras[0]);
                                            }else{
                                                alert('No Front camera found!');
                                            }
                                        }else if($(this).val()==2){
                                            if(cameras[1]!=""){
                                                scanner.start(cameras[1]);
                                            }else{
                                                alert('No Back camera found!');
                                            }
                                        }
                                    });
                                }else{
                                    console.error('No cameras found.');
                                    alert('No cameras found.');
                                }
                            }).catch(function(e){
                                console.error(e);
                                alert(e);
                            });
                        </script>
                        <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                            <label class="btn btn-primary active">
                            <input type="radio" name="options" value="1" autocomplete="off" checked="">
                                Front Camera 
                            </label>
                            <label class="btn btn-secondary">
                            <input type="radio" name="options" value="2" autocomplete="off">
                                Back Camera
                            </label>
                        </div>
                    </div>
                </div>

        <div class="panel-body">
      
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
  <?php include_once('layouts/footer.php'); ?>
