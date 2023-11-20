<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["modifyRoute"])) {
        $id_linea = $_POST["lines"];
        $patron = "/^[a-zA-Z0-9]+$/";
        $id_linea = htmlspecialchars($id_linea, ENT_QUOTES, 'UTF-8');
        if(!filter_var($id_linea,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de linea no valido"); window.location.href = "../pages/modifyRoute.php"; </script>';
            exit;
        }
        $id_tramo = $_POST["numeroParadaOrigen"];
        $id_tramo = htmlspecialchars($id_tramo, ENT_QUOTES, 'UTF-8');
        if(!filter_var($id_tramo,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de parada no es valido"); window.location.href = "../pages/modifyRoute.php"; </script>';
            exit;
        }
        $origen_tramo = $_POST["origenTramo"];
        $origen_tramo = htmlspecialchars($origen_tramo, ENT_QUOTES, 'UTF-8');
        if(!filter_var($origen_tramo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Origen de tramo no valido"); window.location.href = "../pages/modifyRoute.php"; </script>';
            exit;
        }
        $destino_tramo = $_POST["destinoTramo"];
        $destino_tramo = htmlspecialchars($destino_tramo, ENT_QUOTES, 'UTF-8');
        if(!filter_var($destino_tramo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("Destino de tramo no valido"); window.location.href = "../pages/modifyRoute.php"; </script>';
            exit;
        }
        if (empty($id_linea) || empty($id_tramo) || empty($origen_tramo) || empty($destino_tramo) || !is_numeric($id_tramo) || !is_numeric($id_linea)) {
            echo '<script>alert("Falatan completar campos"); window.location.href = "../pages/modifyRoute.php"; </script>';
        }
        $query = "SELECT ID_tramo FROM recorre WHERE ID_linea=:id_linea AND ID_tramo=:id_tramo";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
        $sql->execute();
        $verificar = $sql->fetch(PDO::FETCH_ASSOC);
        if(empty($verificar)){
            echo '<script>alert("El tramo seleccionado no exite para esta linea"); window.location.href = "../pages/modifyRoute.php"; </script>';
        }
        $query = "UPDATE recorre SET origen_tramo=:origen_tramo, destino_tramo=:destino_tramo WHERE ID_linea=:id_linea AND ID_tramo=:id_tramo";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
        $sql->bindParam(":origen_tramo", $origen_tramo, PDO::PARAM_STR);
        $sql->bindParam(":destino_tramo", $destino_tramo, PDO::PARAM_STR);
        $sql->execute();
        echo '<script>alert("Recorrido editado con exito"); window.location.href = "../pages/modifyRoute.php"; </script>';
    }
    if (!empty($_POST["deleteRoute"])) {
        $id_linea = $_POST["lines"];
        $id_linea = htmlspecialchars($id_linea, ENT_QUOTES, 'UTF-8');
        if(!filter_var($id_linea,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de linea no valido"); window.location.href = "../pages/modifyRoute.php"; </script>';
            exit;
        }
        $id_tramo = $_POST["numeroParadaOrigen"];
        $id_tramo = htmlspecialchars($id_tramo, ENT_QUOTES, 'UTF-8');
        if(!filter_var($id_tramo,  FILTER_VALIDATE_INT)){
            echo '<script>alert("Numero de parada no es valido"); window.location.href = "../pages/modifyRoute.php"; </script>';
            exit;
        }
        if (empty($id_linea) || empty($id_tramo) || !is_numeric($id_tramo) || !is_numeric($id_linea)) {
            echo '<script>alert("Falatan completar campos"); window.location.href = "../pages/modifyRoute.php"; </script>';
        }
        $query = "SELECT ID_tramo FROM recorre WHERE ID_linea=:id_linea AND ID_tramo=:id_tramo";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
        $sql->execute();
        $verificar = $sql->fetch(PDO::FETCH_ASSOC);
        if(empty($verificar)){
            echo '<script>alert("El tramo seleccionado no exite para esta linea"); window.location.href = "../pages/modifyRoute.php"; </script>';
        }
        $query = "DELETE FROM recorre WHERE ID_linea=:id_linea AND ID_tramo=:id_tramo";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
        $sql->execute();
        echo '<script>alert("Recorrido eliminado con exito"); window.location.href = "../pages/modifyRoute.php"; </script>';
    }

} catch (Exception $error) {
    discordErrorLog('Error al modificar recorrido'. $id_linea, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>