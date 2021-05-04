<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: century gothic;
            color: #444
        }

        h1 {
            padding: 12px;
        }

        div {
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <?php
    $conex = mysqli_connect("localhost","root","","stockmaker");
    
    if ($conex) {
        $consulta = "SELECT * FROM reg_posicionado";
        $resultado = mysqli_query($conex,$consulta);
        if ($resultado) {
            while ($row = $resultado->fetch_array()) {
            $id = $row['id'];
            $fecha_hora = $row['fecha_hora'];
            $tipo_accion = $row['tipo_accion'];
            $cantidad_producto = $row['cantidad_producto'];
            $posicionadoId = $row['posicionadoId'];
            $usuarioId = $row['usuarioId'];
            ?>
            <div>
                <p>
                    <b>ID: </b> <?php echo $id ?><br>
                    <b>Fecha y hora: </b> <?php echo $fecha_hora ?><br>
                    <b>Tipo de acción: </b> <?php echo $tipo_accion ?><br>
                    <b>Cantidad de productos: </b> <?php echo $cantidad_producto ?><br>
                    <b>ID posición: </b> <?php echo $posicionadoId ?><br>
                    <b>ID usuario: </b> <?php echo $usuarioId ?><br>
                </p>
            </div> 
            <?php
            }
        }
    }
    ?>
</body>
</html>