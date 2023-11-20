<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["lookClient"])) {
        $email= $_POST["clientEmail"];
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        if(!filter_var($email,  FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("Email no valido"); window.location.href = "../pages/clients.php"; </script>';
            exit;
        }
        if(empty($email)){
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/clients.php"; </script>';
            exit;
        }

        $query = "SELECT * FROM usuario WHERE email =:email";
        $sql = $conn->prepare($query);
        $sql->bindParam(":email", $email, PDO::PARAM_STR);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        if(empty($usuario)){
            echo '<script>alert("El usuario no existe"); window.location.href = "../pages/clients.php"; </script>';
            exit;
        }

        $_SESSION["usuario"] = $usuario;

       header("Location: ../pages/clients.php");
    }
} catch (Exception $error) {
    discordErrorLog('Error al buscar cliente' . $email, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>