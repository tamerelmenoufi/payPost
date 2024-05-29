<?php
    $app = true;
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['idUnico']){
        mysqli_query($con, "insert into vendas_tmp set id_unico = '{$_POST['idUnico']}', cliente='{$_POST['codUsr']}', detalhes='{}'");
    }
?>
<style>
    .home_corpo{
        position: absolute;
        top:0;
        bottom:80px;
        overflow:auto;
        background-color:#fff;
        width:100%;
    }

    .home_rodape{
        position: absolute;
        background-color:#fff;
        width:100%;
        bottom:0;
        height:80px;
    }
</style>

<div class="home_corpo">
    <div class="m-3">
        <div class="row g-0">
            <div class="col-12">
                <div class="d-flex align-items-center flex-column w-100" >
                    <img src="img/logo.png" style="width:200px;" class="img-fluid" />
                    <!-- <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" inputmode="numeric" class="form-control form-control-lg" id="cpf" aria-describedby="cpf-mensagem">
                        <div id="cpf-mensagem" class="form-text">Digite seu CPF para iniciar a sessão.</div>
                        <button type="button" class="btn btn-warning btn-lg w-100 acessar">Acessar</button>
                    </div> -->
                    <button type="button" class="btn btn-warning btn-lg w-100 acessar">Acessar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home_rodape"></div>

<script>

$(function(){

    $("#cpf").mask("999.999.999-99");

    $.ajax({
        url:"rodape/rodape.php",
        success:function(dados){
            $(".home_rodape").html(dados);
        }
    });


    $.ajax({
        url:"usuarios/principal.php",
        success:function(dados){
            $(".home_corpo").html(dados);
        }
    });



    $(".acessar").click(function(){
        cpf = $("#cpf").val();
        console.log(cpf)
        console.log(cpf.length)
        if(!cpf || cpf.length != 14){
            $.alert('Informe um CPF válido!');
            return;
        }
        Carregando();
        idUnico = localStorage.getItem("idUnico");
        codUsr = localStorage.getItem("codUsr");
        $.ajax({
            url:"usuarios/dados.php",
            type:"POST",
            data:{
                cpf,
                historico:'.CorpoApp'
            },
            success:function(dados){
                Carregando('none');
                $(".CorpoApp").html(dados);
            }
        })
    })


})

	

</script>