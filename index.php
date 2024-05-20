<?php

// Datos de conexión a la base de datos
$host = 'localhost:33068'; // Cambia esto si tu base de datos no está en tu mismo servidor
$usuario = 'root'; // Cambia esto por el nombre de usuario de tu base de datos
$contraseña = 'root'; // Cambia esto por la contraseña de tu base de datos
$base_datos = 'mysql80'; // Cambia esto por el nombre de tu base de datos

// Intenta conectarte a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verifica si hubo un error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT * FROM functionn";
$resultado = $conexion->query($sql);

// Comprobar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
    // Crear la tabla HTML
    echo "<table border='1'>";
    echo "<h1> MySql 8  connection test";
    echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Created At</th><th>Updated At</th></tr>";
    // Recorrer los resultados y mostrar cada fila en la tabla
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['name'] . "</td>";
        echo "<td>" . $fila['description'] . "</td>";
        echo "<td>" . $fila['created_at'] . "</td>";
        echo "<td>" . $fila['updated_at'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron registros en la tabla 'function'.";
}

$conexion->close();