<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["deleteBusStop"])) {
        $parada = $_POST["numeroParadaOrigen"];
        $parada = htmlspecialchars($parada, ENT_QUOTES, 'UTF-8');
        if(!filter_var($parada, FILTER_VALIDATE_INT)){
            echo '<script>alert("La parada solo puede contener numeros"); window.location.href = "../pages/deleteBusStop.php"; </script>';
            exit;
        }
        if(empty($parada) || !is_numeric($parada)) {
            echo '<script>alert("Falta completar campos"); window.location.href = "../pages/deleteBusStop.php"; </script>';
            exit;
        }
        $query = "SELECT ID_tramo
          FROM tramo
          WHERE numero_parada_1 IN (:parada)
          OR numero_parada_2 IN (:parada)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":parada", $parada, PDO::PARAM_INT);
        $sql->bindParam(":parada", $parada, PDO::PARAM_INT);
        $sql->execute();
        $id = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($id as $key => $value) {
            $id_tramo = $id[$key]["ID_tramo"];
            $query = "DELETE FROM recorre WHERE ID_tramo=:id_tramo";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
            $sql->execute();

            $query = "DELETE FROM tramo WHERE ID_tramo=:id_tramo";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
            $sql->execute();
        }

        $query = "DELETE FROM parada WHERE Numero_parada=:parada";
        $sql = $conn->prepare($query);
        $sql->bindParam(":parada", $parada, PDO::PARAM_INT);
        $sql->execute();
        echo '<script>alert("La parada ah sido eliminada con exito"); window.location.href = "../pages/deleteBusStop.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al eliminar parada' . $parada, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>