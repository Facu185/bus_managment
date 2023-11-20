<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["addBusStop"])) {
        $numero_parada = $_POST["numeroParada"];
        $numero_parada = htmlspecialchars($numero_parada, ENT_QUOTES, 'UTF-8');
        $patron = "/^[a-zA-Z0-9]+$/";
        $localizacion = $_POST["localizacion"];
        $localizacion = htmlspecialchars($localizacion, ENT_QUOTES, 'UTF-8');
        $latitud = $_POST["latitud"];
        $latitud = htmlspecialchars($latitud, ENT_QUOTES, 'UTF-8');
        $longitud = $_POST["longitud"];
        $longitud = htmlspecialchars($longitud, ENT_QUOTES, 'UTF-8');
        if (empty($numero_parada) || empty($localizacion) || empty($latitud) || empty($longitud)) {
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/addBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($numero_parada, FILTER_VALIDATE_INT)){
            echo '<script>alert("El numero de parada solo puede contener numeros"); window.location.href = "../pages/addBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($longitud, FILTER_VALIDATE_FLOAT)){
            echo '<script>alert("La longitud solo puede contener numeros"); window.location.href = "../pages/addBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($localizacion, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("La localizacion solo puede contener letras y numeros"); window.location.href = "../pages/addBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($latitud, FILTER_VALIDATE_FLOAT)){
            echo '<script>alert("La latitud solo puede contener numeros"); window.location.href = "../pages/addBusStop.php"; </script>';
            exit;
        }

        $query = "SELECT Numero_parada FROM parada WHERE numero_parada = :numero_parada";
        $sql = $conn->prepare($query);
        $sql->bindParam(":numero_parada", $numero_parada, PDO::PARAM_INT);
        $sql->execute();
        $id = $sql->fetch(PDO::FETCH_ASSOC);
        $id_parada = $id["Numero_parada"];
        if ($id_parada == $numero_parada) {
            echo '<script>alert("Esta parada ya existe"); window.location.href = "../pages/addBusStop.php"; </script>';
        }

        $query = "INSERT INTO parada (Numero_parada, Localizacion, latitud, longitud) VALUES (:numero_parada, :localizacion, :latitud, :longitud)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":numero_parada", $numero_parada, PDO::PARAM_INT);
        $sql->bindParam(":localizacion", $localizacion, PDO::PARAM_STR);
        $sql->bindParam(":latitud", $latitud, PDO::PARAM_INT);
        $sql->bindParam(":longitud", $longitud, PDO::PARAM_INT);
        $sql->execute();

        echo '<script>alert("Parada añadida con exito"); window.location.href = "../pages/addBusStop.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al anadir parada' . $numero_parada, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>