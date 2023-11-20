<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["deleteBus"])) {
        $matricula = $_POST["matricula"];
        $patron = "/^[a-zA-Z0-9]+$/";
        $matricula = htmlspecialchars($matricula, ENT_QUOTES, 'UTF-8');
        if(!filter_var($matricula, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("La matricula solo puede contener letras y numeros"); window.location.href = "../pages/deleteBus.php"; </script>';
            exit;
        }
        if (empty($matricula) ) {
            echo '<script>alert("Falatan completar campos"); window.location.href = "../pages/deleteBus.php"; </script>';
            exit;
        }
        
        $query = "DELETE FROM caracteristicas WHERE ID_unidad=:matricula";
        $sql = $conn->prepare($query);
        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $sql->execute();

        $query = "SELECT ID_linea FROM horario WHERE ID_unidad=:matricula";
        $sql = $conn->prepare($query);
        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $sql->execute();
        $id = $sql->fetch(PDO::FETCH_ASSOC);
        $id_linea = $id["ID_linea"];

        $query = "DELETE FROM horario WHERE ID_unidad=:matricula AND ID_linea=:id_linea";
        $sql = $conn->prepare($query);
        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->execute();

        $query = "DELETE FROM horario_asiento WHERE ID_unidad=:matricula AND ID_linea=:id_linea";
        $sql = $conn->prepare($query);
        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->execute();

        $query = "DELETE FROM asiento WHERE ID_unidad=:matricula";
        $sql = $conn->prepare($query);
        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $sql->execute();

        $query = "DELETE FROM unidad WHERE ID_unidad=:matricula";
        $sql = $conn->prepare($query);
        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $sql->execute();
        echo '<script>alert("Unidad eliminada con exito"); window.location.href = "../pages/deleteBus.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al eliminar unidad' . $matricula, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>