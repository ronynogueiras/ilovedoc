<!--
 ! Código responsável pela tela inicial da aplicação
 ! @author Pedro Victor e Rony Nogueira
 ! @version 1.0
 ! -->

<html>
    <head>
        <title> Home - ILD</title>
    </head>
    <body>
    <?php
    // A simple web site in Cloud9 that runs through Apache
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console
    
    require('script/bancoDados.php');
    echo '<center><h1>Bem vindo ao iLoveDocumentation</h1></center>';
    ?>
    <br/>
        <center>
            <a href="../pagina/cadastro.html">Cadastrar</a><br/>
            <a href="../pagina/entrar.php">Entrar</a><br/>
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