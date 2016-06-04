<!--
 ! Código responsável pela tela de Login
 ! @author Pedro Victor
 ! @version 1.0
 ! -->
 <?php 
    if($_SESSION['uid'])
        header('location:'.URL_BASE.'pagina/minhaConta.php');
    
 ?>
<html>
    <head>
        <title> Login de Usuario </title>
    </head>
    <body>
        <center>
            <form method="POST" action="../script/entrando.php">
                <label>Email: </label><input type="text" name="email" id="email"><br>
                <label>Senha: </label><input type="password" name="senha" id="senha"><br>
                <input type="submit" value="Entrar" id="entrar" name="entrar"><br>
                <a href="../pagina/cadastro.html">Cadastre-se</a><br>
                <a href="../pagina/redefinirSenha.html">Esqueci minha senha</a><br>
            </form>
        </center>
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
        </style>
    </body>
</html>