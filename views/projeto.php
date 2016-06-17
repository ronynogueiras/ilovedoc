<div class="ui raised very padded text container segment">
    <div class="ui breadcrumb">
      <a href="<?php echo base_url('?controller=usuario&page=conta')?>" class="section">Conta</a>
      <i class="right angle icon divider"></i>
      <a href="<?php echo base_url('?controller=projeto&page=projetos')?>" class="section">Projetos</a>
      <i class="right angle icon divider"></i>
      <div class="active section">Detalhe do Projeto</div>
    </div>
    <div id="projeto">
        <h2 class="ui header"><?php echo $projeto->pr_nome?></h2>
        <p><?php echo $projeto->pr_descricao;?></p>
    </div>
</div>