<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['acao'] == 'venda'){


        $query = "insert into vendas set 
                                        usuario = '{$_SESSION['codUsr']}',
                                        combustivel = '{$_POST['combustivel']}',
                                        quantidade = '".str_replace(",", ".", $_POST['quantidade'])."',
                                        valor  = '".str_replace(",", ".", $_POST['valor'])."',
                                        cliente = '{$_POST['cliente']}',
                                        data = NOW(),
                                        pago = '0'
        
        ";

        mysqli_query($con, $query);

    }

    $query = "select a.*, b.combustivel from vendas a left join combustiveis b on a.combustivel = b.codigo where a.usuario = '{$_SESSION['codUsr']}' order by a.data desc limit 50";
    $result = mysqli_query($con, $query);



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
            <ul class="list-group">
            <?php
            while($d = mysqli_fetch_object($result)){
            ?>
                <li class="list-group-item list-group-item-<?=(($d->pago)?'success':'danger')?>">
                    <div class="d-flex justify-content-between align-items-center" style="font-weight:bold">
                        <span><i class="fa-solid fa-gas-pump"></i> <?=$d->combustivel?></span>
                        <span>R$ <?=number_format($d->valor,2,",",false)?></span>
                    </div>
                    <i class="fa-solid fa-user"></i> <?=(($d->cliente)?:'Não Identificado')?>
                    <div class="d-flex justify-content-end align-items-center">
                        <span style="font-size:10px;"><?=dataBr($d->data)?></span>
                    </div>                    
                </li>
            <?php
            }
            ?>
            </ul>
        </div>
    </div>
</div>

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



    })
</script>