<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Modify route</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
       <section class="main__main">
       <h3>Modificar recorrido</h3>
        <form method="post" action="../controllers/modifyRoute.php">
            <select name="lines" id="lines">
                <option value="Seleccione la linea del recorrido a modificar" selected>Seleccione la linea del recorrido a modificar</option>
            </select>
            <select name="numeroParadaOrigen" id="numeroParadaOrigenTramo">
                <option value="Seleccione el tramo  a modificar" selected>Seleccione el tramo  a modificar</option>
            </select>
            <input type="text" name="origenTramo" placeholder="Origen del tramo">
            <input type="text" name="destinoTramo" placeholder="Destino del tramo">
            <input type="submit" name="modifyRoute" value="Modificar" class='button--tertiary'>
            <input type="submit" name="deleteRoute" value="Eliminar este tramo del recorrido" class='button--tertiary'>
        </form>
       </section>
    </main>

    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/stopRoutes.js" type='module'></script>
    <script src="../js/modules/lines.js" type='module'></script>
</body>

</html>