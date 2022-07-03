<?php

if (!isset($_SESSION['ActiveUser'])) {
    header('Location: login.php');
}

?>