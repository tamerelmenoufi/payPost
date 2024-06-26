<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
  
      if($_POST['pago']){
        $query = "update vendas set pago = '{$_POST['opc']}' where codigo = '{$_POST['pago']}'";
        sisLog($query);
        // exit();
      }
  

?>



<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Vendas</h5>
          <div class="card-body">

            <!-- <div class="d-none d-md-block">
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
            </div> -->

            <div class="lista_vendas"></div>


          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="popupConfirm" style="position:fixed; right:50px; top:90px; width:300px; height:90px; z-index:99; display:none;">
  <div class="alert alert-success" role="alert">
    Validação realizada com sucesso!
  </div>
</div>


<script>
    $(function(){
        Carregando('none');

        $.ajax({
            url:"src/vendas/vendas.php",
            type:"POST",
            success:function(dados){
                $(".lista_vendas").html(dados);
            }
        })       


        $(document).off("click").on("click", "button[delete]", function(){
            deletar = $(this).attr("delete");
            $.confirm({
                content:"Deseja realmente excluir a venda ?",
                title:false,
                buttons:{
                    'SIM':function(){
                        $.ajax({
                            url:"src/vendas/vendas.php",
                            type:"POST",
                            data:{
                                delete:deletar
                            },
                            success:function(dados){
                                // $(".lista_vendas").html(dados);
                            }
                        })
                    },
                    'NÃO':function(){

                    }
                }
            });
        })


        $(document).off("click").on("click",".pago",function(){

            pago = $(this).attr("pago");
            opc = '1';

            // if($(this).prop("checked") == true){
            // opc = '1';
            // }else{
            // opc = '0';
            // }


            $(".popupConfirm").css("display","flex");
            

            $.ajax({
                url:"src/vendas/index.php",
                type:"POST",
                data:{
                    pago,
                    opc
                },
                success:function(dados){
                    // $("#paginaHome").html(dados);
                    $.ajax({
                        url:"src/vendas/vendas.php",
                        type:"POST",
                        success:function(dados){
                            $(".popupConfirm").css("display","none");
                            $(".lista_vendas").html(dados);
                        }
                    })  
                }
            })

        });

    })
</script>