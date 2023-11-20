<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["eliminarPasaje"])) {
        $id_pasaje = $_POST["idPasaje"];
        $id_pasaje = htmlspecialchars($id_pasaje, ENT_QUOTES, 'UTF-8');
        if(!filter_var($id_pasaje,FILTER_VALIDATE_INT)){
            echo '<script>alert("El ID del pasaje solo puede contener numeros"); window.location.href = "../pages/manageReservations.php"; </script>';
            exit;
        }
        if (empty($id_pasaje)) {
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/manageReservations.php"; </script>';
            exit;
        }
        $query = "SELECT estado FROM pasaje WHERE ID_pasaje =:id_pasaje";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_pasaje", $id_pasaje, PDO::PARAM_INT);
        $sql->execute();
        $estados = $sql->fetch(PDO::FETCH_ASSOC);
        $estado = $estados["estado"];
        if ($estado != "Reservado") {
            echo '<script>alert("El pasaje no puede ser cancelado"); window.location.href = "../pages/manageReservations.php"; </script>';
            
        } else {
            $query = "UPDATE pasaje SET estado = 'Cancelado' WHERE ID_pasaje =:id_pasaje";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_pasaje", $id_pasaje, PDO::PARAM_INT);
            $sql->execute();
            echo '<script>alert("Pasaje cancelado con exito"); window.location.href = "../pages/manageReservations.php"; </script>';
        }

    }
    if (!empty($_POST["comprarPasaje"])) {
        $id_pasaje = $_POST["idPasaje"];
        $patron = "/^[a-zA-Z0-9]+$/";
        $id_pasaje = htmlspecialchars($id_pasaje, ENT_QUOTES, 'UTF-8');
        if(!filter_var($id_pasaje,FILTER_VALIDATE_INT)){
            echo '<script>alert("El ID del pasaje solo puede contener numeros"); window.location.href = "../pages/manageReservations.php"; </script>';
            exit;
        }
        $pago = $_POST["pago"];
        $pago = htmlspecialchars($pago, ENT_QUOTES, 'UTF-8');
        if(!filter_var($pago, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("La confirmacion del pago solo puede contener letras y numeros"); window.location.href = "../pages/manageReservations.php"; </script>';
            exit;
        }
        if (empty($pago) || empty($id_pasaje)) {
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/manageReservations.php"; </script>';
            exit;
        }
        $query = "SELECT estado FROM pasaje WHERE ID_pasaje =:id_pasaje";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_pasaje", $id_pasaje, PDO::PARAM_INT);
        $sql->execute();
        $estados = $sql->fetch(PDO::FETCH_ASSOC);
        $estado = $estados["estado"];
        if ($estado != "Reservado") {
            echo '<script>alert("El pasaje no puede ser comprado"); window.location.href = "../pages/manageReservations.php"; </script>';
        } else {
            $query = "UPDATE pasaje SET estado = 'Reservado-Comprado' WHERE ID_pasaje =:id_pasaje";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_pasaje", $id_pasaje, PDO::PARAM_INT);
            $sql->execute();
            echo '<script>alert("Pasaje comprado con exito"); window.location.href = "../pages/manageReservations.php"; </script>';
        }

    }
} catch (Exception $error) {
    discordErrorLog('Error al confirmar o eliminar pasaje' . $id_pasaje, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>