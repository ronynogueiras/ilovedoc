<div>
    <center>
        <legend>Cadastro</legend>
        <form action="<?php echo base_url('?controller=usuario&page=cadastrar')?>" method="post" class="request">
            <label>Seu nome</label> 
            <input type="text" name="nome" placeholder="Digite seu nome"><br/>
            <label>Seu e-mail</label>
            <input type="email" name="email" placeholder="Digite seu email"><br/>
            <label>Senha de acesso</label>
            <input type="password" name="senha" placeholder="Digite sua senha"><br/>
            <button type="submit">Cadastrar</button>
        </form>
    </center>
</div>