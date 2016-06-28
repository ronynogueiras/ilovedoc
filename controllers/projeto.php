<?php 
function index(){
    //index off
}
/**
* Método responsável por listar os projetos do usuário logado
* @author Raphael Ferreira
* @version 1.0
*/
function projetos()
{
    if(isset($_SESSION['_id'])){
        $projetos       = query("SELECT * FROM projetos WHERE pr_usuario=? AND pr_situacao='Ativo'",$_SESSION['_id']);
        getView('template/header');
        getView('projetos',array('projetos'=>$projetos));
        getView('template/footer');
    }else{
        redirect(site_url('?controller=usuario&page=entrar'));
    }
}

/**
* Método responsável por listar os dados de um projeto especifíco
* @author Raphael Ferreira
* @param $id integer - Identificador do projeto
* @version 1.0
*/
function projeto($id)
{
    if(isset($_SESSION['_id'])){
        $projeto        = query("SELECT * FROM projetos WHERE pr_usuario=? AND pr_id=? AND pr_situacao='Ativo'",array($_SESSION['_id'],$id),false);
        getView('template/header');
        getView('projeto',array('projeto'=>$projeto));
        getView('template/footer');
    }else{
        redirect(site_url('?controller=usuario&page=entrar'));
    }
}
/**
* Método responsável por exibir a view para o cadastro de um novo projeto 
* @author Raphael Ferreira
* @version 1.0
*/
function novo(){
    if(isset($_SESSION['_id'])){
        getView('template/header');
        getView('novoProjeto');
        getView('template/footer');
    }else{
        redirect(site_url('?controller=usuario&page=entrar'));
    }
}
/**
* Método responsável por salvar um projeto que está sendo criado ou que foi editado
* @author Gabriel Barbosa
* @param $id integer - identificador do projeto, se 0, cadastrar novo projeto, se diferente de 0, atualiza um projeto.
* @version 1.0
* @return string JSON
*/
function salvar(){
    if(isset($_SESSION['_id'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        if(trim($nome)!='' && trim($descricao)!=''){
            $query  = query("SELECT * FROM projetos WHERE pr_nome=?",array($nome));
            if(count($query)==0){
                if($id==0)
                    $query  = query("INSERT INTO projetos (pr_nome,pr_descricao,pr_usuario,pr_situacao,pr_momento) VALUES (?,?,?,'Ativo',now())",array($nome,$descricao,$_SESSION['_id']));
                else
                    $query  = query("UPDATE projetos SET pr_nome=?, pr_descricao=? WHERE pr_id=? AND pr_usuario=?",array($nome,$descricao,$id,$_SESSION['_id']));
                    
                if($query){
                    $id = $id == 0 ? $query : $id;
                    $resposta   = getResultJSON("success","Projeto cadastrado com sucesso",site_url('?controller=projeto&page=projeto&id='.$id));
                }else{
                    $resposta   = getResultJSON("error","Erro ao cadastrar projeto, entre em contato com o suporte");
                }
            }else{
                $resposta   = getResultJSON("error","Um projeto com este nome já existe, escolha outro");
            }
        }else{
            $resposta   = getResultJSON("error","O nome e a descrição do projeto devem ser informados");
        }
    }else {
        $resposta   = getResultJSON("error","Autenticação inválida, faça login novamente",site_url('?controller=usuario&page=entrar'));
    }
    echo json_encode($resposta);
}

/**
* Método responsável por atualizar a situação de um projeto para 'Apagado'
* @author Gabriel Barbosa
* @param $id integer - identificador do projeto
* @version 1.0
* @return string JSON
*/

function apagar($id){
    if($_SESSION['_id']){
        if(is_numeric($id)){
            $query      = query("UPDATE projetos SET pr_situacao='Desativado' WHERE pr_id=? AND pr_usuario=?",array($id,$_SESSION['_id']));
            if($query){
                $resposta   = getResultJSON("success","Projeto excluído com sucesso",".");
            }else{
                $resposta   = getResultJSON("error","Erro ao excluir o projeto, entre em contato com a equipe de suporte.");
            }
        }else{
            $resposta   = getResultJSON("error","Identificador do projeto não é válido");
        }
    }else{
        $resposta   = getResultJSON("error","Autenticação inválida, faça login novamente",site_url('?controller=usuario&page=entrar'));
    }
    echo json_encode($resposta);
}


/*
<<<<<<< HEAD
* Método responsável por compartilhar Projeto com outros usuários
* @author Pedro Victor
* @param $id integer - identificador do projeto
* @version 1.0
* @return string JSON
*/
/*function compartilhar($id){
    if($_SESSION['_id']){
    $pessoa           = $_POST['pessoa'];
    if(is_numeric($id)){
        $query      = query("INSERT * INTO integrantes_projeto WHERE ip_pessoa=? AND ip_projetoID=?", array($id,$_SESSION['_id']));
        if($query){*/

/*Método responsável por realizar o compartilhamento de determinado projeto com alguma(s) pessoa(s).
* @author Pedro Victor
* @version 1.0
* @param $nome String - Nome do projeto
* @param $email String - E-mail da pessoa a ser adicionada ao projeto
* @return array com a resposta padronizada
*/

// FAZENDO
/*function compartilhar($id) {
    if($_SESSION['_id']){
        $nome = $_POST['nome'];
        
        if(is_numeric($id)){
            $query  = query("SELECT * FROM projetos WHERE pr_nome=?",array($nome));
            if(count($query)==0){
                if($id==0)
                    $query  = query("SELECT * FROM usuarios WHERE us_email=? AND us_situacao='Ativo'",array($email),false);
            
            
            /*if($query){
>>>>>>> 6530dc65ba42ad9d32c37e63daed8e81a9f5e42b
                $resposta   = getResultJSON("success","Projeto excluído com sucesso",".");
            }else{
                $resposta   = getResultJSON("error","Erro ao excluir o projeto, entre em contato com a equipe de suporte.");
            }
        }else{
            $resposta   = getResultJSON("error","Identificador do projeto não é válido");
        }
    }else{
        $resposta   = getResultJSON("error","Autenticação inválida, faça login novamente",site_url('?controller=usuario&page=entrar'));
    }
    echo json_encode($resposta);
<<<<<<< HEAD
}