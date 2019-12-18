
$(document).ready(function(){
    $('#filtro_instituicao').change(function(){
        $('#form_filtro_instituicao').submit();
    });
});


function excluirCurso(from){

    var r = confirm("Tem certeza que deseja excluir esta instituição?");
    if (r == true) {
        $("#"+from).submit();
    } else {
        return false;
    }
}
