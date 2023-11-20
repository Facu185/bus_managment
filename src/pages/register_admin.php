<?php
session_start();
if ($_SESSION["rol"] == 2) {
    echo '<script>alert("Debe ser super usuario para registrar nuevos adminitradores."); window.location.href = "../pages/dashboard.php";</script>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViaUy - Register</title>
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <main class="admin__main">
        <?php include_once "../components/AdminSidebar.php"; ?>
        <section class="main__main">
            <h3>Registrar un administrador</h3>
            <div class="register__admin">
                <form method="post" action="../controllers/singup_admin.php">
                    <p>Nombre:</p>
                    <input type="text" id="registerName" name="registerName" placeholder="Nombre" required>
                    <p>Apellido:</p>
                    <input type="text" id="registerLastName" name="registerLastName" placeholder="Apellido" required>
                    <p>Telefono:</p>
                    <input type="number" id="registerPhone" name="registerPhone" placeholder="Numero de telefono" required>
                    <p>Email:</p>
                    <input type="email" id="registerEmail" name="registerEmail" placeholder="Email" required>
                    <p>Contraseña:</p>
                    <input type="password" id="registerPassword" name="registerPassword" placeholder="Contraseña" onpaste="return false;" required>
                    <p></p>
                    <input type="submit" name="registerButton" value="Registrar">
                </form>
            </div>
        </section>
    </main>
    <script src="../js/modules/sideBar.js" type='module'></script>
    <script src="../js/index.js" type="module"></script>
</body>

</html>