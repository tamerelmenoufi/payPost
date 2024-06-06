<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
  
      if($_POST['pago']){
        $query = "update vendas set pago = '{$_POST['opc']}' where codigo = '{$_POST['pago']}'";
        sisLog($query);
        exit();
      }
  
?>

<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Histórico de Vendas</h5>
          <div class="card-body">
            <div class="d-none d-md-block">
              <div class="d-flex justify-content-between mb-3">

                  <div class="input-group">
                    <label class="input-group-text" for="inputGroupFile01">Buscar por </label>
                    <input campoBusca type="text" class="form-control" value="<?=$_SESSION['usuarioBusca']?>" aria-label="Digite a informação para a busca">
                    <button filtro="filtrar" class="btn btn-outline-secondary" type="button">Buscar</button>
                    <button filtro="limpar" class="btn btn-outline-danger" type="button">limpar</button>
                  </div>
              </div>
            </div>

            <div class="d-block d-md-none d-lg-none d-xl-none d-xxl-none">
              <div class="d-flex justify-content-between mb-3">

                  <div class="row">
                    <div class="col-12 mb-2">
                      <div class="input-group">
                        <label class="input-group-text" for="inputGroupFile01">Buscar por </label>
                        <input campoBusca type="text" class="form-control" value="<?=$_SESSION['usuarioBusca']?>" aria-label="Digite a informação para a busca">
                      </div>
                    </div>
                    <div class="col-12 mb-2">
                      <button filtro="filtrar" class="btn btn-outline-secondary w-100" type="button">Buscar</button>
                    </div>
                    <div class="col-12 mb-2">
                      <button filtro="limpar" class="btn btn-outline-danger w-100" type="button">limpar</button>
                    </div>
                  </div>
              </div>
            </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "select a.*, b.nome as usuario_nome, c.combustivel from vendas a left join usuarios b on a.usuario = b.codigo left join combustiveis c on a.combustivel = c.codigo where a.deletado != '1' and pago = '1' {$where} order by a.data desc";
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
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    </table>
                </div>


                <div class="d-block d-md-none d-lg-none d-xl-none d-xxl-none">
                <?php
                        $query = "select a.*, b.nome as usuario_nome, c.combustivel from vendas a left join usuarios b on a.usuario = b.codigo left join combustiveis c on a.combustivel = c.codigo where a.deletado != '1' and pago = '1' {$where} order by a.data desc";
                        $result = sisLog($query);
                        
                        while($d = mysqli_fetch_object($result)){
                    ?>
                    <div class="card mb-3 p-3">

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

                        
                        </div>
                    <?php
                        }
                    ?>
                </div>

            


          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<script>
    $(function(){
        Carregando('none');
    })
</script>