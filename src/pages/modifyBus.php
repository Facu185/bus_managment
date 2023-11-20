<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Modify bus</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Modificar unidad</h3>
            <form method="post" action="../controllers/updateBus.php">
                <select name="matricula" id="matricula">
                    <option value="Matricula de la unidad" selected>Matricula de la unidad</option>
                </select>
                <input type="text" name="cantAsientos" placeholder="Cantidad de asientos">
                <input type="text" name="tipoAsientos" placeholder="Tipo de asientos">
                <input type="text" name="caracteristicas" placeholder="Caracteristicas de la unidad">
                <input class="button--primary" type="submit" name="updateBus" value="Modificar unidad">
            </form>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/showBus.js" type='module'></script>
</body>

</html>