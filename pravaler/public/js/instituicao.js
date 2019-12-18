

function excluirInstituicao(from){

    var r = confirm("Tem certeza que deseja excluir esta instituição?");
    if (r == true) {
        $("#"+from).submit();
    } else {
        return false;
    }
}
