<?php
include 'conection.php'; // Incluye el archivo de conexión a la base de datos

$sql = "SELECT * FROM usuario"; // Consulta SQL para seleccionar todos los usuarios
$result = mysqli_query($conexion, $sql); // Ejecuta la consulta y guarda el resultado en $result
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>CRUD PHP-MYSQL</h2>

        <div class="row">
            <div class="col-sm-4 offset-8">
                <a href="create.php" class="btn btn-success">Crear Usuario</a> <!-- Enlace para crear un nuevo usuario -->
            </div>
        </div>

        <br>

        <table class="table table-condensed">
            <thead>
                <tr class="success">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Nacimiento</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?> <!-- Itera sobre cada fila del resultado -->
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['edad']; ?></td>
                    <td><?php echo $row['nacimiento']; ?></td>
                    <td>
                        <form action="update.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-info btn-sm">Editar</button> <!-- Botón para editar -->
                        </form>
                        <form action="delete.php" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button> <!-- Botón para eliminar -->
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
