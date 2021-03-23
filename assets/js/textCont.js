$(document).on("input", "#texto", function () {
    var limite = 5000;
    var informativo = "/5000.";
    var textoDigitados = $(this).val().length;
    var textoRestantes = limite - textoDigitados;

    if (textoRestantes <= 0) {
        var texto = $("textarea[name=texto]").val();
        $("textarea[name=texto]").val(texto.substr(0, limite));
        $(".texto").text("0 " + informativo);
    } else if (textoRestantes >= 101) {
        $(".texto").css("color", "#000000");
        $(".texto").text(textoRestantes + " " + informativo);
    } else if (textoRestantes >= 0 && textoRestantes <= 100) {
        $(".texto").css("color", "red");
        $(".texto").text(textoRestantes + " " + informativo);
    } else {
        $(".texto").text(textoRestantes + " " + informativo);
    }
});
$(document).on("input", "#descricao", function () {
    var limite = 150;
    var informativo = "/150.";
    var caracteresDigitados = $(this).val().length;
    var caracteresRestantes = limite - caracteresDigitados;

    if (caracteresRestantes <= 0) {
        var descricao = $("textarea[name=descricao]").val();
        $("textarea[name=descricao]").val(descricao.substr(0, limite));
        $(".caracteres").text("0 " + informativo);
    } else if (caracteresRestantes >= 31) {
        $(".caracteres").css("color", "#000000");
        $(".caracteres").text(caracteresRestantes + " " + informativo);
    } else if (caracteresRestantes >= 0 && caracteresRestantes <= 30) {
        $(".caracteres").css("color", "red");
        $(".caracteres").text(caracteresRestantes + " " + informativo);
    } else {
        $(".caracteres").text(caracteresRestantes + " " + informativo);
    }
});
