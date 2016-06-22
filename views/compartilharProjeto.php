<!--R5 - Adicionar Pessoas - Para a adição de pessoas ao projeto deve ser informado o projeto e o e-mail do usuário, verificar se o e-mail está cadastrado no sistema, se não estiver, enviar um e-mail para a pessoa-->
<div>
    <center>
        <legend>Compartilhar Projeto</legend>
        <form action="<?php echo base_url('?controller=projeto&page=compartilhar')?>" method="post" class="request">
            <label>O nome do projeto que desejas compartilhar</label> 
            <input type="text" name="nome" placeholder="Projeto"><br/>
            <label>O e-mail de quem desejas compartilhar</label>
            <input type="email" name="email" placeholder="Email do amigo"><br/>
            <button type="submit">Adicionar ao Projeto</button>
        </form>
    </center>
</div>

