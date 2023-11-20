<?php
require "../database/db.php";
include_once "../controllers/discordErrorLog.php";
try {
    if (!empty($_POST["addSection"])) {
        $patron = "/^[a-zA-Z0-9]+$/";
        $contador = 0;
        $contador2 = 0;

        if ($contador2 == 0) {
            $contador2 = '';
        }

        $arr = array($_POST);
        $arr_forms = array_slice($arr[0], 0);
        $rep = (count($arr_forms) - 1) / 7;

        for ($a = 0; $a <= $rep; $a++) {
            $length = $contador + 6;

            for ($i = $contador; $i <= $length; $i++) {
                $parada_origen = $arr_forms["numeroParadaOrigen" . $contador2];
                $parada_origen = htmlspecialchars($parada_origen, ENT_QUOTES, 'UTF-8');
               
                $parada_destino = $arr_forms["numeroParadaDestino" . $contador2];
                $parada_destino = htmlspecialchars($parada_destino, ENT_QUOTES, 'UTF-8');
                
                $tipo_tramo = $arr_forms["tipoTramo" . $contador2];
                $tipo_tramo = htmlspecialchars($tipo_tramo, ENT_QUOTES, 'UTF-8');
              
                $distancia = $arr_forms["distancia" . $contador2];
                $distancia = htmlspecialchars($distancia, ENT_QUOTES, 'UTF-8');
                
                $tiempo_viaje = $arr_forms["tiempoViaje" . $contador2];
                $tiempo_viaje = htmlspecialchars($tiempo_viaje, ENT_QUOTES, 'UTF-8');
                $calles = $arr_forms["calles" . $contador2];
                $calles = htmlspecialchars($calles, ENT_QUOTES, 'UTF-8');
               
                $rutas = $arr_forms["rutas" . $contador2]; 
                $rutas = htmlspecialchars($rutas, ENT_QUOTES, 'UTF-8');
               
                $contador++;
            }
            if(empty($parada_origen) || empty($parada_destino) || empty($tipo_tramo) || empty($distancia) || empty($tiempo_viaje) || empty($calles) || empty($rutas) || !is_numeric($parada_origen) || !is_numeric($parada_destino) || !is_numeric($tipo_tramo)) {
                echo '<script>alert("Faltan completar datos"); window.location.href = "../pages/addSection.php"; </script>';
            }
            if(!filter_var($parada_origen, FILTER_VALIDATE_INT)){
                echo '<script>alert("La parada de origen solo puede contener numeros"); window.location.href = "../pages/addSection.php"; </script>';
                exit;
            }
            if(!filter_var($rutas, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
                echo '<script>alert("Las rutas solo pueden contener letras y numeros"); window.location.href = "../pages/addSection.php"; </script>';
                exit;
            }
            if(!filter_var($parada_destino, FILTER_VALIDATE_INT)){
                echo '<script>alert("La parada de destino solo puede contener numeros"); window.location.href = "../pages/addSection.php"; </script>';
                exit;
            }
            if(!filter_var($tipo_tramo, FILTER_VALIDATE_INT)){
                echo '<script>alert("El tipo de tramo solo puede contener numeros"); window.location.href = "../pages/addSection.php"; </script>';
                exit;
            }
            if(!filter_var($distancia, FILTER_VALIDATE_INT)){
                echo '<script>alert("La distancia solo puede contener numeros"); window.location.href = "../pages/addSection.php"; </script>';
                exit;
            }
            if(!filter_var($calles, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $patron)))){
                echo '<script>alert("Las calles solo pueden contener letras y numeros"); window.location.href = "../pages/addSection.php"; </script>';
                exit;
            }
            $contador2++;

            $query = "SELECT numero_parada_1, numero_parada_2 FROM tramo WHERE numero_parada_1 = :parada_origen AND numero_parada_2 = :parada_destino";
            $sql = $conn->prepare($query);
            $sql->bindParam(":parada_origen", $parada_origen, PDO::PARAM_INT);
            $sql->bindParam(":parada_destino", $parada_destino, PDO::PARAM_INT);
            $sql->execute();
            $paradas = $sql->fetch(PDO::FETCH_ASSOC);
            if (!empty($paradas)) {
                echo '<script>alert("Este tramo ya existe"); window.location.href = "../pages/addSection.php"; </script>';
            }

            $query = "INSERT INTO tramo (numero_parada_1, numero_parada_2, tipo_tramo, distancia, calles, rutas, tiempo) VALUES (:parada_origen, :parada_destino, :tipo_tramo, :distancia, :calles, :rutas, :tiempo_viaje)";
            $sql = $conn->prepare($query);
            $sql->bindParam(":parada_origen", $parada_origen, PDO::PARAM_INT);
            $sql->bindParam(":parada_destino", $parada_destino, PDO::PARAM_INT);
            $sql->bindParam(":tipo_tramo", $tipo_tramo, PDO::PARAM_INT);
            $sql->bindParam(":distancia", $distancia, PDO::PARAM_INT);
            $sql->bindParam(":calles", $calles, PDO::PARAM_STR);
            $sql->bindParam(":rutas", $rutas, PDO::PARAM_STR);
            $sql->bindParam(":tiempo_viaje", $tiempo_viaje, PDO::PARAM_STR);
            $sql->execute();

            echo '<script>alert("Tramo añadido con exito"); window.location.href = "../pages/addSection.php"; </script>';
        }
    }

} catch (Exception $error) {
    discordErrorLog('Error al anadir nuevo tramo con las paradas' . $parada_origen . $parada_destino, $error);
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>