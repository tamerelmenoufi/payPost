<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
?>

<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Vendas</h5>
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
                    <div class="col-12 mb-2">
                      <button
                          novoCadastro
                          class="btn btn-success btn-sm w-100"
                          data-bs-toggle="offcanvas"
                          href="#offcanvasDireita"
                          role="button"
                          aria-controls="offcanvasDireita"
                      >Novo</button>                      
                    </div>
                  </div>
              </div>
            </div>

            <div class="table-responsive d-none d-md-block">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Frentista</th>
                    <th scope="col">Combustível</th>
                    <th scope="col">Litros</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Pago</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "select a.*, b.nome as usuario_nome, c.combustivel from vendas a left join usuarios b on a.usuario = b.codigo left join combustiveis c on a.combustivel = c.codigo where a.deletado != '1' {$where} order by a.data desc";
                    $result = sisLog($query);
                    
                    while($d = mysqli_fetch_object($result)){
                  ?>
                  <tr>
                    <td><?=dataBr($d->data)?></td>
                    <td><?=$d->usuario_nome?></td>
                    <td><?=$d->combustivel?></td>
                    <td><?=$d->quantidade?></td>
                    <td><?=$d->valor?></td>
                    <td><?=(($d->cliente)?:'Não Informado')?></td>
                    <td>

                    <div class="form-check form-switch">
                      <input class="form-check-input pago" type="checkbox" <?=(($d->pago)?'checked':false)?> usuario="<?=$d->codigo?>">
                    </div>

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
                  $query = "select a.*, b.nome as usuario_nome, c.combustivel from vendas a left join usuarios b on a.usuario = b.codigo left join combustiveis c on a.combustivel = c.codigo where a.deletado != '1' {$where} order by a.data desc";
                  $result = sisLog($query);
                  
                  while($d = mysqli_fetch_object($result)){
                ?>
                <div class="card mb-3 p-3">
                    <div class="row">
                      <div class="col-12 d-flex justify-content-end">
                        <div class="form-check form-switch">
                          <input class="form-check-input pago" type="checkbox" <?=(($d->pago)?'checked':false)?> pago="<?=$d->codigo?>">
                          Pago
                        </div>
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

                    <div class="row">
                      <div class="col-12">
                      <label class="label">Litros</label>
                       <div><?=$d->quantidade?></div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                      <label class="label">Valor</label>
                       <div><?=$d->valor?></div>
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