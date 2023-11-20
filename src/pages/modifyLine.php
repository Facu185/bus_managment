<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Modify line</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Modificar linea</h3>
            <form method="post" action="../controllers/modifyLine.php">
                <select name="lines" id="lines">
                    <option value="Seleccione la linea a modificar" selected>Seleccione la linea a modificar</option>
                </select>
                <input type="text" name="nombreLinea" placeholder="Nombre de la linea">
                <input type="text" name="origenLinea" placeholder="Origen de la linea">
                <input type="text" name="destinoLinea" placeholder="Destino de la linea">
                <input type="submit" name="modifyLine" value="Modificar linea">
            </form>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/lines.js" type='module'></script>
</body>

</html>