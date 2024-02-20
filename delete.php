<?php
include 'conection.php'; // Incluir el archivo de conexión a la base de datos

$idato = $_POST['id'];  // Obtener el ID del usuario a eliminar del formulario POST

$sql = "SELECT * FROM usuario where id='" . $idato . "'";  // Crear la consulta SQL para seleccionar el usuario a eliminar
$data = mysqli_query($conexion, $sql);
$row = mysqli_fetch_assoc($data);  // Obtener los datos del usuario seleccionado

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Incluir SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Incluir jQuery y Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Document</title>

    <script>
        function Eliminar() {
            var id_usuario = $('#id_usuario').val();  // Obtener el ID del usuario a eliminar

            // Validación básica de campos
            if (id_usuario.trim() === '') {
                return;
            }

            var parametros = {
                "id_usuario": id_usuario,
            };

            // Deshabilitar el botón mientras se procesa la solicitud
            $('#botonAgregar').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "delete_logic.php",
                data: parametros,

                success: function(data) {
                    // Mostrar alerta de éxito utilizando SweetAlert2
                    Swal.fire({
                        icon: "success",
                        title: "ELIMINACION EXITOSA",
                        position: "top",
                        showConfirmButton: false,
                    });

                    // Limpiar el formulario después de eliminar el usuario
                    $('#eliminarUsuario')[0].reset();

                    // Redirigir al índice después de cerrar la alerta de éxito
                    setTimeout(function() {
                        window.location.replace("index.php");
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    // Mostrar alerta de error utilizando SweetAlert2
                    Swal.fire({
                        icon: "error",
                        title: "ERROR",
                        position: "top",
                        text: "Ocurrió un error al procesar la solicitud. Inténtelo de nuevo más tarde."
                    });
                },
                complete: function() {
                    // Habilitar el botón después de que se complete la solicitud (ya sea éxito o error)
                    $('#botonAgregar').prop('disabled', false);
                }
            });
        }
    </script>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">MODIFICAR USUARIO</h2>

                <form name="fregistro" id="eliminarUsuario" method="POST" action="">

                    <div class="form-group">
                        <!-- Input oculto para almacenar el ID del usuario -->
                        <input type="hidden" class="form-control" id="id_usuario" placeholder="Escribe tu nombre..." name="id_usuario" value="<?php echo $row['id'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Nombre:</label>
                        <!-- Mostrar el nombre del usuario -->
                        <input type="text" class="form-control" id="nombre" placeholder="Escribe tu nombre..." name="nombre" value="<?php echo $row['nombre'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Apellidos:</label>
                        <!-- Mostrar el apellido del usuario -->
                        <input type="text" class="form-control" id="apellido" placeholder="Escribe tu apellido..." name="apellido" value="<?php echo $row['apellido'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Edad:</label>
                        <!-- Mostrar la edad del usuario -->
                        <input type="number" class="form-control" id="edad" placeholder="Escribe tu edad..." name="edad" value="<?php echo $row['edad'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Nacimiento:</label>
                        <!-- Mostrar la fecha de nacimiento del usuario -->
                        <input type="date" class="form-control" id="nacimiento" name="nacimiento" value="<?php echo $row['nacimiento'] ?>" readonly>
                    </div>
                    <!-- Botón para eliminar el usuario -->
                    <button type="button" id="botonAgregar" class="btn btn-danger btn-block" onclick="Eliminar()">ELIMINAR</button>
<br>
                    <div class="text-center">
                        <a href="index.php">Regresar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>

</html>