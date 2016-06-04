<!--
 ! Função responsável pelo Login do usuario, checando info no BD
 ! @author Pedro Victor
 ! @version 1.0
 ! -->

<?php
require('bancoDados.php');

$bancoDados     = conexaoBancoDados();

$email=$_POST['email'];
$senha=$_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE us_email = :email and us_senha =:senha";
$consulta = $bancoDados->prepare($sql);
$consulta -> bindParam ('email',$email); 
$consulta -> bindParam ('senha',$senha);
$consulta -> execute();

$row = $consulta->rowCount();
if ($row > 0) {
  session_start();
  $usuario          = $consulta->fetchObject();
  $_SESSION['uid']  =$usuario->us_id;
  $_SESSION['email']=$usuario->us_email;
  $_SESSION['nome']=$usuario->us_usuario;
  echo "<center>Voce foi autenticado com sucesso! </center>";
  header('location:'.URL_BASE.'pagina/minhaConta.php');
} else {
  echo "<center> Nome de usuario ou senha invalidos! Aguarde um instante para tentar novamente...</center>";
  echo "<script type='text/javascript'>setTimeout(function(){window.location.href='".URL_BASE."pagina/entrar.php"."'},3000);</script>";
}