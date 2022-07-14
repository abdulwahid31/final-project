<?php
        session_start();
        $_SESSION['userweb']="";
        header ("location: login.php");
        exit;
?>