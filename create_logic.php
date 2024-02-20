<?php
// Incluir el archivo de conexión a la base de datos
include 'conection.php';

// Verificar si se enviaron los datos del formulario
if(isset($_POST['nombre'], $_POST['apellido'], $_POST['edad'], $_POST['nacimiento'])) {

    // Obtener los valores del formulario y escaparlos para prevenir inyección de SQL
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $edad = mysqli_real_escape_string($conexion, $_POST['edad']);
    $nacimiento = mysqli_real_escape_string($conexion, $_POST['nacimiento']);

    // Verificar si algún campo está vacío
    if(empty($nombre) || empty($apellido) || empty($edad) || empty($nacimiento)) {
        echo "Por favor, llene todos los campos.";
    } else {
        
        // Crear la consulta SQL para insertar un nuevo usuario en la base de datos
        $sql = "INSERT INTO usuario (nombre, apellido, edad, nacimiento) VALUES ('$nombre', '$apellido', '$edad', '$nacimiento')";
        
        // Ejecutar la consulta SQL
        $data = mysqli_query($conexion, $sql);

        // Verificar si la consulta se ejecutó correctamente
        if ($data) {
            // Redirigir al usuario a otra página si se agregó el usuario exitosamente
            header("Location: index.php");
        } else {
            // Mostrar un mensaje de error si ocurrió un problema al agregar el usuario
            echo "Error al agregar el usuario: " . mysqli_error($conexion);
        }
    }
} else {
    // Mostrar un mensaje si no se recibieron todos los datos necesarios del formulario
    echo "No se recibieron todos los datos necesarios.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
