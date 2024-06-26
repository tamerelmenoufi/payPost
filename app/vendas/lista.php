<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['acao'] == 'venda'){


        $query = "insert into vendas set 
                                        usuario = '{$_SESSION['codUsr']}',
                                        bomba = '{$_POST['bomba']}',
                                        combustivel = '{$_POST['combustivel']}',
                                        quantidade = '".str_replace(",", ".", $_POST['quantidade'])."',
                                        valor  = '".str_replace(",", ".", $_POST['valor'])."',
                                        cliente = '{$_POST['cliente']}',
                                        data = NOW(),
                                        pago = '0'
        
        ";

        mysqli_query($con, $query);

    }


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


    .home_corpo_venda{
        position: absolute;
        top:100px;
        bottom:180px;
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

<div class="home_corpo_venda"></div>

<div class="home_rodape"></div>

<script>
    $(function(){

        Carregando('none');


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

        $.ajax({
            url:"vendas/lista_venda.php",
            success:function(dados){
                $(".home_corpo_venda").html(dados);
            }
        })        

    })
</script>