<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Add routes</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Añadir recorrido</h3>
            <form method="post" action="../controllers/addRoute.php">
                <input type="text" name="nombreLinea" placeholder="Nombre de la linea">
                <input type="text" name="origenLinea" placeholder="Origen de la linea">
                <select name="matricula" id="matricula">
                    <option value="Matricula de la unidad" selected>Matricula de la unidad</option>
                </select>
                <p class="pNone"></p>
                <p>Hora de salida:</p>
                <input type="time" name="horaSalida">
                <p>Hora de llegada:</p>
                <input type="time" name="horaLlegada">
                <div class="arreglo">
                    <input type="text" name="destinoLinea" placeholder="Destino de la linea">
                    <input type="button" id="showTramoButton" class="button--tertiary"
                        value="Mostrar tramo adicional"></input>
                </div>

                <div id="tramo_original">
                    <select name="numeroParadaOrigen" id="numeroParadaOrigenTramo">
                        <option value="Seleccione un tramo para el recorrido" selected>Seleccione un tramo para el
                            recorrido</option>
                    </select>
                    <input type="text" name="origenTramo" placeholder="Origen del tramo">
                    <input type="text" name="destinoTramo" placeholder="Destino del tramo">

                </div>
                <div id="nuevo_tramo"></div>
                <input type="submit" name="addRoute" value="Añadir recorridos" class="button--tertiary arreglo2">
            </form>

        </section>
    </main>

    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/stopRoutes.js" type='module'></script>
    <script src="../js/modules/moreRoutes.js" type='module'></script>
    <script src="../js/modules/showBus.js" type='module'></script>
</body>

</html>