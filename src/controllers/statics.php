<?php
require "../database/db.php";

try {

    $f_date = $_POST["fDate"];
    $f_date = htmlspecialchars($f_date, ENT_QUOTES, 'UTF-8');
    $s_date = $_POST["sDate"];
    $s_date = htmlspecialchars($s_date, ENT_QUOTES, 'UTF-8');
    if(empty($f_date) || empty($s_date)){
       echo '<script>alert("Faltan completar datos"); window.location.href ="../pages/dashboard.php"; </script>';
    }
    $query = "SELECT 
            DATE_FORMAT(fecha_viaje, '%Y-%m') AS Mes,
            SUM(precio) AS SumaPrecios,
            COUNT(*) AS Compras
        FROM Pasaje
        WHERE estado IN ('Reservado-Comprado', 'Comprado')
          AND fecha_viaje BETWEEN :f_date AND :s_date  
        GROUP BY Mes;";
    $sql = $conn->prepare($query);
    $sql->bindParam(":f_date", $f_date, PDO::PARAM_STR);
    $sql->bindParam(":s_date", $s_date, PDO::PARAM_STR);
    $sql->execute();
    $statics = $sql->fetchAll(PDO::FETCH_ASSOC);
    $array = json_encode($statics);
    echo $array;


} catch (Exception $error) {
    echo '<script>alert("' . $error->getMessage() . '"); </script>';
}
$conn = null;
?>