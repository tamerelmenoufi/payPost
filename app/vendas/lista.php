<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");


?>
<style>
    .barra_topo{
        position:absolute;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-direction: column;
        top:0;
        width:100%;
        height:100px;
        /* background-color:#ffc63a;
        color:#670600;
        border-bottom-right-radius:40px;
        border-bottom-left-radius:40px;
        font-family:FlameBold; */
    }


    .home_corpo{
        position: absolute;
        top:100px;
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
<div class="barra_topo">
    <h2>Venda</h2>
</div>

<div class="home_corpo">
    <div class="row g-0 p-2">
        <div class="card p-2">
            <h4 class="w-100 text-center">Vendas Realizadas</h4>
            
            Lista de todas as vendas
        </div>
    </div>
</div>

<div class="home_rodape"></div>

<script>
    $(function(){


        idUnico = localStorage.getItem("idUnico");
        codUsr = localStorage.getItem("codUsr");

        $.ajax({
            url:"rodape/rodape.php",
            success:function(dados){
                $(".home_rodape").html(dados);
            }
        });

        $.ajax({
            url:"topo/topo.php",
            type:"POST",
            data:{
                idUnico,
                codUsr
            },  
            success:function(dados){
                $(".barra_topo").append(dados);
            }
        });



    })
</script>