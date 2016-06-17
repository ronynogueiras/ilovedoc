<div>
    <form action="<?php echo site_url('?controller=projeto&page=salvar');?>" method="post" class="request">
        <input type="hidden" name="id" value="0"/>
        <label>Nome <br/><input type="text" name="nome" placeholder="Nome do projeto"/></label><br/><br/>
        <label>Descrição <br/><textarea name="descricao" rows="8" style="width:60%;" placeholder="Descrição do projeto aqui"></textarea></label><br/>
        <input type="submit" value="Salvar"/>
    </form>
</div>