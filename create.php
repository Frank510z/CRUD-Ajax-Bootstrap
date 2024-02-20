<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR USUARIO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">AGREGAR USUARIO</h2>
                <form name="fregistro" id="crearUsuario" method="POST" action="">
                    <div class="form-group">
                        <label for="email">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Escribe tu nombre..." name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="email">Apellidos:</label>
                        <input type="text" class="form-control" id="apellido" placeholder="Escribe tu apellido..." name="apellido">
                    </div>
                    <div class="form-group">
                        <label for="email">Edad:</label>
                        <input type="number" class="form-control" id="edad" placeholder="Escribe tu edad..." name="edad">
                    </div>
                    <div class="form-group">
                        <label for="email">Nacimiento:</label>
                        <input type="date" class="form-control" id="nacimiento" name="nacimiento">
                    </div>
                    <button type="button" id="botonAgregar" class="btn btn-success btn-block" onclick="Registrarse()">AGREGAR</button>
                    <br>

                    <div class="text-center">
                        <a href="index.php">Regresar</a>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        function Registrarse() {
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
                "nombre": nombre,
                "apellido": apellido,
                "edad": edad,
                "nacimiento": nacimiento,
            };

            // Deshabilitar el botón mientras se procesa la solicitud
            $('#botonAgregar').prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "create_logic.php",
                data: parametros,
                success: function(data) {
                    swal("¡Éxito!", "Registro Registrado", "success");

                    // Limpiar el formulario después de agregar el usuario
                    $('#crearUsuario')[0].reset();

                    window.location.replace("index.php"); // Redirigir al índice después de cerrar la alerta de éxito

                },
                error: function(xhr, status, error) {
                    swal("¡Error!", "Ocurrió un error al procesar la solicitud. Inténtelo de nuevo más tarde.", "error");
                },
                complete: function() {
                    // Habilitar el botón después de que se complete la solicitud (ya sea éxito o error)
                    $('#botonAgregar').prop('disabled', false);
                }
            });
        }
    </script>
</body>

</html>