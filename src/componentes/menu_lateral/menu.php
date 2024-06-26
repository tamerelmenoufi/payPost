<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
?>
<style>
  a[url]{
    cursor:pointer;
  }
</style>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <img src="img/logo.png" style="height:60px;" alt="">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <h5>PayPost - Painel</h5>
  
    <div class="row mb-1">
      <div class="col">
        <a url="src/dashboard/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-chart-line col-1"></i> <span class="col-11">Dashboard</span>
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a url="src/usuarios/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-regular fa-user col-1"></i> <span class="col-11">Usuários/Frentista</span>
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a url="src/vendas/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-gas-pump"></i> <span class="col-11">Vendas pendentes</span>
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a url="src/vendas/geral.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-gas-pump"></i> <span class="col-11">Histórico Vendas</span>
        </a>
      </div>
    </div>

  

  </div>
</div>

<script>
  $(function(){
    $("a[url]").click(function(){
      Carregando();
      url = $(this).attr("url");
      $.ajax({
        url,
        success:function(dados){
          $("#paginaHome").html(dados);
        }
      });
    });
  })
</script>