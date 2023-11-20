<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["modifySection"])) {
        $id_tramo = $_POST["numeroParadaOrigen"];
        $patron = "/^[a-zA-Z0-9]+$/";
        $id_tramo = htmlspecialchars($id_tramo, ENT_QUOTES, 'UTF-8');
        $tipo_tramo = $_POST["tipoTramo"];
        $tipo_tramo = htmlspecialchars($tipo_tramo, ENT_QUOTES, 'UTF-8');
        $distancia = $_POST["distancia"];
        $distancia = htmlspecialchars($distancia, ENT_QUOTES, 'UTF-8');
        $tiempo_viaje = $_POST["tiempoViaje"];
        $calles = $_POST["calles"];
        $calles = htmlspecialchars($calles, ENT_QUOTES, 'UTF-8');
        $rutas = $_POST["rutas"];
        $rutas = htmlspecialchars($rutas, ENT_QUOTES, 'UTF-8');
        if(empty($id_tramo) || empty($tipo_tramo) || empty($distancia) || empty($tiempo_viaje) || empty($calles) || empty($rutas) || $id_tramo == "Seleccione el tramo a modificar" || $tipo_tramo == "Tipo de tramo"){
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/modifySection.php"; </script>';
            exit;
        }
        if(!filter_var($id_tramo,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de parada no es valido"); window.location.href = "../pages/modifySection.php"; </script>';
            exit;
        }
        if(!filter_var($tipo_tramo,  FILTER_VALIDATE_INT)){
            echo '<script>alert("El tipo de tramo no es valido"); window.location.href = "../pages/modifySection.php"; </script>';
            exit;
        }
        if(!filter_var($distancia,  FILTER_VALIDATE_INT)){
            echo '<script>alert("La distancia no es valida"); window.location.href = "../pages/modifySection.php"; </script>';
            exit;
        }
        if(!filter_var($calles, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Las calles no son validas"); window.location.href = "../pages/modifySection.php"; </script>';
            exit;
        }
        if(!filter_var($rutas, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Las rutas no son validas"); window.location.href = "../pages/modifySection.php"; </script>';
            exit;
        }
        if (!empty($tipo_tramo) && !empty($distancia) && !empty($tiempo_viaje) && !empty($calles) && !empty($rutas)) {
            $query = "UPDATE tramo SET tipo_tramo=:tipo_tramo, distancia=:distancia, calles=:calles, rutas=:rutas, tiempo=:tiempo_viaje WHERE ID_tramo = :id_tramo";
            $sql = $conn->prepare($query);
            $sql->bindParam(":tipo_tramo", $tipo_tramo, PDO::PARAM_INT);
            $sql->bindParam(":distancia", $distancia, PDO::PARAM_INT);
            $sql->bindParam(":calles", $calles, PDO::PARAM_STR);
            $sql->bindParam(":rutas", $rutas, PDO::PARAM_STR);
            $sql->bindParam(":tiempo_viaje", $tiempo_viaje, PDO::PARAM_STR);
            $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
            $sql->execute();
            echo '<script>alert("Tramo editado con exito"); window.location.href = "../pages/modifySection.php"; </script>';
        } else {
            if (!empty($tipo_tramo)) {
                $query = "UPDATE tramo SET tipo_tramo=:tipo_tramo WHERE ID_tramo = :id_tramo";
                $sql = $conn->prepare($query);
                $sql->bindParam(":tipo_tramo", $tipo_tramo, PDO::PARAM_INT);
                $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
                $sql->execute();
                echo '<script>alert("Tramo editado con exito"); window.location.href = "../pages/modifySection.php"; </script>';
            }
            if (!empty($distancia)) {
                $query = "UPDATE tramo SET distancia=:distancia WHERE ID_tramo = :id_tramo";
                $sql = $conn->prepare($query);
                $sql->bindParam(":distancia", $distancia, PDO::PARAM_INT);
                $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
                $sql->execute();
                echo '<script>alert("Tramo editado con exito"); window.location.href = "../pages/modifySection.php"; </script>';
            }
            if (!empty($tiempo_viaje)) {
                $query = "UPDATE tramo SET tiempo=:tiempo_viaje WHERE ID_tramo = :id_tramo";
                $sql = $conn->prepare($query);
                $sql->bindParam(":tiempo_viaje", $tiempo_viaje, PDO::PARAM_STR);
                $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
                $sql->execute();
                echo '<script>alert("Tramo editado con exito"); window.location.href = "../pages/modifySection.php"; </script>';
            }
            if (!empty($calles)) {
                $query = "UPDATE tramo SET calles=:calles WHERE ID_tramo = :id_tramo";
                $sql = $conn->prepare($query);
                $sql->bindParam(":calles", $calles, PDO::PARAM_STR);
                $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
                $sql->execute();
            }
            if (!empty($rutas)) {
                $query = "UPDATE tramo SET rutas=:rutas WHERE ID_tramo = :id_tramo";
                $sql = $conn->prepare($query);
                $sql->bindParam(":rutas", $rutas, PDO::PARAM_STR);
                $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
                $sql->execute();
                echo '<script>alert("Tramo editado con exito"); window.location.href = "../pages/modifySection.php"; </script>';
            }
        }
    }

} catch (Exception $error) {
    discordErrorLog('Error al modificar tramo'. $id_tramo, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>