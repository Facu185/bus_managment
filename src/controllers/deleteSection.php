<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["deleteSection"])) {
        $parada_origen = $_POST["numeroParadaOrigen"];
        $parada_origen = htmlspecialchars($parada_origen, ENT_QUOTES, 'UTF-8');
        $parada_destino = $_POST["numeroParadaDestino"];
        $parada_destino = htmlspecialchars($parada_destino, ENT_QUOTES, 'UTF-8');
       
        if(empty($parada_origen) || empty($parada_destino) || $parada_origen == "Parada de origen del tramo" || $parada_destino == "Parada de destino del tramo"){
            echo '<script>alert("Falta completar datos"); window.location.href = "../pages/deleteSection.php"; </script>';
            exit;
        }
        if(!filter_var($parada_origen,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de parada no valido"); window.location.href = "../pages/deleteSection.php"; </script>';
            exit;
        }
        if(!filter_var($parada_destino,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de parada no valido"); window.location.href = "../pages/deleteSection.php"; </script>';
            exit;
        }
        $query = "SELECT ID_tramo
        FROM tramo
        WHERE numero_parada_1 IN (:parada_origen)
        OR numero_parada_2 IN (:parada_destino)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":parada_origen", $parada_origen, PDO::PARAM_INT);
        $sql->bindParam(":parada_destino", $parada_destino, PDO::PARAM_INT);
        $sql->execute();
        $id = $sql->fetchAll(PDO::FETCH_ASSOC);
        $id_tramo = $id[0]["ID_tramo"];
        $query = "DELETE FROM recorre WHERE ID_tramo=:id_tramo";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
        $sql->execute();

        $query = "DELETE FROM tramo WHERE ID_tramo=:id_tramo";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
        $sql->execute();

        echo '<script>alert("El tramo ah sido eliminado con exito"); window.location.href = "../pages/deleteSection.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al eliminar tramo' . $id_tramo, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>