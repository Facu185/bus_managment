<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Modify section</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Modificar tramo</h3>
            <form id="formulario" method="post" action="../controllers/modifySection.php">
                <select name="numeroParadaOrigen" id="numeroParadaOrigenTramo">
                    <option value="Seleccione el tramo a modificar" selected>Seleccione el tramo a modificar</option>
                </select>
                <select name="tipoTramo">
                    <option value="Tipo de tramo" selected>Tipo de tramo</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <input type="number" name="distancia" placeholder="Distancia">
                <p class="pNone"></p>
                <p>Tiempo del viaje:</p>
                <input type="time" name="tiempoViaje" placeholder="Tiempo de viaje del tramo">
                <input type="text" name="calles" placeholder="Calles">
                <input type="text" name="rutas" placeholder="Rutas">
                <input type="submit" name="modifySection" value="Modificar tramo">
            </form>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/stopRoutes.js" type='module'></script>
</body>

</html>