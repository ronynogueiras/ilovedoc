<?php 
require('../script/bancoDados.php');
?>

<!--
 ! Código responsável pela tela de Inicio do Usuario Logado
 ! @author Pedro Victor
 ! @version 1.0
 ! -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Minha Conta</title>
	</head>
	<script type="text/javascript" >
		function toggle(obj) {
				var el = document.getElementById(obj);
				if ( el.style.display != 'none' ) {
					el.style.display = 'none';
				}
				else {
					el.style.display = '';
				}
				return false;
			}
	</script>
	<body>
		<?php
			if(!isset($_SESSION["uid"])) {
				header("Location: ../pagina/entrar.html");
				exit;
			}else {
				echo "<h2><center> Ola ".$_SESSION['nome']."!</center></h2>";
			}
	?>
	</br>
		<div id=topright>
			<a href="../script/logout.php">Sair</a>
		</div>
		
		<div id="men">
				<h3>Menu</h3>
		</div>
		<div id="menu">
		  <ul>
			<li><a href="../pagina/cadastroProjeto.html">Cadastrar um Novo Projeto</a></li>
			<li><a href="../pagina/deletarProjeto.html">Deletar um Projeto</a></li>
		  </ul>
		</div>
		
		<div id="proj">
			<?php
			//A conexão com o Banco de dados deve ser sempre adicionada através do comando da próxima linha
			
			
			//Instância de uma conexão com o banco de dados

			$bancoDados =  conexaoBancoDados();
			$valor1     = $_SESSION["uid"];
			$sql        = "SELECT * FROM projetos WHERE pr_usuario=:valor1";
			$consulta   = $bancoDados->prepare($sql);
			$consulta->bindParam("valor1",$valor1);
			$consulta->execute();
			
			$qtdLinhas  = $consulta->rowCount(); //Esta verificação deve ser realizada
			if($qtdLinhas>0){
				echo '<h2>Meus Projetos</h2>';
			    $projetos  = $consulta->fetchAll();//Retorna todas as linhas selecionadas na tabela
			    echo '<ul>';
			    foreach ($projetos as $projeto) {
			    	echo '<li>';
			    		echo '<a href="javascript:void(0);" onClick="toggle(\''.$projeto['pr_id'].'\');">'.$projeto['pr_nome'].'</a><br/>';
			    		echo '<div id="'.$projeto['pr_id'].'" style="display:none"><p>'.$projeto['pr_descricao'].'</p></div>';
			    	echo '</li>';
			    }
			    echo '</ul>';
			}else{
			    echo '<h2>Voce ainda não tem nenhum projeto</h2>';
			    echo '<a href="../pagina/cadastroProjeto.html">Cadastre seu primeiro projeto</a>';
				
			}
		?>
			
		</div>
		
		<style type="text/css">
	            a:link, a:visited {
	            	text-decoration: none;
	            	color: blue;
	            	}
	            a:hover {
	            	text-decoration: underline; 
	            	color: #f00
	            	}
	            a:active {
	            	text-decoration: none
	            	}
	            	
				#topright {
					position:absolute;
					top: 0;
					right: 5px; 
					font-size: 20px;
				}
	            	
	            body {
					color: #000;
					font: 12px Verdana, sans-serif;
					}
					
				#conteudo {
					width: 10%;
					float: left;
					text-align: center;
					}
					
				#proj {
					margin: 0; padding: 0;
					float: left;
					position: absolute;
					left: 600px;
				}
				
				#menu {
					width: 30%;
					margin: 0; padding: 0;
					float: left;
					position: absolute;
					left: 5px;
					top: 70px;
					}
				
				#men {
					top: 0px;
					position:absolute;
					left: 190px; 
					font-size: 20px;
				}
					
				#menu ul li {
					margin: 0; padding: 0px;
					border-bottom: 1px solid #CCC;
					text-align: left;
					list-style-type: none;
					}
					
				#menu a:link {
					background: #F5F5F5;
					color: #666;
					font-weight: bold;
					text-decoration: none;
					padding: 8px;
					display: block;
					}
					
				#menu a:hover {
					background: #E5F0FF;
					color: #039;
					}
	    </style>
	    
	</body>
</html>