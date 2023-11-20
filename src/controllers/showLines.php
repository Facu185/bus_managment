<?php
require "../database/db.php";
$query = "SELECT ID_linea, nombre_linea FROM linea;";
$stmt = $conn->prepare($query);
$stmt->execute();

$resultados = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $resultados[] = $row;
}

echo json_encode($resultados);
$conn = null;
?>