<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");


     $q = "select 
                 (select count(*) from usuarios where deletado != '1') as frentistas,   
                 (select count(*) from vendas where deletado != '1' {$where} ) as vendas,   
                 (select sum(valor) from vendas where deletado != '1' {$where} ) as total
         ";
     $r = mysqli_query($con, $q);
     $v = mysqli_fetch_object($r);
    
?>
<style>
    td, th{
    font-size:12px;
    white-space: nowrap;
  }
</style>
</style>
<div class="m-3">

    <div class="row g-0 mb-3 mt-3">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="input-group">
                <label class="input-group-text">Filtro por Período </label>
                <label class="input-group-text" for="data_inicial"> De </label>
                <input type="date" id="data_inicial" class="form-control" <?=$busca_disabled?> value="<?=$_SESSION['dashboardDataInicial']?>" >
                <label class="input-group-text" for="data_final"> A </label>
                <input type="date" id="data_final" class="form-control" value="<?=$_SESSION['dashboardDataFinal']?>" >
                <button filtro="filtrar" class="btn btn-outline-secondary" type="button">Buscar</button>
                <button filtro="limpar" class="btn btn-outline-danger" type="button">limpar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-0">
        <div class="col-md-12 p-2">
            <h6>Resumo <?=(($_SESSION['dashboardDataInicial'] and $_SESSION['dashboardDataFinal'])? "de ".dataBr($_SESSION['dashboardDataInicial'])." a ".dataBr($_SESSION['dashboardDataFinal']):'Geral')?></h6>
        </div>
        <div class="col-md-4 p-2">
            <div class="alert alert-secondary" role="alert">
                <span>Quantidade de Frentistas</span>
                <h1><?=$v->frentistas?></h1>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="alert alert-primary" role="alert">
                <span>Total de Vendas</span>
                <h1><?=$v->vendas?></h1>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="alert alert-success" role="alert">
                <span>Total Arrecadado</span>
                <h1>R$ <?=number_format($v->total,2,',','.')?></h1>
            </div>
        </div>
    </div>

    <div class="row g-0">
        <div class="col-md-12 p-2">
            <h6>Vendas por Combustível</h6>
        </div>
        <div class="col-md-12 p-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Combustível</th>
                            <th class="text-center">Quantidade</th>
                            <th class="w-100">Comparativo Gráfico</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $q = "select count(*) as quantidade, (select count(*) from vendas where deletado != '1') as total, b.combustivel, c.nome from vendas a left join combustiveis b on a.combustivel = b.codigo left join usuarios c on a.usuario = c.codigo where a.deletado != '1' group by a.combustivel order by quantidade desc";
                    $r = mysqli_query($con, $q);
                    while($s = mysqli_fetch_object($r)){

                        $pct = number_format(($s->quantidade * 100)/$s->total,0,false,false);

                    ?>
                    <tr>
                        <td><?=$s->combustivel?></td>
                        <td class="text-center"><?=$s->quantidade?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: <?=$pct?>%;" aria-valuenow="<?=$pct?>" aria-valuemin="0" aria-valuemax="100"><?=$pct?>%</div>
                            </div>
                        </td>
                    </tr>                
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="row g-0">
        <div class="col-md-12 p-2">
            <h6>Vendas por Frentista</h6>
        </div>
        <div class="col-md-12 p-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="text-center">Quantidade</th>
                            <th class="w-100">Comparativo Gráfico</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $q = "select count(*) as quantidade, (select count(*) from vendas where deletado != '1') as total, b.combustivel, c.nome from vendas a left join combustiveis b on a.combustivel = b.codigo left join usuarios c on a.usuario = c.codigo where a.deletado != '1' group by a.usuario order by quantidade desc";
                    $r = mysqli_query($con, $q);
                    while($s = mysqli_fetch_object($r)){

                        $pct = number_format(($s->quantidade * 100)/$s->total,0,false,false);

                    ?>
                    <tr>
                        <td><?=$s->nome?></td>
                        <td class="text-center"><?=$s->quantidade?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: <?=$pct?>%;" aria-valuenow="<?=$pct?>" aria-valuemin="0" aria-valuemax="100"><?=$pct?>%</div>
                            </div>
                        </td>
                    </tr>                
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>


<script>
    $(function(){
        Carregando('none')

        $("button[filtro]").click(function(){
          filtro = $(this).attr("filtro");
          dashboardDataInicial = $("#data_inicial").val();
          dashboardDataFinal = $("#data_final").val();
          Carregando()
          $.ajax({
              url:"src/dashboard/index.php",
              type:"POST",
              data:{
                  filtro,
                  dashboardDataInicial,
                  dashboardDataFinal
              },
              success:function(dados){
                  $("#paginaHome").html(dados);
              }
          })
        })
        
    })
</script>