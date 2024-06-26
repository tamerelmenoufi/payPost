<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['situacao']){
      $query = "update categorias set situacao = '{$_POST['opc']}' where codigo = '{$_POST['situacao']}'";
      sisLog($query);
      exit();
    }

?>
<style>
  .btn-perfil{
    padding:5px;
    border-radius:8px;
    color:#fff;
    background-color:#a1a1a1;
    cursor: pointer;
  }
  td, th{
    white-space: nowrap;
  }
  .label{
    font-size:10px;
    color:#a1a1a1;
  }
</style>
<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista das Categorias</h5>
          <div class="card-body">
            <div class="table-responsive d-none d-md-block">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "select * from categorias where deletado != '1' /*and tipo = 'prd'*/ order by tipo desc, ordem asc";
                    $result = sisLog($query);
                    
                    while($d = mysqli_fetch_object($result)){
                  ?>
                  <tr>
                    <td class="w-100"><?=$d->categoria?></td>
                    <td>

                    <div class="form-check form-switch">
                      <input class="form-check-input situacao" type="checkbox" <?=(($d->situacao)?'checked':false)?> situacao="<?=$d->codigo?>">
                    </div>

                    </td>
                    <td>
                      <button
                        class="btn btn-primary"
                        edit="<?=$d->codigo?>"
                        data-bs-toggle="offcanvas"
                        href="#offcanvasDireita"
                        role="button"
                        aria-controls="offcanvasDireita"
                      >
                        Editar
                      </button>
                      <?php
                      if($d->tipo == 'prd'){
                      ?>
                      <button
                        class="btn btn-warning"
                        produtos
                        categoria="<?=$d->codigo?>"
                      >
                        Produtos
                      </button>
                      <?php
                      }
                      ?>                      
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
              $query = "select * from categorias where deletado != '1' /*and tipo = 'prd'*/ order by tipo desc, ordem asc";
              $result = sisLog($query);
              
              while($d = mysqli_fetch_object($result)){
            ?>
            <div class="card mb-3 p-3">
              <div class="row">
                <div class="col-12 d-flex justify-content-end">
                  <div class="form-check form-switch">
                    <input class="form-check-input situacao" type="checkbox" <?=(($d->situacao)?'checked':false)?> situacao="<?=$d->codigo?>">
                    Situação
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label class="label">Categoria</label>
                  <div><?=$d->categoria?></div>
                </div>
              </div>

              <div class="row">
                <div class="col-6 p-2">
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
                </div>
                <div class="col-6 p-2">
                  <?php
                  if($d->tipo == 'prd'){
                  ?>
                  <button
                    class="btn btn-warning w-100"
                    produtos
                    categoria="<?=$d->codigo?>"
                  >
                    Produtos
                  </button>
                  <?php
                  }
                  ?>
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


<script>
    $(function(){
        Carregando('none');  
        
        $("button[produtos]").click(function(){
            categoria = $(this).attr("categoria");
            $.ajax({
                url:"src/produtos/index.php",
                type:"POST",
                data:{
                  categoria
                },
                success:function(dados){
                  $("#paginaHome").html(dados);
                }
            })
        })        

        
        $("button[edit]").click(function(){
            cod = $(this).attr("edit");
            $.ajax({
                url:"src/categorias/form.php",
                type:"POST",
                data:{
                  cod
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })


        $(".situacao").change(function(){

            situacao = $(this).attr("situacao");
            opc = false;

            if($(this).prop("checked") == true){
              opc = '1';
            }else{
              opc = '0';
            }


            $.ajax({
                url:"src/categorias/index.php",
                type:"POST",
                data:{
                    situacao,
                    opc
                },
                success:function(dados){
                    // $("#paginaHome").html(dados);
                }
            })

        });

    })
</script>