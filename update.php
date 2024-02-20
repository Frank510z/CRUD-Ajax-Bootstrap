<?php
include 'conection.php'; // Incluye el archivo de conexión a la base de datos

$idato = $_POST['id']; // Obtiene el ID del usuario desde el formulario

$sql = "SELECT * FROM usuario where id='" . $idato . "'"; // Crea la consulta SQL para obtener los datos del usuario
$data = mysqli_query($conexion, $sql); // Ejecuta la consulta SQL
$row = mysqli_fetch_assoc($data); // Obtiene la fila de resultados como un array asociativo

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">


    <script>
        function Modificar() {

            var id_usuario = $('#id_usuario').val();
            var nombre = $('#nombre').val();
            var apellido = $('#apellido').val();
            var edad = $('#edad').val();
            var nacimiento = $('#nacimiento').val();

            // Validación básica de campos
            if (nombre.trim() === '' || apellido.trim() === '' || edad.trim() === '' || nacimiento.trim() === '') {
                swal("¡Error!", "Por favor, complete todos los campos.", "error");
                return;
            }

            var parametros = {
                "id_usuario": id_usuario,
                "nombre": nombre,
                "apellido": apellido,
                "edad": edad,
                "nacimiento": nacimiento,
            };

            // Deshabilitar el botón mientras se procesa la solicitud
            $('#botonEditar').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "update_logic.php",
                data: parametros,

                success: function(data) {
                    swal("¡Éxito!", "Registro Editado", "success");

                    // Limpiar el formulario después de agregar el usuario
                    //$('#EditarUsuario')[0].reset();

                    setTimeout(function() {
                        window.location.replace(
                            "index.php"
                        ); // Redirigir al índice después de cerrar la alerta de éxito
                    }, 900);
                },
                error: function(xhr, status, error) {
                    swal("¡Error!", "Ocurrió un error al procesar la solicitud .Inténtelo de nuevo más tarde.",
                        "error");

                },
                complete: function() {
                    // Habilitar el botón después de que se complete la solicitud (ya sea éxito o error)
                    $('#botonEditar').prop('disabled', false);
                }
            });
        }
    </script>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">EDITAR USUARIO</h2>

                <form name="EditUsuario" id="EditarUsuario" method="POST" action="">

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_usuario" placeholder="Escribe tu nombre..." name="id_usuario" value="<?php echo $row['id'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Escribe tu nombre..." name="nombre" value="<?php echo $row['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Apellidos:</label>
                        <input type="text" class="form-control" id="apellido" placeholder="Escribe tu apellido..." name="apellido" value="<?php echo $row['apellido'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Edad:</label>
                        <input type="number" class="form-control" id="edad" placeholder="Escribe tu edad..." name="edad" value="<?php echo $row['edad'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Nacimiento:</label>
                        <input type="date" class="form-control" id="nacimiento" name="nacimiento" value="<?php echo $row['nacimiento'] ?>">
                    </div>
                    <button type="button" id="botonEditar" class="btn btn-info btn-block" onclick="Modificar()">EDITAR</button>
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
