function inserir_registo() {

    //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
    var usuario = $("#usuario").val();
    var senha = $("#senha").val();
    alert(usuario);
    alert(senha);
    //para consultar mais opcoes possiveis numa chamada ajax
    //http://api.jquery.com/jQuery.ajax/
    $this = $("#btnEntrar");
    $this.prop("disabled", true); // Desativa botão enviar para evitar o envio de mensagens duplicadas
    $.ajax({

        url: "http://blog/entrar.php",
        type: "POST",
        data: {
            usuario: usuario,
            senha: senha,
        },
        cache: false,

        //se ocorrer um erro na chamada ajax, retorna este alerta
        //possiveis erros: pagina nao existe, erro de codigo na pagina, falha de comunicacao/internet, etc etc etc
        error: function () {
            alert('Erro: Inserir Registo!!');
        },
        //retorna o resultado da pagina para onde enviamos os dados
        success: function (result) {
            //se foi inserido com sucesso
            if ($.trim(result) == '0') {
                alert("O seu registo foi inserido com sucesso!");
            }
            //se foi um erro
            else {
                alert("Ocorreu um erro ao inserir o seu registo!");
            }

        },
        complete: function () {
            setTimeout(function () {
                $this.prop("disabled", false); // Reativar botão de enviar
            }, 1000);
        }
    });
}