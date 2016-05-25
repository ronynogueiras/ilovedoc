<?php 
/**
* Este arquivo contém um exemplo de utilização das consultas no banco de dados (CRUD)
*/
//A conexão com o Banco de dados deve ser sempre adicionada através do comando da próxima linha
require('bancoDados.php');

//Instância de uma conexão com o banco de dados

$bancoDados =  conexaoBancoDados();

//Exemplo de INSERT 
$valor1     = $valor2 = $valor = 'abc';
$sql        = "INSERT INTO tabela (campo1,campo2,campo3) VALUES (:valor1,:valor2,:valor3)";
$consulta   = $bancoDados->prepare($sql); // Preparar o SQL
$consulta->bindParam('valor1',$valor1);
$consulta->bindParam('valor2',$valor2);
$consulta->bindParam('valor3',$valor3);
$consulta->execute();
$sucesso    = $bancoDados->lastInsertId(); //Retorna o ultimo ID inserido na tabela

//Exemplo de SELECT
$valor1     = 1;
$valor2     = 2;
$sql        = "SELECT * FROM tabela WHERE campo1=:valor1 AND campo2=:valor2";
$consulta   = $bancoDados->prepare();
$consulta->bindParam("valor1",$valor1);
$consulta->bindParam("valor2",$valor2);
$consulta->execute();

$qtdLinhas  = $consulta->rowCount(); //Esta verificação deve ser realizada
if($qtdLinhas>0){
    $dados  = $consulta->fetchAll();//Retorna todas as linhas selecionadas na tabela
    print_r($dados);
}else
    print_r("Nenhuma informações encontrada");
    
//Exemplo de UPDATE

$valor1     = 'a';
$valor2     = 'b';
$valor3     = 1;
$sql        = "UPDATE tabela SET campo1=:valor1,campo2=:valor2 WHERE campo3=:valor3";
$consulta   = $bancoDados->prepare($sql);
$consulta->bindParam("valor1",$valor1);
$consulta->bindParam("valor2",$valor2);
$consulta->bindParam("valor3",$valor3);
$consulta->execute();
$sucesso    = $consulta->rowCount()>0;

//Exemplo de DELETE

$valor1     = 1;
$sql        = "DELETE FROM tabela WHERE campo1=:valor1";
$consulta   = $bancoDados->prepare($sql);
$consulta->bindParam("valor1",$valor1);
$consulta->execute();
$sucesso    = $consulta->rowCount()>0;
//Exemplo de REPLACE

$valor1     = $valor2 = $valor = 'abc';
$sql        = "REPLACE INTO tabela (campo1,campo2,campo3) VALUES (:valor1,:valor2,:valor3)";
$consulta   = $bancoDados->prepare($sql); // Preparar o SQL
$consulta->bindParam('valor1',$valor1);
$consulta->bindParam('valor2',$valor2);
$consulta->bindParam('valor3',$valor3);
$consulta->execute();
$sucesso    = $bancoDados->lastInsertId(); //Retorna o ultimo ID inserido na tabela