<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sign_In()
{


    function sendDiscord($url, $message_content)
    {
        $message = [
            'content' => $message_content,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
    }
    ;


    try {

        include_once "../controllers/discordErrorLog.php";
        require "../database/db.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["loginButton"])) {
                if (empty($_POST["email"]) || empty($_POST["password"])) {
                    throw new Exception("Faltan completar datos", 400);
                }
                $patron = "/^[a-zA-Z0-9]+$/";
                $email = $_POST["email"];
                $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo '<script>alert("El email no es valido"); window.location.href = "../pages/login.php"; </script>';
                    exit;
                }
                $password = $_POST["password"];
                $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
                if (!filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))) {
                    echo '<script>alert("La contraseña no es valida"); window.location.href = "../pages/login.php"; </script>';
                    exit;
                }
                $query = "SELECT * FROM usuario WHERE email = :email";
                $sql = $conn->prepare($query);
                $sql->bindParam(":email", $email, PDO::PARAM_STR);
                $sql->execute();
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                if (!isset($_SESSION['contador']) || $_SESSION['contador'] >= 4) {
                    $lastAttempt = isset($_SESSION['last_attempt']) ? $_SESSION['last_attempt'] : 0;
                    $currentTime = time();

                    if ($currentTime - $lastAttempt < 30) {
                        throw new Exception("Demasiados intentos fallidos, espere un momento...", 404);
                        exit;
                    } else {
                        $_SESSION['contador'] = 0;
                        $_SESSION['last_attempt'] = $currentTime;
                    }
                }
                if (empty($data)) {
                    $_SESSION['contador']++;
                    $_SESSION['last_attempt'] = time();
                    throw new Exception("Alguno de los campos es invalido", 404);
                }

                if (!password_verify($password, $data["passwd"])) {
                    $_SESSION['contador']++;
                    $_SESSION['last_attempt'] = time();
                    throw new Exception("Alguno de los campos es invalido", 403);
                }
                $loginData = $data;
                $ID_usuario = $data["ID_usuario"];
                $ID_usuario = htmlspecialchars($ID_usuario, ENT_QUOTES, 'UTF-8');
                if (!filter_var($ID_usuario, FILTER_VALIDATE_INT)) {
                    throw new Exception("Alguno de los campos es invalido", 404);
                }

                $query = "SELECT ID_rol FROM usuario_rol WHERE ID_usuario = :ID_usuario";
                $sql = $conn->prepare($query);
                $sql->bindParam(":ID_usuario", $ID_usuario, PDO::PARAM_INT);
                $sql->execute();
                $rol = $sql->fetch(PDO::FETCH_ASSOC);
                $id_rol = $rol["ID_rol"];
                $id_rol = htmlspecialchars($id_rol, ENT_QUOTES, 'UTF-8');
                if (!filter_var($id_rol, FILTER_VALIDATE_INT)) {
                    throw new Exception("Alguno de los campos es invalido", 404);
                }
                if ($id_rol == 2 || $id_rol == 1 && $data["activo"] == 0) {
                    setcookie("login", "login", time() + 7200, "", "", true, true);
                    $_SESSION["login"] = array();
                    $_SESSION["login"] = $loginData;
                    $_SESSION["rol"] = $id_rol;
                    sendDiscord('https://discord.com/api/webhooks/1173406653232722011/DgwXDGfRxTYTu0FRoImDRDJEvDbl2r3WrfgFCwcDuy4Zpt2lfJBca1Xu7oHhBQbPfPbO', 'Ingreso de sesión admin: Email: ' . $email . 'Nombre: ' . $loginData['nombre'] . 'Apellido: ' . $loginData['apellido'] . 'Celular: ' . $loginData['celular'] . ' - Activo: ' . $data["activo"]);
                    header("location:../pages/dashboard.php");
                } else {
                    $_SESSION['contador']++;
                    $_SESSION['last_attempt'] = time();
                    echo '<script>alert("No se pudo iniciar sesion"); window.location.href = "../pages/login.php"; </script>';
                }
            }

        }

    } catch (Exception $error) {
        discordErrorLog('Error en inicio de sesion, el email ' . $email, $error);
        echo '<script>alert("' . $error->getMessage() . '"); window.location.href = "../pages/login.php";</script>';
    }
}
sign_In();
$conn = null;
?>