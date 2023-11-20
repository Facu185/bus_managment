<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["modifyLine"])) {
        $id_linea = $_POST["lines"];
        $patron = "/^[a-zA-Z0-9]+$/";
        $id_linea = htmlspecialchars($id_linea, ENT_QUOTES, 'UTF-8');
        $nombre_linea = $_POST["nombreLinea"];
        $nombre_linea = htmlspecialchars($nombre_linea, ENT_QUOTES, 'UTF-8');
        $origen_linea = $_POST["origenLinea"];
        $origen_linea = htmlspecialchars($origen_linea, ENT_QUOTES, 'UTF-8');
        $destino_linea = $_POST["destinoLinea"];
        $destino_linea = htmlspecialchars($destino_linea, ENT_QUOTES, 'UTF-8');
        
        if(empty($id_linea) || empty($nombre_linea) || empty($origen_linea) || empty($destino_linea) || !is_numeric($id_linea)) {
            echo '<script>alert("Faltan completar campos"); window.location.href = "../pages/modifyLine.php"; </script>';
            exit;
        }
        if(!filter_var($id_linea,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de linea no valido"); window.location.href = "../pages/modifyLine.php"; </script>';
            exit;
        }
        if(!filter_var($nombre_linea, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Nombre de linea no valido"); window.location.href = "../pages/modifyLine.php"; </script>';
            exit;
        }
        if(!filter_var($origen_linea, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Origen de linea no valido"); window.location.href = "../pages/modifyLine.php"; </script>';
            exit;
        }
        if(!filter_var($destino_linea, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Destino de linea no valido"); window.location.href = "../pages/modifyLine.php"; </script>';
            exit;
        }
        $query = "SELECT nombre_linea FROM linea WHERE nombre_linea =:nombre_linea";
        $sql = $conn->prepare($query);
        $sql->bindParam(":nombre_linea", $nombre_linea, PDO::PARAM_STR);
        $sql->execute();
        $linea = $sql->fetch(PDO::FETCH_ASSOC);
        $nombre = $linea["nombre_linea"];
        if ($nombre == $nombre_linea) {
            echo '<script>alert("Esta linea ya existe"); window.location.href = "../pages/modifyLine.php"; </script>';
        }
        if (!empty($nombre_linea) && !empty($origen_linea) && !empty($destino_linea)) {
            $query = "UPDATE linea SET nombre_linea=:nombre_linea, origen_linea=:origen_linea, destino_linea=:destino_linea WHERE Id_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":nombre_linea", $nombre_linea, PDO::PARAM_STR);
            $sql->bindParam(":origen_linea", $origen_linea, PDO::PARAM_STR);
            $sql->bindParam(":destino_linea", $destino_linea, PDO::PARAM_STR);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            echo '<script>alert("Linea modificada con exito"); window.location.href = "../pages/modifyLine.php"; </script>';
        }
        if (!empty($nombre_linea)) {
            $query = "UPDATE linea SET nombre_linea=:nombre_linea WHERE Id_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":nombre_linea", $nombre_linea, PDO::PARAM_STR);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            echo '<script>alert("Linea modificada con exito"); window.location.href = "../pages/modifyLine.php"; </script>';
        }
        if (!empty($origen_linea)) {
            $query = "UPDATE linea SET origen_linea=:origen_linea WHERE Id_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":origen_linea", $origen_linea, PDO::PARAM_STR);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            echo '<script>alert("Linea modificada con exito"); window.location.href = "../pages/modifyLine.php"; </script>';
        }
        if (!empty($origen_linea)) {
            $query = "UPDATE linea SET destino_linea=:destino_linea WHERE Id_linea=:id_linea";
            $sql = $conn->prepare($query);
            $sql->bindParam(":destino_linea", $destino_linea, PDO::PARAM_STR);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->execute();

            echo '<script>alert("Linea modificada con exito"); window.location.href = "../pages/modifyLine.php"; </script>';
        }
    }
} catch (Exception $error) {
    discordErrorLog('Error al mopdificar linea' . $nombre_linea, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>