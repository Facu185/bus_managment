<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!empty($_SESSION["login"]) && !empty($_SESSION["rol"])) {
    $login = $_SESSION["login"];
    $rol = $_SESSION["rol"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <title>Via Uy - Admin</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Estadisticas</h3>
            <p>Seleccione las fechas para mostrar las estadisticas</p>
            <form id="staticsForm">
                <input type="date" name="fDate" id="fDate">
                <input type="date" name="sDate" id="sDate">
                <input type="submit" name="showstatics" value="Mostrar estadisticas">
            </form>
                <canvas id="barChart"></canvas>
                <canvas id="barChart2"></canvas>
        </section>
    </main>

    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/statics.js" type="module"></script>
</body>

</html>