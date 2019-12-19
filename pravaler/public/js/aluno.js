
$(document).ready(function(){

});


function excluirAluno(from){

    var r = confirm("Tem certeza que deseja excluir este Aluno?");
    if (r == true) {
        $("#"+from).submit();
    } else {
        return false;
    }
}
