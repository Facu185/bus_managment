<?php
if ($_SESSION["rol"]) {
    unset($_SESSION["rol"]);
    unset($_SESSION[$_COOKIE["login"]]);
    header("location: ../pages/login.php");
}else{
    unset($_SESSION[$_COOKIE["login"]]);
    header("location: ../pages/login.php");
}
exit;
?>