<!--
 ! Função responsável pelo Cadastro do usuario no BD
 ! @author Pedro Victor
 ! @version 1.0
 ! -->

<?php
require('bancoDados.php');

$bancoDados     = conexaoBancoDados();

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=$_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE us_email = :email";
$consulta = $bancoDados->prepare($sql);
$consulta->bindParam('email',$email);
$consulta->execute();

$row    = $consulta->rowCount();

if($row==0){
    $sql = "INSERT INTO usuarios (us_usuario, us_email, us_senha) VALUES (:nome, :email, :senha)";
    $incluir = $bancoDados->prepare($sql);
    $incluir -> bindParam ('nome',$nome);
    $incluir -> bindParam ('email',$email); 
    $incluir -> bindParam ('senha',$senha);
    $incluir -> execute();
    echo "<center><h1>Cadastro efetuado com sucesso!</h1></center>";
    echo "<center>Voce sera redirecionado para o login em alguns segundos...</center>";
    echo "<script type='text/javascript'>setTimeout(function(){window.location.href='".URL_BASE."pagina/entrar.php"."'},3000);</script>";
}else{
    echo '<center>E-mail ja cadastrado no sistema.</center>';
}


?>