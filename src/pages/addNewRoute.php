<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Add new route</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Agregar nuevo tramo a un recorrido</h3>
            <form method="post" action="../controllers/addNewRoute.php">
                <select name="lines" id="lines">
                    <option value="Seleccione la linea a modificar" selected>Seleccione la linea a modificar</option>
                </select>
                <select name="tramoAnterior" id="numeroParadaOrigenTramo">
                    <option value="Seleccione tramo 1" selected>Seleccione el tarmo anterior del recorrido</option>
                </select>
                <select name="tramoAgregar" id="numeroParadaOrigenTramo2">
                    <option value="Seleccione tramo 1" selected>Seleccione el tarmo a agregar</option>
                </select>
                <input type="text" name="origenTramo" placeholder="Origen del tramo">
                <input type="text" name="destinoTramo" placeholder="Destino del tramo">
                <input type="submit" name="addRoute" value="Añadir recorridos" class="button--tertiary arreglo2">
            </form>
        </section>
    </main>

    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/lines.js" type='module'></script>
    <script src="../js/modules/stopRoutes.js" type='module'></script>
</body>

</html>