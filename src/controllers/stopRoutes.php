<?php 
require "../database/db.php";
$query = "SELECT ID_tramo, Numero_parada_1, Numero_parada_2 FROM tramo;";
$stmt = $conn->prepare($query);
$stmt->execute();

$resultados = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $resultados[] = $row;
}

echo json_encode($resultados);
$conn = null;
?>