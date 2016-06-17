<div style="width:25%;float:left;">
    <ul>
        <li><a href="<?php echo site_url('?controller=projeto&page=novo')?>">Criar Projeto</a></li>
        <li><a href="<?php echo site_url('?controller=projeto&page=projetos')?>">Meus Projetos</a></li>
        <li><a href="<?php echo site_url('?controller=usuario&page=sair');?>" class="request">Sair</a></li>
    </ul>
</div>
<div style="width:75%;float:left;">
    <h3>Meus Projetos</h3>
    
        <?php 
        if(count($projetos)>0){ 
            echo '<ul>';
            $html        = '';
            foreach($projetos as $projeto){
                echo '<li><a href="'.site_url('?controller=projeto&page=apagar&id='.$projeto->pr_id).'" class="request"><img src="'.base_url('static/img/Delete-48.png').'" width="24" height="24"/></a><a href="'.site_url('?controller=projeto&page=projeto&id='.$projeto->pr_id).'">'.$projeto->pr_nome.'</a><br/>';
                echo '<span>'.$projeto->pr_descricao.'</span>';
                echo '</li>';
            }
            echo '</ul>';
        ?>
        
        <?php 
        }else{
            echo '<h4>Você ainda não possui nenhum projeto.</h4>';
        }
        ?>
</div>
