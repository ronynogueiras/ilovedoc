<div style="width:25%;float:left;">
    <ul>
        <li><a href="<?php echo site_url('?controller=projeto&page=novo')?>">Criar Projeto</a></li>
        <li><a href="<?php echo site_url('?controller=projeto&page=projetos')?>">Meus Projetos</a></li>
        <li><a href="<?php echo site_url('?controller=usuario&page=sair');?>" class="request">Sair</a></li>
    </ul>
</div>
<div style="width:75%;float:left;">
    <h2>Bem vindo, <?php echo ucwords($usuario['us_usuario']);?></h2>
    <hr/>
    <h4>Meus Dados</h4>
    <ul>
        <li>Nome: <b><?php echo $usuario['us_usuario']?></b></li>
        <li>E-mail: <b><?php echo $usuario['us_email']?></b></li>
        <li>Situação: <b><?php echo $usuario['us_situacao']?></b></li>
        <li>Cadastrado em: <b><?php echo date('d/m/Y H:i:s',strtotime($usuario['us_momento']));?></b></li>
    </ul>
</div>