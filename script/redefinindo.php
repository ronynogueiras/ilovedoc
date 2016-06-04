<!-- Lucas - Exemplo -->
<?php
require('bancoDados.php');

$bancoDados     = conexaoBancoDados();


//pega a variavel via post
$email = $_POST['email'];
//busca no db o usuario com o email
$sql = "SELECT * FROM usuarios WHERE us_email = :email";
$consulta = $bancoDados->prepare($sql);
$consulta -> bindParam ('email',$email); 
$consulta -> execute();
//conta quantos tem
$row = $consulta->rowCount();
//se tiver  + de 1 cadastrado
if($row==1){
	$dados 	  = $consulta->fetchObject();
/*	while($Row_email = $consulta->fetch_array()){
		$rowemail = $Row_email['email'];
		$rowpassword = $Row_senha['senha'];
	}*/
	$rowemail = $dados->us_email;
   
	$mensage ="Você solicitou a recuperação de senha, clique no link abaixo.";
	$mensage ="https://ilovedoc-ronynogueiras.c9users.io/pagina/novaSenha.html ";

	if(mail($rowemail, "I Love Documentation, recuperação de senha!", $mensage)){
		echo "<script>alert('Sua senha foi enviada para o e-mail indicado.');</script>";
	}else{
		echo 'Erro ao enviar';
	}

	

}else{
	echo"<script>alert('E-mail não cadastrado em nosso sistema'),window.open('pagina/redefinirSenha.html','_self')</script>";
}


?>
</body>