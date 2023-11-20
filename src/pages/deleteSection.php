<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Delete section</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Eliminar tramos</h3>
            <form method="post" action="../controllers/deleteSection.php">
                <select name="numeroParadaOrigen" id="numeroParadaOrigen">
                    <option value="Parada de origen del tramo" selected>Parada de origen del tramo</option>
                </select>
                <select name="numeroParadaDestino" id="numeroParadaDestino">
                    <option value="Parada de destino del tramo" selected>Parada de destino del tramo</option>
                </select>
                <input type="submit" name="deleteSection" value="Eliminar tramo">
            </form>

        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/numberBusStop.js" type='module'></script>

</body>

</html>