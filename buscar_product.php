<?php
  $page_title = 'Inventario';
  require_once('includes/load.php');
   page_require_level(3);
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
  </style>
</head>
<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
        <form action="buscar_product.php" method="POST" class="form_search">
          <input type="text" name="buscar"  placeholder="Buscar">
          <input type="submit" value="Buscar" class="btn_search">
        </form>
        </form>
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
           <br>
           <br>
           <a href="categorie.php" class="btn btn-primary">Pocisicion</a>
         </div>
        </div>
        <?php


              ?>

        <div class="panel-body">
        <table class="table table-bordered">
        <thead>
              <tr>
                
                <th> Nombre del producto </th>
                <th> Imagen</th>
                <th class="text-center" style="width: 10%;"> Pocición </th>
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th class="text-center" style="width: 10%;"> Precio de compra </th>
                <th class="text-center" style="width: 10%;"> Precio de venta </th>
                <th class="text-center" style="width: 10%;"> Agregado </th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
                    </thead>
                    <tbody>
                    <?php
                     include 'read.php';

                     while($row= mysqli_fetch_array($sql_query)){  ?>

                     <tr>
                     <td><?= $row['name']?></td>
                     <td>
                     <?php if($row['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $row['image']; ?>" alt="">
                <?php endif; ?>

                     </td>
                     <td class="text-center"><?= $row['categorie']?></td>
                     <td class="text-center"><?= $row['quantity']?></td>
                     <td class="text-center"><?= $row['buy_price']?></td>
                     <td class="text-center"><?= $row['sale_price']?></td>
                     <td class="text-center"><?= $row['date']?></td>
                     <td class="text-center">
                     <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$row['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_product.php?id=<?php echo (int)$row['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                     </td>
                     </tr>   

                     <?php }?>

                  

              <tr>
              
              </tr>


                    </tbody>
                </table>
        </div>
      </div>
    </div>
  </div>
  
  <?php include_once('layouts/footer.php'); ?>
