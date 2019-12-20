var flag = false;
$(document).ready(function(){
    if($('#filtro_instituicao').val()){
        flag = true;
        buscarCursos();

    }
    $("#filtro_instituicao").change(function(){
        buscarCursos();
    });


    if($('#instituicao').val()){
        flag = true;
        buscarCursosCadastro();

    }

    $("#instituicao").change(function(){
        buscarCursosCadastro();
    });
});

function buscarCursos(){
    limparComboCurso();
    url = $('#url_ajax').val() + $('#filtro_instituicao').val();
    $.ajax({
        url: url,
    success: function(result){
        json = JSON.parse(result);
        html = "";
        for(i=0; i < json.length; i++){
        html += " <option value="+json[i].id+" > " + json[i].nome + "</option>" ;
        }
        $('#filtro_curso').append(html);
        if(flag){
            temp = $('#temp_curso').val();
            $('#filtro_curso option[value='+temp+']').attr('selected','selected');
            flag = false;
        }
    }});

}

function buscarCursosCadastro(){
    limparComboCursoCadastro();
    url = $('#url_ajax').val() + $('#instituicao').val();
    $.ajax({
        url: url,
    success: function(result){
        json = JSON.parse(result);
        html = "";
        for(i=0; i < json.length; i++){
        html += " <option value="+json[i].id+" > " + json[i].nome + "</option>" ;
        }
        $('#curso').append(html);
        if(flag){
            temp = $('#temp_curso').val();
            $('#curso option[value='+temp+']').attr('selected','selected');
            flag = false;
        }
    }});

}

function limparComboCurso(){
    $('#filtro_curso').html('');
    $('#filtro_curso').append("<option value=''>Selecione a instituicao</option>");
}

function limparComboCursoCadastro(){
    $('#curso').html('');
    $('#curso').append("<option value=''>Selecione a instituicao</option>");
}
function excluirAluno(from){

    var r = confirm("Tem certeza que deseja excluir este Aluno?");
    if (r == true) {
        $("#"+from).submit();
    } else {
        return false;
    }
}
