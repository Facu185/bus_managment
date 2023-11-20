<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Delete line</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Eliminar linea</h3>
            <form method="post" action="../controllers/deleteLine.php">
                <select name="lines" id="lines">
                    <option value="Seleccione la linea a eliminar" selected>Seleccione la linea a eliminar</option>
                </select>
                <input type="submit" name="deleteLine" value="Eliminar linea">
            </form>
        </section>
    </main>

    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/lines.js" type='module'></script>
</body>

</html>