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
    <div class="m-1">
        <div class="row g-0">
            <div class="col">
                <div class="d-flex justify-content-center  flex-column" >
                    <div class="card">
                        <img src="img/logo.png" class="card-img-top" />
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home_rodape"></div>

<script>

$(function(){

    $.ajax({
        url:"rodape/rodape.php",
        success:function(dados){
            $(".home_rodape").html(dados);
        }
    });


})

	

</script>