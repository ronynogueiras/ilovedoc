// JavaScript File
function request(dados){
    if(dados !== undefined){
        var ajax;
        ajax = $.ajax({
            url: dados.url,
            type: dados.type,
            cache: false,
            data: dados.data,
            dataType: dados.dataType==''?'json':dados.dataType,
            statusCode:{
                404 : function(){
                    alert("Página não encontrada (Erro:404)");
                },
                500 : function(){
                    alert("Erro interno, entre em contato com o suporte. (Erro:500)");
                },
                403: function(){
                    alert("Acesso negado. (Erro:403)");
                },
                401: function(){
                    alert("Acesso não autorizado. (Erro:401)");
                }
            },
            beforeSend: function (xhr){
                $('div.loader').removeClass('disabled').addClass('active');
            }
        });
        ajax.done(function(data,status,xhr){
            try {
                var json = $.parseJSON(data);
                if(json.url=='.'){
                    window.location.reload();
                }else if(json.url!=''){
                    window.location.href=json.url;
                }
                if(json.mensagem!=''){
                    alert(json.mensagem);
                }
                
            }catch (erro){
                alert("Ocorreu um erro inesperado, entre em contato com o suporte.");
                console.log(erro);
            }
            console.log(xhr);
            console.log(status);
            console.log(data);
        });
        ajax.fail(function(xhr,status,error){
            var erros = [404,500,401,403];
            if(erros.indexOf(xhr.status)==-1)
                alert("Ocorreu um erro inesperado, entre em contato com o suporte.");
            console.log(xhr);
            console.log(status);
            console.log(error);
        });
        ajax.always(function(data,status,error){
            console.log(data);
            console.log(status);
            console.log(error);
            $('div.loader').removeClass('active').addClass('disabled');
        });
        return ajax;
    }else{
        return false;
    }
}

function ajaxHtml(dados){
    if(dados!==undefined){
        $('div.loader').removeClass('disabled').addClass('active');
        $(dados.target).load(dados.url,(dados.data? dados.data : {}), function(response,status,xhr){
            if(status=='error'){
                alert("Ocorreu um erro inesperado, entre em contato com o suporte.");
                console.log(xhr.status+":"+xhr.statusText);
            }
            $('div.loader').removeClass('active').addClass('disabled');
        });
    }else{
        return false;
    }
}
$(function(){
    $('div.loader').addClass('disabled');
    $(document).on('click','a.request',function(){
        var dados = {url:$(this).attr('href'),type:$(this).attr('data-type'),data:$(this).attr('data-data')};
        request(dados);
        return false;
    });
    $('form.request').submit(function(){
        var dados = {url:$(this).attr('action'),type:$(this).attr('method'),data:$(this).serialize()};
        request(dados);
        return false;
    });
});