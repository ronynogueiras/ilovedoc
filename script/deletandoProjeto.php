<?php
//Autor: João Henrique.
//Data : 28/05/2016    
    
    require('bancoDados.php');
    $bancoDados = conexaoBancoDados();
    
    $projUsuario	= $_SESSION['uid'];
    $projID         = $_POST['idProjeto'];
    
    $sql = "DELETE FROM projetos WHERE pr_usuario = :projUsuario and pr_id = :projID";
    $deleta = $bancoDados->prepare($sql);
    $deleta->bindParam('projUsuario', $projUsuario);
    $deleta->bindParam('projID', $projID);
	$deleta->execute();
	
	$row = $deleta->rowCount();
    if ($row==0){
        echo "<center><h1>Identificador de projeto nao encontrado! Tem certeza que possui este projeto?</h1></center>";
		echo "<center>Voce sera redirecionado em 3 segundos</center>";
		echo "<script type='text/javascript'>setTimeout(function(){window.location.href='".URL_BASE."pagina/deletarProjeto.html'},3000);</script>";
    } else {
        echo "<center><h1>Projeto excluido com sucesso!</h1></center>";
		echo "<center>Voce sera redirecionado em 3 segundos</center>";
		echo "<script type='text/javascript'>setTimeout(function(){window.location.href='".URL_BASE."pagina/minhaConta.php'},3000);</script>";
    }
    	