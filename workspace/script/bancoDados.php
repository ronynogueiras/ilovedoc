<?php 
/*
 * Função responsável por estabelecer a conexão com o Banco de Dados
 * @author Rony Nogueira
 * @version 1.0
 * */
function conexaoBancoDados() {
    $dbhost		=getenv('IP');
    $dbuser		="ronynogueiras";
    $dbpass		="";
    $dbname		="c9";
    $db 		= new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}