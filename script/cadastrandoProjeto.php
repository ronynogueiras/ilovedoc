<?php

//Autor: Gabriel Barbosa.
//Data : 26/05/2016 

	require('bancoDados.php');

	$bancoDados     = conexaoBancoDados();

	/**
	 * Definicao de variaveis para mapear 
	 * DataModel.
	 * */
	if($_SESSION['uid']){
		$projUsuario	= $_SESSION['uid'];
		$projNome 		= $_POST['projNome'];
		$projDescricao  = $_POST['projDescricao'];
		//$projModelo 	= $_POST['projModelo'];
		$projSitucao 	= $_POST['projSitucao'];
		$projMomento 	= $_POST['projMomento'];
	
	
		//Para relacionar usuario
		/**
		 * Prepara consulta para verificar
		 * Se ha algum projeto ja cadastrado
		 * Com o mesmo nome para o mesmo usuario
		 **/
		$sql = "SELECT * FROM projetos WHERE pr_usuario = :projUsuario and pr_nome = :projNome";
		$consulta = $bancoDados->prepare($sql);
		$consulta->bindParam('projUsuario', $projUsuario);
		$consulta->bindParam('projNome', $projNome);
		$consulta->execute();
		
		$row = $consulta->rowCount();
	
		if($row==0){
			$sql = "INSERT INTO projetos (pr_usuario, pr_nome, pr_descricao, pr_situacao, pr_momento) VALUES (:projUsuario, :projNome, :projDescricao, 'Ativo', now())";
			
			$incluir = $bancoDados->prepare($sql);
			$incluir -> bindParam ('projUsuario'    ,$projUsuario);
			$incluir -> bindParam ('projNome'		,$projNome); 
			$incluir -> bindParam ('projDescricao'  ,$projDescricao);
			//$incluir -> bindParam ('projModelo'     ,$projModelo);
			//$incluir -> bindParam ('projSitucao'    ,$projSitucao);
			//$incluir -> bindParam ('projMomento'    ,$projMomento);
			
			$incluir -> execute();
			
			echo "<center><h1>Projeto cadastrado com sucesso!</h1></center>";
			echo "<center>Voce sera redirecionado em 3 segundos</center>";
			echo "<script type='text/javascript'>setTimeout(function(){window.location.href='".URL_BASE."pagina/minhaConta.php'},3000);</script>";
		}else{
			echo '<center>Projeto ja cadastrado !</center>';
		}
	}else{
		echo '<center>E necessario realizar login para cadastrar um projeto.</center>';
	}
		
?>