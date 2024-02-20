<?php
include 'conection.php';      // Incluir el archivo de conexión a la base de datos

if (isset($_POST['id_usuario'])) {  // Verificar si se recibió el ID del usuario a eliminar

    $id_usuario = mysqli_real_escape_string($conexion, $_POST['id_usuario']);      // Obtener y escapar el ID del usuario a eliminar

    if (empty($id_usuario)) {      // Verificar si el ID del usuario está vacío
        echo "ERROR DE ELIMINACION";
    } else {
        // Crear la consulta SQL para eliminar el usuario
        $sql = "DELETE FROM usuario WHERE id = '" . $id_usuario . "'";
        $data = mysqli_query($conexion, $sql);
        if ($data) {          // Verificar si la eliminación se realizó correctamente
            header("Location: index.php");             // Redirigir al usuario a otra página
        } else {
            
            echo "Error al ELIMINAR el usuario: " . mysqli_error($conexion);               // Mostrar mensaje de error si la eliminación falló
        }
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}

$conexion->close();  // Cerrar la conexión a la base de datos