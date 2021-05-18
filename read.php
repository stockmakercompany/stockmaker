<?php
 include 'connect.php';

 $buscar = $_POST['buscar'];

 $SQL_READ="SELECT p.id,p.name,p.quantity,p.buy_price,p.sale_price,p.media_id,p.date,c.name AS categorie,m.file_name AS image FROM products p LEFT JOIN categories c ON c.id = p.categorie_id
 LEFT JOIN media m ON m.id = p.media_id 
 WHERE (p.name like '%$buscar%')";

 $sql_query= mysqli_query($conn,$SQL_READ);

?>

