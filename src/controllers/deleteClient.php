<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["deleteClient"])) {
        $email = $_POST["clientEmail"];
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        if(!filter_var($email,  FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("El email no es valido"); window.location.href = "../pages/clients.php"; </script>';
            exit;
        }
        $id_usuario = $_SESSION["usuario"]["ID_usuario"];
        $id_usuario = htmlspecialchars($id_usuario, ENT_QUOTES, 'UTF-8');
        $query = "SELECT ID_rol FROM usuario_rol WHERE ID_usuario =:id_usuario";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sql->execute();
        $rol = $sql->fetch(PDO::FETCH_ASSOC);
        print_r($rol);
        $id_rol = $rol["ID_rol"];
        if ($id_rol == 3) {
            $query = "UPDATE usuario SET activo = 1 WHERE email =:email";
            $sql = $conn->prepare($query);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->execute();
            unset($_SESSION["usuario"]);
        } elseif ($id_rol == 2 && $_SESSION["rol"] == 1) {
            $query = "UPDATE usuario SET activo = 1 WHERE email =:email";
            $sql = $conn->prepare($query);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->execute();
            unset($_SESSION["usuario"]);
        }
        echo '<script>alert("Usuario eliminado con exito"); window.location.href = "../pages/clients.php"; </script>';
    }
    if (!empty($_POST["activateClient"])) {
        $email = $_POST["clientEmail"];
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        if(!filter_var($email,  FILTER_VALIDATE_EMAIL)){
            echo '<script>alert("El email no es valido"); window.location.href = "../pages/clients.php"; </script>';
            exit;
        }
        $id_usuario = $_SESSION["usuario"]["ID_usuario"];
        $id_usuario = htmlspecialchars($id_usuario, ENT_QUOTES, 'UTF-8');
    
        $query = "SELECT ID_rol FROM usuario_rol WHERE ID_usuario =:id_usuario";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sql->execute();
        $rol = $sql->fetch(PDO::FETCH_ASSOC);
    
        $id_rol = $rol["ID_rol"];
        if ($id_rol == 3) {
            $query = "UPDATE usuario SET activo = 0 WHERE email =:email";
            $sql = $conn->prepare($query);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->execute();
            unset($_SESSION["usuario"]);
        } elseif ($id_rol == 2 && $_SESSION["rol"] == 1) {
            $query = "UPDATE usuario SET activo = 0 WHERE email =:email";
            $sql = $conn->prepare($query);
            $sql->bindParam(":email", $email, PDO::PARAM_STR);
            $sql->execute();
            unset($_SESSION["usuario"]);
        }
        echo '<script>alert("Usuario activado con exito"); window.location.href = "../pages/clients.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al eliminar o activar usuario' . $email, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>