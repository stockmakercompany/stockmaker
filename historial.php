<?php
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
   page_require_level(1);
   $conex = mysqli_connect("localhost","root","","stockmaker_inv");
?>
<?php include_once('layouts/header.php'); ?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .page {
            display: inline;
        }
            @media screen and (max-width: 400px) {
            table {
                display: block;
                overflow-x: auto;
            }
        }
        div br {
    display: none;
}
  </style>
</head>
<div class="row">

    <div class="col-md-12">
      <div class="panel panel-default">
      <h1 >Historial</h1>
        <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;"> Nombre del producto </th>
                            <th class="text-center" style="width: 10%;"> Hora y fecha </th>
                            <th class="text-center" style="width: 10%;"> Tipo de acción </th>
                            <th class="text-center" style="width: 10%;"> Cantidad </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                if ($conex) {
                                    $consulta = "SELECT * FROM historial";
                                    $resultado = mysqli_query($conex,$consulta);
                                    if ($resultado) {
                                        while ($row = $resultado->fetch_array()) {
                                            $product_name = $row['product_name'];
                                            $fecha_hora = $row['fecha_hora'];
                                            $tipo_accion = $row['tipo_accion'];
                                            $quantity = $row['quantity'];
                                            ?>
                                            <tr> 
                                                <td class="text-center"> <?php echo $product_name ?></td>
                                                <td class="text-center"> <?php echo $fecha_hora ?></td>
                                                <td class="text-center"> <?php echo $tipo_accion  ?></td>
                                                <td class="text-center"> <?php echo $quantity  ?></td>
                                            </tr>
                                            </br>
                                            <?php
                                        }
                                    }
                                }   
                            ;?>
                    </tbody>
                </table>
                </div>

  
  <?php include_once('layouts/footer.php'); ?>
