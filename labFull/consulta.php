<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labfull";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Primer apellido</th><th>Segundo apellido</th><th>Email</th><th>Login</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["nombre"]. "</td><td>" . $row["primer_apellido"]. "</td><td>" . $row["segundo_apellido"]. "</td><td>" . $row["email"]. "</td><td>" . $row["login"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

$conn->close();
?>

<a href="frontend.html">Volver al registro</a>
