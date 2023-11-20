<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    function validarEmail($email)
    {
        $patron = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($patron, $email)) {
            return true;
        } else {
            return false;
        }
    }
    function validarSinNumeros($cadena)
    {
        $patron = '/^[^\d]+$/';
        return preg_match($patron, $cadena);
    }


    if (!empty($_POST["registerButton"])) {
        if (empty($_POST["registerName"]) || empty($_POST["registerLastName"]) || empty($_POST["registerPhone"]) || empty($_POST["registerEmail"]) || empty($_POST["registerPassword"])) {
            throw new Exception("Faltan completar datos", 400);
        }
        $nombre = $_POST["registerName"];
        $patron2 = "/^[a-zA-Z0-9]+$/";
        $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        if (!filter_var($nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron2)))) {
            throw new Exception("El nombre no es valido", 400);
        }
        $apellido = $_POST["registerLastName"];
        $apellido = htmlspecialchars($apellido, ENT_QUOTES, 'UTF-8');
        if (!filter_var($apellido, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron2)))) {
            throw new Exception("El apellido no es valido", 400);
        }
        if (!validarSinNumeros($nombre) || !validarSinNumeros($apellido))
            throw new Exception("El nombre o apellido no deben contener caracteres especiales", 400);
        $telefono = $_POST["registerPhone"];
        $telefono = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
        if (strlen($telefono) !== 9)
            throw new Exception("El telefono debe contener 9 numeros", 400);
        $email = $_POST["registerEmail"];
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        if (!validarEmail($email))
            throw new Exception("Email invalido", 400);
        $password = $_POST["registerPassword"];
        $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
        if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron2)))) {
            throw new Exception("La contraseña no es valida", 400);
        }
        if (strlen($password) < 8)

            throw new Exception("La contraseña debe contener minimo 8 carcteres", 400);

        $passwordCifrada = password_hash($password, PASSWORD_DEFAULT);
        $checkEmail = "SELECT email FROM usuario WHERE email = :email";
        $checkEmail = $conn->prepare($checkEmail);
        $checkEmail->bindParam(":email", $email);
        $checkEmail->execute();
        $checkEmail->fetch(PDO::FETCH_OBJ);
        if ($checkEmail->rowCount() !== 0) {
            throw new Exception("El email que introdujo ya se encuentra registrado.", 409);
        }
        $query = "INSERT IGNORE INTO usuario (nombre, apellido, email, passwd, celular) VALUES (:nombre, :apellido, :email, :passwd, :celular)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $sql->bindParam(":apellido", $apellido, PDO::PARAM_STR);
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->bindParam(":passwd", $passwordCifrada, PDO::PARAM_STR);
        $sql->bindParam(":celular", $telefono, PDO::PARAM_INT);
        $sql->execute();

        $query = "SELECT ID_usuario FROM usuario WHERE email = :email";
        $sql = $conn->prepare($query);
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->execute();
        $id = $sql->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $id["ID_usuario"];
        $id_usuario = htmlspecialchars($id_usuario, ENT_QUOTES, 'UTF-8');
        if (!filter_var($id_usuario, FILTER_VALIDATE_INT)) {
            throw new Exception("El id del usuario no es valido", 400);
        }

        $query = "INSERT INTO usuario_rol (id_rol, id_usuario) VALUES (2, :id_usuario)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sql->execute();
        echo '<script>alert("El administrador fue registrado con exito."); window.location.href = "../pages/register_admin.php";</script>';

    }
} catch (Exception $error) {
   
    echo '<script>alert("' . $error->getMessage() . '"); window.location.href = "../pages/register_admin.php"; </script>';
}
$conn = null;
?>