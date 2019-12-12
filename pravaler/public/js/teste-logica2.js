$(document).ready(function(){
    alert("Atenção! Como este teste é de lógica não foram feitas validações e nem formatações dos números. Então parto do princípio que só serão inseridos valores válidos. Os calculos foram deitos via JavaScript.")
    $('#calculado').hide();
});
function calculaValorDesconto(){
    massa = $('#massa').val();
    tempo = 0 ;
    massa_final = massa;

    while (massa_final >= 0.10){
        massa_final -= massa_final * 0.25;
        tempo = tempo + 30;
    }

    resposta =  tempo + " Segundos";
    $('#total').text(resposta);

    $('#calculado').show();
}
