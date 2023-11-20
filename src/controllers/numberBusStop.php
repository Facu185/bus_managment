<?php 
require "../database/db.php";
$query = "SELECT Numero_parada FROM parada
ORDER BY Numero_parada ASC;";
$stmt = $conn->prepare($query);
$stmt->execute();

$opciones = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $opciones[] = $row["Numero_parada"];
}



echo json_encode($opciones);
$conn = null;
?>