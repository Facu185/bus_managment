<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Add section</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Agregar tramo</h3>
            <form id="formulario" method="post" action="../controllers/addSection.php">
                <div id="form" class='test'>
                    <select name="numeroParadaOrigen" id="numeroParadaOrigen">
                        <option selected>Parada de origen del tramo</option>
                    </select>
                    <select name="numeroParadaDestino" id="numeroParadaDestino">
                        <option selected>Parada de destino del tramo</option>
                    </select>
                    <select name="tipoTramo">
                        <option value="Tipo de tramo" selected>Tipo de tramo</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                    <input type="number" name="distancia" placeholder="Distancia">
                    <p>Tiempo del viaje:</p>
                    <input type="time" name="tiempoViaje" placeholder="Tiempo de viaje">
                    <input type="text" name="calles" placeholder="Calles">
                    <input type="text" name="rutas" placeholder="Rutas">

                </div>
                <input id="showFormButton" type="button" class="button--tertiary arreglo2"
                    value="Agregar otro tramo"></input>
                <div id="additionalForms"> </div>
                <input type="submit" name="addSection" value="Añadir tramo" class="arreglo2">
            </form>


        </section>
    </main>

    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/moreSections.js" type='module'></script>
    <script src="../js/modules/numberBusStop.js" type='module'></script>
</body>

</html>