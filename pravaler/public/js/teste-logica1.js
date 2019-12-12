$(document).ready(function(){
    alert("Atenção! Como este teste é de lógica não foram feitas validações e nem formatações dos números. Então parto do princípio que só serão inseridos valores válidos. Os calculos foram deitos via JavaScript.")
    $('#calculado').hide();
});
function calculaValorDesconto(){
    quantidade = $('#quantidade').val();
    preco = $('#preco').val();
    total = quantidade * preco;

    if(quantidade > 10){
        desconto = 5 / 100;
    }else if(quantidade > 5){
        desconto = 3 / 100;
    }else{
        desconto = 2 / 100;
    }

    $('#total').text(total);
    $('#desconto').text(total * desconto);
    $('#total_pagar').text(total - (total * desconto));

    $('#calculado').show();
}
