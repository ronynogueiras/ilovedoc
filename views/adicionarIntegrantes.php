<head>
    <title>Compartilhe seu Projeto</title>
</head>

<body>
    <h2><a href="#" id="addScnt">Adicione Integrantes ao seu Projeto</a></h2>

    <div id="p_scents"
        <p>
            <form action="<?php echo base_url('?controller=projeto&page=compartilhar');?>" method="post" class="request">
                <label for="pessoas"><input type="text" id="pessoa" size="20" name="pessoa" value="" placeholder="E-mail do novo integrante" /></label>
        </p>
    </div>
    
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">
    $(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').size() + 1;
            
        $('#addScnt').live('click', function() {
            $('<p><label for="pessoas"><input type="text" id="pessoa" size="20" name="pessoa_' + i +'" value="" placeholder="E-mail do novo integrante" /></label> <a href="#" id="remScnt">Remover</a></p>').appendTo(scntDiv);
            i++;
            return false;
        });
    
        $('#remScnt').live('click', function() { 
            if( i > 2 ) {
                $(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });
    </script>
    <button type="submit">Compartilhar</button>
    </form>
</body>