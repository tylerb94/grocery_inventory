<?php
    setcookie("username", "", time() + (86400 * 365), "/");
    header("Location: index.php");
    die();
?>