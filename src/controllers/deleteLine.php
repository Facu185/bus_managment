<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["deleteLine"])) {
        $id_linea = $_POST["lines"];
        print_r($id_linea);
        $id_linea = htmlspecialchars($id_linea, ENT_QUOTES, 'UTF-8');
        
        if(empty($id_linea) || !is_numeric($id_linea)) {
            echo '<script>alert("Falata completar datos"); window.location.href = "../pages/deleteLine.php"; </script>';
            exit;
        }
        
            $query = "DELETE FROM recorre WHERE ID_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            $query = "DELETE FROM horario_asiento WHERE ID_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            $query = "DELETE FROM horario WHERE ID_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            $query = "DELETE FROM trabaja WHERE ID_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            $query = "DELETE FROM linea WHERE ID_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();
      
        echo '<script>alert("La linea ah sido eliminada con exito"); window.location.href = "../pages/deleteLine.php"; </script>';
    }
} catch (Exception $error) {
    discordErrorLog('Error al eliminar linea' . $id_linea, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>