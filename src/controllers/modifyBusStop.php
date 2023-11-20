<?php 
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["modifyBusStop"])) {
        $numero_parada = $_POST["numeroParadaOrigen"];
        $patron = "/^[a-zA-Z0-9]+$/";
        $numero_parada = htmlspecialchars($numero_parada, ENT_QUOTES, 'UTF-8');
        $localizacion = $_POST["localizacion"];
        $localizacion = htmlspecialchars($localizacion, ENT_QUOTES, 'UTF-8');
        $latitud = $_POST["latitud"];
        $latitud = htmlspecialchars($latitud, ENT_QUOTES, 'UTF-8');
        $latitud = htmlspecialchars($latitud, ENT_QUOTES, 'UTF-8');
        $longitud = $_POST["longitud"];
        $longitud = htmlspecialchars($longitud, ENT_QUOTES, 'UTF-8');
      
        if(empty($numero_parada) || empty($localizacion) || empty($latitud) || empty($longitud) || $numero_parada == "Seleccione la parada a modificar") {
            echo '<script>alert("Falta completar campos"); window.location.href = "../pages/modifyBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($numero_parada,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de parada no valido"); window.location.href = "../pages/modifyBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($localizacion, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Localizacion no valida"); window.location.href = "../pages/modifyBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($latitud, FILTER_VALIDATE_FLOAT)){
            echo '<script>alert("La latitud solo puede contener numeros"); window.location.href = "../pages/modifyBusStop.php"; </script>';
            exit;
        }
        if(!filter_var($longitud, FILTER_VALIDATE_FLOAT)){
            echo '<script>alert("La longitud solo puede contener numeros"); window.location.href = "../pages/modifyBusStop.php"; </script>';
            exit;
        }

        $query = "UPDATE parada SET Localizacion=:localizacion, latitud=:latitud, longitud=:longitud WHERE Numero_parada=:numero_parada";
        $sql = $conn->prepare($query);
        $sql->bindParam(":localizacion", $localizacion, PDO::PARAM_STR);
        $sql->bindParam(":latitud", $latitud, PDO::PARAM_INT);
        $sql->bindParam(":longitud", $longitud, PDO::PARAM_INT);
        $sql->bindParam(":numero_parada", $numero_parada, PDO::PARAM_INT);
        $sql->execute();

        echo '<script>alert("Parada modificada con exito"); window.location.href = "../pages/modifyBusStop.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al modificar parada' . $numero_parada, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>