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

<div class="home_topo"></div>
<div class="home_corpo">
    <h1>Teste</h1>
</div>
<div class="home_rodape"></div>

<script>

$(function(){

   
    $.ajax({
        url:"topo/topo.php",
        success:function(dados){
            $(".home_topo").html(dados);
        }
    });

    $.ajax({
        url:"rodape/rodape.php",
        success:function(dados){
            $(".home_rodape").html(dados);
        }
    });


})

	

</script>