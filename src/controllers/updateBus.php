<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
   
    if (!empty($_POST["updateBus"])) {
        $matricula = $_POST["matricula"];
        $matricula = htmlspecialchars($matricula, ENT_QUOTES, 'UTF-8');
        $cantidad_asientos = $_POST["cantAsientos"];
        $cantidad_asientos = htmlspecialchars($cantidad_asientos, ENT_QUOTES, 'UTF-8'); 
        $tipo_asientos = $_POST["tipoAsientos"];
        $tipo_asientos = htmlspecialchars($tipo_asientos, ENT_QUOTES, 'UTF-8');
        $caracteristicas = $_POST["caracteristicas"];
        $caracteristicas = htmlspecialchars($caracteristicas, ENT_QUOTES, 'UTF-8');
        if(empty($matricula) || empty($caracteristicas) || empty($cantidad_asientos) || empty($tipo_asientos) || $matricula == "Matricula de la unidad"){
            echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/modifyBus.php"; </script>';
            exit;
        }
        if (!filter_var($matricula, FILTER_VALIDATE_INT)) {
            echo '<script>alert("Debes proporcionar una matricula valida"); window.location.href = "../pages/modifyBus.php"; </script>';
            exit;
        }
        if(!filter_var($cantidad_asientos, FILTER_VALIDATE_INT)){
            echo '<script>alert("Debes proporcionar una cantidad de asientos valida"); window.location.href = "../pages/modifyBus.php"; </script>';
            exit;
        }
        if (!empty($cantidad_asientos) && !empty($tipo_asientos) && !empty($caracteristicas)) {

            $query = "UPDATE asiento SET tipo_asiento=:tipo_asientos WHERE ID_unidad = :matricula";
            $sql = $conn->prepare($query);
            $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
            $sql->bindParam(":tipo_asientos", $tipo_asientos, PDO::PARAM_STR);
            $sql->execute();
            echo '<script>alert("Unidad modificada con exito"); window.location.href = "../pages/modifyBus.php"; </script>';

            $query = "UPDATE caracteristicas SET tipo=:caracteristicas WHERE ID_unidad = :matricula";
            $sql = $conn->prepare($query);
            $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
            $sql->bindParam(":caracteristicas", $caracteristicas, PDO::PARAM_STR);
            $sql->execute();
            echo '<script>alert("Unidad modificada con exito"); window.location.href = "../pages/modifyBus.php"; </script>';
            if (!empty($tipo_asientos)) {
                $query = "SELECT total_de_asientos FROM unidad WHERE ID_unidad = :matricula";
                $sql = $conn->prepare($query);
                $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
                $sql->execute();
                $total_de_asientos = $sql->fetch(PDO::FETCH_ASSOC);
                $asientos = $total_de_asientos["total_de_asientos"];
                if ($cantidad_asientos > $asientos) {
                    $query = "UPDATE unidad SET total_de_asientos=:cantidad_asientos WHERE ID_unidad = :matricula";
                    $sql = $conn->prepare($query);
                    $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
                    $sql->bindParam(":cantidad_asientos", $cantidad_asientos);
                    $sql->execute();

                    for ($i = $asientos + 1; $i <= $cantidad_asientos; $i++) {
                        $query = "INSERT INTO asiento (Numero_asiento, ID_unidad, tipo_asiento) VALUES (:i, :matricula, :tipo_asientos)";
                        $sql = $conn->prepare($query);
                        $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
                        $sql->bindParam(":i", $i, PDO::PARAM_INT);
                        $sql->bindParam(":tipo_asientos", $tipo_asientos, PDO::PARAM_STR);
                        $sql->execute();
                    }
                    echo '<script>alert("Unidad modificada con exito"); window.location.href = "../pages/modifyBus.php"; </script>';
                }
            } elseif ($cantidad_asientos < $asientos) {
                $query = "UPDATE unidad SET total_de_asientos=:cantidad_asientos WHERE ID_unidad = :matricula";
                $sql = $conn->prepare($query);
                $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
                $sql->bindParam(":cantidad_asientos", $cantidad_asientos, PDO::PARAM_INT);
                $sql->execute();

                for ($i = $asientos; $i >= $cantidad_asientos + 1; $i--) {
                    $query = "DELETE FROM asiento WHERE ID_unidad = :matricula AND Numero_asiento = :i";
                    $sql = $conn->prepare($query);
                    $sql->bindParam(":matricula", $matricula, PDO::PARAM_STR);
                    $sql->bindParam(":i", $i, PDO::PARAM_INT);
                    $sql->execute();
                }
                echo '<script>alert("Unidad modificada con exito"); window.location.href = "./modifyBus"; </script>';
            } elseif ($cantidad_asientos == $asientos) {
                echo '<script>alert("La unidad ya tiene esa cantidad de asientos asignados"); window.location.href = "../pages/modifyBus.php"; </script>';
            } else {
                echo '<script>alert("Debe ingresar el tipo de asiento"); window.location.href = "../pages/modifyBus.php"; </script>';
            }
        }
        
            
        
        
          
        
    }
} catch (Exception $error) {
    discordErrorLog('Error al modfiicar unidad'. $matricula, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>