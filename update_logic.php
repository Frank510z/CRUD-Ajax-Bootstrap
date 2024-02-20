<?php
include 'conection.php';

// Verificar si se recibieron todas las variables necesarias mediante POST
if (isset($_POST['nombre'], $_POST['apellido'], $_POST['edad'], $_POST['nacimiento'], $_POST['id_usuario'])) {

    // Escapar las variables recibidas para evitar inyección SQL
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $edad = mysqli_real_escape_string($conexion, $_POST['edad']);
    $nacimiento = mysqli_real_escape_string($conexion, $_POST['nacimiento']);
    $id_usuario = mysqli_real_escape_string($conexion, $_POST['id_usuario']);

    // Verificar si hay campos vacíos
    if (empty($nombre) || empty($apellido) || empty($edad) || empty($nacimiento)) {
        echo "LLENE LOS CAMPOS VACIOS";
    } else {

        $sql = "UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', edad = '$edad', nacimiento = '$nacimiento' WHERE id='$id_usuario'";     // Construir la consulta SQL para actualizar el usuario

        // Ejecutar la consulta
        $data = mysqli_query($conexion, $sql);
        
        // Verificar si la consulta se ejecutó correctamente
        if ($data) {
            header("location:index.php");     // Redirigir al usuario a la página principal

        } else {
            echo "Error al agregar el usuario: " . mysqli_error($conexion);    // Mostrar un mensaje de error si la consulta falla
        }
    }
} else {

    // Mostrar un mensaje si no se recibieron todos los datos necesarios
    echo "No se recibieron todos los datos necesarios.";
}

$conexion->close();  // Cerrar la conexión a la base de datos
?>
