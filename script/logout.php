<!--
 ! Função responsável pela quebra de sessão do usuario
 ! @author Pedro Victor
 ! @version 1.0
 ! -->

<?php
    session_start();
    session_destroy();
    header("Location: ../index.php");
?>