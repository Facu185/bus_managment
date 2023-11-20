<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Delete bus</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Eliminar unidad</h3>
            <form method="post" action="../controllers/deleteBus.php">
                <select name="matricula" id="matricula">
                    <option value="Matricula de la unidad" selected>Matricula de la unidad</option>
                </select>
                <input class="button--primary" type="submit" name="deleteBus" value="Eliminar unidad">
            </form>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/modules/showBus.js" type='module'></script>
</body>

</html>