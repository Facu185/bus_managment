<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Delete bus stop</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Eliminar parada</h3>
            <form method="post" action="../controllers/deleteBusStop.php">
                <select name="numeroParadaOrigen" id="numeroParadaOrigen">
                    <option value="Seleccione la parada a eliminar" selected>Seleccione la parada a eliminar</option>
                </select>
                <select name="numeroParadaDestino" id="numeroParadaDestino" style="display: none;"></select>
                <input class="button--primary" type="submit" name="deleteBusStop" value="Eliminar parada">
            </form>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/numberBusStop.js" type='module'></script>
</body>

</html>