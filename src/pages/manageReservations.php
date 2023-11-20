<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Manage reservations</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <div>
                <h3>Eliminar reserva</h3>
                <form method="post" action="../controllers/confirmPassage.php">
                    <input type="number" name="idPasaje" placeholder="Numero de pasaje">
                    <input type="submit" name="eliminarPasaje" value="Eliminar pasaje">
                </form>
            </div>
            <div class="compraPasaje">
                <h3>Confirmar reserva</h3>
                <form method="post" action="../controllers/confirmPassage.php">
                    <input type="number" name="idPasaje" placeholder="Numero de pasaje">
                    <input type="number" name="pago" placeholder="Verificador de pago">
                    <input type="submit" name="comprarPasaje" value="Confirmar pasaje">
                </form>
            </div>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
</body>

</html>