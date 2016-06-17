<?php 
/*
* Responsável por realizar a chamada dos controllers da aplicação e as páginas de exibição.
* @author Rony Nogueira
* @version 1.0
* @since 1.0
*/
    
require_once('config/config.php');
$url        = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
getController($url);
