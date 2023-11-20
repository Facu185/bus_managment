<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../controllers/lookClient.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/main.css">
    <title>Clients</title>
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Administrar usuario</h3>
            <form method="post" action="../controllers/lookClient.php">
                <input type="email" name="clientEmail" placeholder="Email del usuario">
                <input type="submit" name="lookClient" value="Buscar usuario">
            </form>
            <div class="users">
                <?php if (!empty($_SESSION["usuario"])): ?>
                    <p>
                        ID usuario:
                        <?php echo ($_SESSION["usuario"]["ID_usuario"]) ?>
                    </p>
                    <p>
                        Email del usuario:
                        <?php echo ($_SESSION["usuario"]["email"]) ?>
                    </p>
                    <p>
                        Nombre del usuario:
                        <?php echo ($_SESSION["usuario"]["nombre"]) ?>
                    </p>
                    <p>
                        Apellido del usuario:
                        <?php echo ($_SESSION["usuario"]["apellido"]) ?>
                    </p>
                    <p>
                        Celular del usuario:
                        <?php echo ($_SESSION["usuario"]["celular"]) ?>
                    </p>
                    <p>
                        Esta activo:
                        <?php if ($_SESSION["usuario"]["activo"] == 0) {
                            echo "Si";
                        } else
                            echo "No"; ?>
                    </p>
                    <form method="post" action="../controllers/deleteClient.php">
                        <input type="email" name="clientEmail" style="display: none;"
                            value=" <?php echo ($_SESSION["usuario"]["email"]) ?>">
                        <?php if ($_SESSION["usuario"]["activo"] == 0) {
                            echo "<input type='submit' name='deleteClient' value='Eliminar usuario'>";
                        } else
                            echo "<input type='submit' name='activateClient' value='Activar usuario'>"; ?>

                    </form>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
</body>

</html>