<?php
//conexion a la base de datos
$conexion = new mysqli('localhost','root','12345678','crud');

//test de conexion
if(mysqli_connect_error()){
    //echo "error al conectar a la BD el error es: ".mysqli_connect_error();
    echo "x";
}else {
    //echo "CONEXION EXITOSAS a la BD";
    echo "º";
}
?>
