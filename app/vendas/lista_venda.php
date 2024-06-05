<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
?>  
<div class="row g-0 p-2">
    <div class="card p-2">
        <h4 class="w-100 text-center">Vendas Realizadas</h4>
        <ul class="list-group">
        <?php
        $query = "select a.*, b.combustivel from vendas a left join combustiveis b on a.combustivel = b.codigo where a.usuario = '{$_SESSION['codUsr']}' order by a.data desc limit 50";
        $result = mysqli_query($con, $query);
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

<script>

        $(function(){

            setTimeout(() => {
                idUnico = localStorage.getItem("idUnico");
                codUsr = localStorage.getItem("codUsr");
                $.ajax({
                    url:"vendas/lista.php",
                    type:"POST",
                    data:{
                        idUnico,
                        codUsr
                    },
                    success:function(dados){
                        $(".home_corpo").html(dados);
                    }
                })
            }, 10000);

        })

</script>