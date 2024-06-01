<?php
    $app = true;
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
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

    $(".acessar").click(function(){


        idUnico = localStorage.getItem("idUnico");
        codUsr = localStorage.getItem("codUsr");

        if(codUsr*1 > 0){
            $.ajax({
                url:"usuarios/dados.php",
                type:"POST",
                data:{
                    idUnico,
                    codUsr
                },
                success:function(dados){
                    $(".home_corpo").html(dados);
                }
            });
        }else{
            $.ajax({
                url:"usuarios/principal.php",
                success:function(dados){
                    $(".home_corpo").html(dados);
                }
            });            
        }
    })


})

	

</script>