<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["addRoute"])) {
        $nombre_linea = $_POST["nombreLinea"];
        $id_unidad= $_POST["matricula"];
        $id_unidad = htmlspecialchars($id_unidad, ENT_QUOTES, 'UTF-8');
        $hora_salida = $_POST["horaSalida"];
        $hora_salida = htmlspecialchars($hora_salida, ENT_QUOTES, 'UTF-8');
        $hora_llegada = $_POST["horaLlegada"];
        $hora_llegada = htmlspecialchars($hora_llegada, ENT_QUOTES, 'UTF-8');
        $patron = "/^[a-zA-Z0-9]+$/";
        $nombre_linea = htmlspecialchars($nombre_linea, ENT_QUOTES, 'UTF-8');      
        $origen_linea = $_POST["origenLinea"];
        $origen_linea = htmlspecialchars($origen_linea, ENT_QUOTES, 'UTF-8');
        $destino_linea = $_POST["destinoLinea"];
        $destino_linea = htmlspecialchars($destino_linea, ENT_QUOTES, 'UTF-8');

        if (empty($nombre_linea) || empty($origen_linea) || empty($destino_linea)) {
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/addRoutes.php"; </script>';
            exit;
        }      
        if(!filter_var($origen_linea, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("El origen de la linea solo puede contener letras y numeros"); window.location.href = "../pages/addRoutes.php"; </script>';
        }
        if(!filter_var($destino_linea, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
            echo '<script>alert("El destino de la linea solo puede contener letras y numeros"); window.location.href = "../pages/addRoutes.php"; </script>';
        }
        
        $query = "SELECT nombre_linea FROM linea WHERE nombre_linea =:nombre_linea";
        $sql = $conn->prepare($query);
        $sql->bindParam(":nombre_linea", $nombre_linea, PDO::PARAM_STR);
        $sql->execute();
        $linea = $sql->fetch(PDO::FETCH_ASSOC);
        if (!empty($linea)) {
            echo '<script>alert("Esta linea ya existe"); window.location.href = "../pages/addRoutes.php"; </script>';
            exit;
        }
      
        $query = "INSERT INTO linea (nombre_linea, origen_linea, destino_linea) VALUES (:nombre_linea, :origen_linea, :destino_linea)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":nombre_linea", $nombre_linea, PDO::PARAM_STR);
        $sql->bindParam(":origen_linea", $origen_linea, PDO::PARAM_STR);
        $sql->bindParam(":destino_linea", $destino_linea, PDO::PARAM_STR);
        $sql->execute();

        $query = "SELECT ID_linea FROM linea WHERE nombre_linea =:nombre_linea";
        $sql = $conn->prepare($query);
        $sql->bindParam(":nombre_linea", $nombre_linea, PDO::PARAM_STR);
        $sql->execute();
        $id = $sql->fetch(PDO::FETCH_ASSOC);
        $id_linea = $id["ID_linea"];
        
        $query = "SELECT ID_linea, ID_unidad, hora_salida, hora_llegada FROM horario WHERE ID_unidad =:id_unidad AND ID_linea =:id_linea AND hora_salida =:hora_salida AND hora_llegada =:hora_llegada";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_unidad", $id_unidad, PDO::PARAM_STR);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":hora_salida", $hora_salida, PDO::PARAM_STR);
        $sql->bindParam(":hora_llegada", $hora_llegada, PDO::PARAM_STR);
        $sql->execute();
        $horarios_repetios = $sql->fetch(PDO::FETCH_ASSOC);
        if (!empty($horarios_repetios)) {
            echo '<script>alert("Esta unidad y esta linea ya tienen este horario asignado"); window.location.href = "../pages/addRoutes.php"; </script>';
            exit;
        }
        $query = "INSERT INTO horario (ID_linea, ID_unidad, hora_salida, hora_llegada) VALUES (:id_linea, :id_unidad, :hora_salida, :hora_llegada)";
        $sql = $conn->prepare($query);
        $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
        $sql->bindParam(":id_unidad", $id_unidad, PDO::PARAM_STR);
        $sql->bindParam(":hora_salida", $hora_salida, PDO::PARAM_STR);
        $sql->bindParam(":hora_llegada", $hora_llegada, PDO::PARAM_STR);
        $sql->execute();

        $contador = 6;
        $contador2 = 0;

        if ($contador2 == 0) {
            $contador2 = '';
        }

        $arr = array($_POST);
        $arr_forms = array_slice($arr[0], 0);
        $rep = (count($arr_forms) - 7) / 3;

        for ($a = 1; $a <= $rep; $a++) {
            $length = $contador + 2;

            for ($i = $contador; $i <= $length; $i++) {
                $id_tramo = $_POST["numeroParadaOrigen" . $contador2];
                $id_tramo = htmlspecialchars($id_tramo, ENT_QUOTES, 'UTF-8'); 
                $origen_tramo = $_POST["origenTramo" . $contador2];
                $origen_tramo = htmlspecialchars($origen_tramo, ENT_QUOTES, 'UTF-8');    
                $destino_tramo = $_POST["destinoTramo" . $contador2];
                $destino_tramo = htmlspecialchars($destino_tramo, ENT_QUOTES, 'UTF-8');
                $contador++;
                if(empty($nombre_linea) || empty($origen_linea) || empty($destino_linea)|| empty($id_linea) || empty($id_tramo)|| empty($origen_tramo) || empty($destino_tramo) ){
                    echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/addRoutes.php"; </script>';
                    exit;
                }
                if(!filter_var($id_tramo, FILTER_VALIDATE_INT)){
                    echo '<script>alert("La parada solo puede contener numeros"); window.location.href = "../pages/addRoutes.php"; </script>';
                    exit;
                }
                if(!filter_var($origen_tramo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
                    echo '<script>alert("El origen del tramo solo puede contener letras y numeros"); window.location.href = "../pages/addRoutes.php"; </script>';
                    exit;
                }
                if(!filter_var($destino_tramo, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
                    echo '<script>alert("El destino del tramo solo puede contener letras y numeros"); window.location.href = "../pages/addRoutes.php"; </script>';
                    exit;
                }
            }
            
            
            $contador2++;
            $query = "INSERT INTO recorre (ID_linea, ID_tramo, origen_tramo, destino_tramo, orden_tramos) VALUES (:id_linea, :id_tramo, :origen_tramo, :destino_tramo, :contador2)";
            $sql = $conn->prepare($query);
            $sql->bindParam(":id_linea", $id_linea, PDO::PARAM_INT);
            $sql->bindParam(":id_tramo", $id_tramo, PDO::PARAM_INT);
            $sql->bindParam(":origen_tramo", $origen_tramo, PDO::PARAM_STR);
            $sql->bindParam(":destino_tramo", $destino_tramo, PDO::PARAM_STR);
            $sql->bindParam(":contador2", $contador2, PDO::PARAM_INT);
            $sql->execute();
        }
        echo '<script>alert("Recorrido añadido con exito"); window.location.href = "../pages/addRoutes.php"; </script>';

    }
} catch (Exception $error) {
    discordErrorLog('Error al anadir nuevo recorrido a la linea' . $nombre_linea, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>
