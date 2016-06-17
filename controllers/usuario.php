<?php 

function index(){
    echo 'index ok';
}

/**
* Método responsável por exibir a view de cadastro para o usuário
* @author Pedro Victor
* @version 1.0
*/
function cadastro(){
    getView('template/header');
    getView('cadastro');
    getView('template/footer');
}

/**
* Método responsável por realizar o cadastro de um novo usuário no sistema.
* @author Pedro Victor
* @version 1.0
* @param $nome String - Nome do usuário
* @param $email String - E-mail do usuário
* @param $senha String - Senha de acesso ao sistema
* @return array com a resposta padronizada
*/
function cadastrar(){
    $nome           = $_POST['nome'];
    $email          = $_POST['email'];
    $senha          = $_POST['senha'];
    if($nome!='' && $email !='' && $senha!=''){
        $query      = query("SELECT * FROM usuarios WHERE us_email=?",array($email),false);
        if(count($query)==0){
            $query      = query("INSERT INTO usuarios (us_usuario,us_email,us_senha,us_situacao,us_tipo,us_momento) VALUES (?,?,md5(?),'Ativo',1,now())",array($nome,$email,$email.$senha));
            $id         = $query;
            $resultado  = getResultJSON("success","Cadastrado com sucesso",site_url('?controller=usuario&page=entrar'),$id);
        }else{
            $resultado  = getResultJSON("error","O e-mail informado já foi cadastrado");
        }
    }else{
        $resultado  = getResultJSON("error","Todos os campos devem ser informados");
    }
    echo json_encode($resultado);
}
/**
* Método responsável por exibir a view de login para o usuário
* @author Pedro Victor
* @version 1.0
*/
function entrar(){
    if(isset($_SESSION['_id']) && $_SESSION['_id']!=''){
        redirect(site_url('?controller=usuario&page=conta'));
    }else{
        getView('template/header');
        getView('entrar');
        getView('template/footer');
    }
}
/**
* Método responsável por realizar a autenticação de um usuário no sistema.
* @author Pedro Victor
* @version 1.0
* @param $email String - E-mail do usuário
* @param $senha String - Senha de acesso ao sistema
* @return array com a resposta padronizada
*/
function autenticar(){
    $email      = $_POST['email'];
    $senha      = $_POST['senha'];
    if($email!='' && $senha!=''){
        $usuario      = query("SELECT * FROM usuarios WHERE us_email=? AND us_senha=md5(?)",array($email,$email.$senha),false);
        settype($usuario,'array');
        if(count($usuario)>0){
            session_start();
            $_SESSION['_id']    = $usuario['us_id'];
            $_SESSION['_nome']  = $usuario['us_usuario'];
            $resultado  =   getResultJSON("success","Autenticado com sucesso!",site_url('?controller=usuario&page=conta'),$usuario);
        }else{
            $resultado  =   getResultJSON("error","Email ou senha inválidos");
        }
    }else{
        $resultado  =   getResultJSON("error","Todos os campos devem ser informados");
    }
    echo json_encode($resultado);
}

/**
* Método responsável por realizar a saída de um usuário no sistema.
* @author Pedro Victor
* @version 1.0
* @return array com a resposta padronizada
*/
function sair(){
    
    session_start();
    $_SESSION['_id'] = null;
    $_SESSION['_nome'] = null;
    session_destroy();
    echo json_encode(getResultJSON("success","Logout realizado com sucesso",site_url('')));
}
/**
* Método responsável por exibir a view com os dados da conta do usuário
* @author Rony Nogueira
* @version 1.0
* @param $uid String - ID do usuário ou E-mail de acesso
* @return array com a resposta padronizada
*/
function conta(){
    if(isset($_SESSION['_id']) && $_SESSION['_id']!=''){
        getView('template/header');
        $usuario    = query("SELECT * FROM usuarios WHERE us_id=?",array($_SESSION['_id']),false);
        if(count(settype($usuario,'array'))>0){
            getView('conta',array('usuario'=>$usuario));
        }else{
            //exibir mensagem de erro 
        }
        getView('template/footer');
    }else{
        redirect(site_url('?controller=usuario&page=entrar'));
    }
}
/**
* Método responsável por exibir a view para a recuperação da senha de acesso
* @author Lucas Vinicios
* @version 1.0
*/
function recuperar(){
    getView('template/header');
    getView('recuperarSenha');
    getView('template/footer');
}
/**
* Método responsável por atualizar a senha de um usuário
* @author Lucas Vinicios
* @version 1.0
* @param $email String - e-mail de acesso
* @param $novaSenha String - nova senha de acesso
* @return array com a resposta padronizada
*/

function redefinirSenha(){
    $email = $_POST['email'];
    $novaSenha = $_POST['novaSenha'];
    if(filter_var($email, FILTER_VALIDATE_EMAIL) && $novaSenha!=''){
        $query  = query("SELECT * FROM usuarios WHERE us_email=? AND us_situacao='Ativo'",array($email),false);
        settype($query,'array');
        if(count($query)>0){
            $id     = $query['us_id'];
            $query  = query("UPDATE usuarios SET us_senha=md5(?) WHERE us_id=?",array($email.$novaSenha,$id));
            if($query){
                $resultado  =   getResultJSON("success","Senha atualizada com sucesso",site_url('?controller=usuario&page=entrar'));
            }else{
                $resultado  =   getResultJSON("error","Erro na atualização da senha.");
            }
        }else{
            $resultado  =   getResultJSON("error","O e-mail informado não está cadastrado no sistema");
        }
    }else{
        $resultado  =   getResultJSON("error","E-mail válido e senha devem ser informados.");
    }
    echo json_encode($resultado);
}
