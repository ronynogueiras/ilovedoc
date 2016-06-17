<div style="width:100%;">
    <center>
            <legend>Acesso ao sistema</legend>
            <form action="<?php echo base_url('?controller=usuario&page=autenticar')?>" method="post" class="request">
                <label>Seu e-mail<br/>
                    <input type="email" name="email" placeholder="Digite seu email">
                </label><br/>
                <label>Senha de acesso<br/>
                    <input type="password" name="senha" placeholder="Digite sua senha">
                </label>
                <label>
                    <p>
                        <a href="<?php echo site_url('?controller=usuario&page=recuperar')?>">Esqueci minha senha</a>
                        </p>
                </label><br/>
                <button type="submit">Entrar</button>
        </form>
    </center>
</div>
