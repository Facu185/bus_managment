<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["addRoute"])) {
        $id_linea = $_POST["lines"];
        $id_linea = htmlspecialchars($id_linea, ENT_QUOTES, 'UTF-8');
        $tramo_anterior = $_POST["tramoAnterior"];
        $tramo_anterior = htmlspecialchars($tramo_anterior, ENT_QUOTES, 'UTF-8');
        $tramo_agregar = $_POST["tramoAgregar"];
        $tramo_agregar = htmlspecialchars($tramo_agregar, ENT_QUOTES, 'UTF-8');
        $origen_tramo = $_POST["origenTramo"];
        $origen_tramo = htmlspecialchars($origen_tramo, ENT_QUOTES, 'UTF-8');
        $destino_tramo = $_POST["destinoTramo"];
        $destino_tramo = htmlspecialchars($destino_tramo, ENT_QUOTES, 'UTF-8');

        if (empty($id_linea) || empty($tramo_anterior) || empty($tramo_agregar) || empty($origen_tramo) || empty($destino_tramo) || $id_linea == "Seleccione la linea a modificar" || $tramo_anterior == "Seleccione el tarmo anterior del recorrido" || $tramo_agregar == "Seleccione el tarmo a agregar") {
            echo '<script>alert("Falatan agregar datos"); window.location.href = "../pages/addNewRoute.php"; </script>';
            exit;
        }
        if(!filter_var($id_linea, FILTER_VALIDATE_INT)){
            echo '<script>alert("La linea solo puede contener numeros"); window.location.href = "../pages/addNewRoute.php"; </script>';
            exit;
        }
        if(!filter_var($tramo_anterior, FILTER_VALIDATE_INT)){
            echo '<script>alert("El tramo anterior solo puede contener numeros"); window.location.href = "../pages/addNewRoute.php"; </script>';
            exit;
        }
        if(!filter_var($tramo_agregar, FILTER_VALIDATE_INT)){
            echo '<script>alert("El tramo a agregar solo puede contener numeros"); window.location.href = "../pages/addNewRoute.php"; </script>';
            exit;
        }
       

        $query = "SELECT ID_tramo FROM recorre WHERE ID_tramo =:tramo_agregar";
        $sql = $conn->prepare($query);
        $sql->bindParam(":tramo_agregar", $tramo_agregar, PDO::PARAM_INT);
        $sql->execute();
        $tramo_repetido = $sql->fetch(PDO::FETCH_ASSOC);
        if (!empty($tramo_repetido)) {
            echo '<script>alert("Este tramo ya esta en esta linea"); window.location.href = "../pages/addNewRoute.php"; </script>';
            exit;
        }

        $query = "SELECT orden_tramos FROM recorre WHERE ID_tramo =:tramo_anterior";
        $sql = $conn->prepare($query);
        $sql->bindParam(":tramo_anterior", $tramo_anterior, PDO::PARAM_INT);
        $sql->execute();
        $orden_tramos = $sql->fetch(PDO::FETCH_ASSOC);
        $orden = $orden_tramos["orden_tramos"];
        $orden = $orden + 1;



        $query = "SELECT MAX(orden_tramos) FROM recorre WHERE ID_linea = :id_linea";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->execute();
        $tramos = $sql->fetch(PDO::FETCH_ASSOC);
        $ultimo_orden = $tramos["MAX(orden_tramos)"];

        for ($i = $ultimo_orden + 1; $i >= $orden + 1; $i--) {
            $orden_anterior = $i - 1;
            $query = "UPDATE recorre SET orden_tramos=:i WHERE ID_linea=:id_linea AND orden_tramos=:orden_anterior";
            $sql = $conn->prepare($query);
            $sql->bindParam(":i", $i, PDO::PARAM_INT);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->bindParam(":orden_anterior", $orden_anterior, PDO::PARAM_INT);
            $sql->execute();

        }
        $query = "INSERT INTO recorre (ID_linea, ID_tramo, origen_tramo, destino_tramo, orden_tramos) VALUES (:id_linea, :tramo_agregar, :origen_tramo, :destino_tramo, :orden)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":tramo_agregar", $tramo_agregar, PDO::PARAM_INT);
        $sql->bindParam(":origen_tramo", $origen_tramo, PDO::PARAM_STR);
        $sql->bindParam(":destino_tramo", $destino_tramo, PDO::PARAM_STR);
        $sql->bindParam(":orden", $orden, PDO::PARAM_INT);
        $sql->execute();
        echo '<script>alert("Recorrido modificado con exito"); window.location.href = "../pages/addNewRoute.php"; </script>';

    }

} catch (Exception $error) {
    discordErrorLog('Error al anadir otro tramo al recorrido' . $tramo_agregar, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>