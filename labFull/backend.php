<?php
function validar_campos($nombre, $primer_apellido, $segundo_apellido, $email, $login, $password)
{
    if (!preg_match("/^[a-zA-Z\s]*$/", $nombre) || !preg_match("/^[a-zA-Z\s]*$/", $primer_apellido) || !preg_match("/^[a-zA-Z\s]*$/", $segundo_apellido)) {
        return "Nombre y apellidos deben contener solo letras y espacios.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El formato de correo electrónico no es válido.";
    }

    if (strlen($password) < 4 || strlen($password) > 8) {
        return "La contraseña debe tener entre 4 y 8 caracteres.";
    }

    return "";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "labfull";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST["nombre"];
$primer_apellido = $_POST["primer_apellido"];
$segundo_apellido = $_POST["segundo_apellido"];
$email = $_POST["email"];
$login = $_POST["login"];
$password = $_POST["password"];

$validacion = validar_campos($nombre, $primer_apellido, $segundo_apellido, $email, $login, $password);

if ($validacion !== "") {
    echo $validacion;
    echo '<br><a href="frontend.html">Volver al registro</a>';
} else {
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "El email ya está registrado. Por favor, intente con otro email.";
        echo '<a href="frontend.html">Volver al registro</a>';
   
    } else {
        $sql = "INSERT INTO usuarios (nombre, primer_apellido, segundo_apellido, email, login, password)
                VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$email', '$login', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro completado con éxito";
            echo '<br><a href="frontend.html">Volver al registro</a>';
            echo '<br><a href="consulta.php">Consulta</a>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
