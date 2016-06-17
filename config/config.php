<?php
define('BASE_URL','https://ilovedoc-ronynogueiras.c9users.io/');
define('SITE_URL','https://ilovedoc-ronynogueiras.c9users.io/index.php/');
define('PATH_CONTROLLERS','./controllers/');
define('PATH_VIEWS','./views/');
define('PATH_ERRO','./views/error/');
define('CONTROLLER_DEFAULT','site');

session_start();
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

/*
* Responsável por realizar uma consulta no banco de dados ( CRUD ).
* @param $sql (string) - String de consulta no Banco de Dados
* @param $parametros (array) - Parâmetros utilizados no SQL
* @param $todos (boolean) - Flag para quantidade de resultados, se true, retorna todos os registro, se false retorna apenas um registro.
* @return array 
*/

function query($sql,$parametros=null,$todos=true){
	$bd = conexaoBancoDados();
	if(is_null($parametros)){
	    $consulta   = $bd->prepare($sql);
	}else if(is_array($parametros)){
		$cont = substr_count($sql,'?');
		for($i=0;$i<$cont;$i++){
			$pos = strpos($sql,'?');
			$sql = substr_replace($sql,':param'.$i,$pos,1);
		}
		$consulta       = $bd->prepare($sql);
		for($i=0;$i<count($parametros);$i++){
		    $param = ":param".$i;
		    $consulta->bindParam($param,$parametros[$i]);
		}
		
	}else{
	    $sql    = str_replace('?',':param0',$sql);
	    $consulta   = $bd->prepare($sql);
	    $consulta->bindParam(":param0",$parametros);
	}
	
	$consulta->execute();
	if(stripos($sql,'SELECT')===0){
		
	    if($consulta->rowCount()>0){
	    	$resultado = ($todos ?  $consulta->fetchAll(PDO::FETCH_OBJ) : $consulta->fetchObject());
	    }else{
	    	$resultado = array();
	    }
    }else if(stripos($sql,'INSERT INTO ')===0)
        $resultado = $bd->lastInsertId();
    else if(stripos($sql,'UPDATE')===0 || stripos($sql,'DELETE')===0)
        $resultado = $consulta->rowCount();

    return $resultado;
}

/*
* Responsável por retornar a URL do site som index.php, concatenada com o caminho passado.
* @param $str (string) - Caminho da URL
* @return string
**/

function base_url($str=''){
    return BASE_URL.$str;
}

/*
* Responsável por retornar a URL do site com index.php, concatenada com o caminho passado.
* @param $str (string) - Caminho da URL
* @return string
**/
function site_url($str=''){
    return SITE_URL.$str;
}

/*
* Responsável por redirecionar para a URL informada, se o caminho for vazio (''), redireciona para a home do site.
* @param $url (string) - Caminho da URL
* @return string
**/

function redirect($url){
	if($url!=''){
		header('location:'.$url);
	}else{
		header('location:'.site_url());
	}
}

/**
* Responsável por retornar um JSON padronizado para requisições AJAX. Visualizar padronização do retorno JSON aqui.
* @param $status (string) - Status do processamento, 'success' ou 'error'
* @param $mensagem (string) - Mensagem de resultado do processamento
* @param $url (string) - URL para redirecionamento após a conclusão da requisição
* @param $dados (mixed) - Dados que podem ser utilizados após a requisições
* @return string
*/

function getResultJSON($status,$mensagem='',$url='',$dados=''){
	$resultado	= array("status"=>$status,"mensagem"=>$mensagem,"url"=>$url,"dados"=>$dados);
	return $resultado;
}

/**
* Responsável por carregar uma página de visualização que será exibida ao usuário.
* @param $view (string) - Caminho para view, composto por pasta e nome do arquivo, para arquivos php não é necessário informar a extensão do arquivo.
* @param $args (array) - Variáveis que serão utilizadas dentro da view.
* @return void
*/

function getView($view,$args=null){
	$ext	= substr(strrchr($view,'.'),1)===false ? 'php' : substr(strrchr($view,'.'),1) ;
	if(!is_null($args)){
		foreach($args as $key=>$value){
			${$key}	= $value;
		}
	}
	$view		= file_exists(PATH_VIEWS.$view.'.'.$ext) ? PATH_VIEWS.$view.'.'.$ext : PATH_ERRO.'404.html';
	require($view);
}

/**
* Responsável por carregar um controller e suas funções
* @param $url (string) - URL da requisição
* @return void 
*/
function getController($url){
	$url	= parse_url($url);
	if(array_key_exists('query',$url)){
		parse_str($url['query'],$output);
		$values		= array_values($output);
		if(file_exists(PATH_CONTROLLERS.$values[0].'.php')){
			require(PATH_CONTROLLERS.$values[0].'.php');
			if(array_key_exists(1,$values)){
				$params = array();
				if(array_key_exists(2,$values)){
					for($i=2;$i<count($values);$i++){
						array_push($params,$values[$i]);
					}
				}
				call_user_func_array($values[1],$params);
			}else{
				call_user_func_array('index',array());
			}
		}else{
			PATH_ERRO.'404.html';
		}
	}else{
		require(PATH_CONTROLLERS.CONTROLLER_DEFAULT.'.php');
		call_user_func_array('index',array());
	}
	
}
/**
* Responsável por verificar se uma $string é json ou não.
* $string (string) - String que será verificada
* @return boolean
*/
function isJson($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}