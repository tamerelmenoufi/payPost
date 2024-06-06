<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['delete']){
        // $query = "delete from usuarios where codigo = '{$_POST['delete']}'";
        $query = "update vendas set deletado = '1' where codigo = '{$_POST['delete']}'";
        sisLog($query);
    }

?>

<div class="table-responsive d-none d-md-block">
    <table class="table table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">Venda</th>
        <th scope="col">Data</th>
        <th scope="col">Frentista</th>
        <th scope="col">Combustível</th>
        <!-- <th scope="col">Litros</th> -->
        <th scope="col">Valor</th>
        <th scope="col">Cliente</th>
        <th scope="col">Receber Pagamento</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "select a.*, b.nome as usuario_nome, c.combustivel from vendas a left join usuarios b on a.usuario = b.codigo left join combustiveis c on a.combustivel = c.codigo where a.deletado != '1' and pago != '1' {$where} order by a.data desc";
        $result = sisLog($query);
        
        while($d = mysqli_fetch_object($result)){
        ?>
        <tr>
        <td><?=str_pad($d->codigo, 6, "0", STR_PAD_LEFT)?></td>
        <td><?=dataBr($d->data)?></td>
        <td><?=$d->usuario_nome?></td>
        <td><?=$d->combustivel?></td>
        <!-- <td><?=number_format($d->quantidade,3,',',false)?></td> -->
        <td><?=number_format($d->valor,2,',',false)?></td>
        <td><?=(($d->cliente)?:'Não Informado')?></td>
        <td>

        <!-- <div class="form-check form-switch">
            <input class="form-check-input pago" type="checkbox" <?=(($d->pago)?'checked':false)?> pago="<?=$d->codigo?>">
        </div> -->
        <button class="btn btn-success pago" pago="<?=$d->codigo?>">
            Validar
        </button>

        </td>
        <td>
            <!-- <button
            class="btn btn-primary"
            edit="<?=$d->codigo?>"
            data-bs-toggle="offcanvas"
            href="#offcanvasDireita"
            role="button"
            aria-controls="offcanvasDireita"
            >
            Editar
            </button> -->
            <button class="btn btn-danger" delete="<?=$d->codigo?>">
            Excluir
            </button>
        </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
</div>


<div class="d-block d-md-none d-lg-none d-xl-none d-xxl-none">
<?php
        $query = "select a.*, b.nome as usuario_nome, c.combustivel from vendas a left join usuarios b on a.usuario = b.codigo left join combustiveis c on a.combustivel = c.codigo where a.deletado != '1' and pago != '1' {$where} order by a.data desc";
        $result = sisLog($query);
        
        while($d = mysqli_fetch_object($result)){
    ?>
    <div class="card mb-3 p-3">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
            <!-- <div class="form-check form-switch">
                <input class="form-check-input pago" type="checkbox" <?=(($d->pago)?'checked':false)?> pago="<?=$d->codigo?>">
                Pago
            </div> -->
            <button class="btn btn-success pago" pago="<?=$d->codigo?>">
                Validar
            </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <label class="label">Venda</label>
            <div><?=str_pad($d->codigo, 6, "0", STR_PAD_LEFT)?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <label class="label">Data</label>
            <div><?=dataBr($d->data)?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <label class="label">Frentista</label>
            <div><?=$d->usuario_nome?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <label class="label">Bomba</label>
            <div><?=$d->bomba?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <label class="label">Combustível</label>
            <div><?=$d->combustivel?></div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-12">
            <label class="label">Litros</label>
            <div><?=number_format($d->quantidade,3,',',false)?></div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-12">
            <label class="label">Valor</label>
            <div><?=number_format($d->valor,2,',',false)?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
            <label class="label">Cliente</label>
            <div><?=(($d->usuario_nome)?:'Não Informado')?></div>
            </div>
        </div>

        <div class="row">
            <!-- <div class="col-6 p-2">
            <button
                class="btn btn-primary w-100"
                edit="<?=$d->codigo?>"
                data-bs-toggle="offcanvas"
                href="#offcanvasDireita"
                role="button"
                aria-controls="offcanvasDireita"
            >
                Editar
            </button>
            </div> -->
            <div class="col-12 p-2">
            <button class="btn btn-danger w-100" delete="<?=$d->codigo?>">
                Excluir
            </button>
            </div>
        </div>
        </div>
    <?php
        }
    ?>
</div>


<script>
    $(function(){
        atualizacao = setTimeout(() => {
            $.ajax({
                url:"src/vendas/vendas.php",
                type:"POST",
                success:function(dados){
                    $(".lista_vendas").html(dados);
                    console.log('verificado')
                }
            })  
        }, 10000);
    })
</script>