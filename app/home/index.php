<?php
    $app = true;
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['idUnico']){
        mysqli_query($con, "insert into vendas_tmp set id_unico = '{$_POST['idUnico']}', cliente='{$_POST['codUsr']}', detalhes='{}'");
    }
?>
<style>
    .home_corpo{
        position: absolute;
        top:0;
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

<div class="home_corpo">
    <div class="m-3">
        <div class="row g-0">
            <div class="col-12">
                <div class="d-flex justify-content-center" >
                    <div class="card" style="width:70%">
                        <img src="img/logo.png" class="card-img-top" />
                        <div class="card-body">
                            
                        <form>
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" inputmode="numeric" class="form-control" id="cpf" aria-describedby="cpf-mensagem">
                                <div id="cpf-mensagem" class="form-text">Digite seu CPF para iniciar a sessão.</div>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Acessar</button>
                        </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home_rodape"></div>

<script>

$(function(){

    $.ajax({
        url:"rodape/rodape.php",
        success:function(dados){
            $(".home_rodape").html(dados);
        }
    });


})

	

</script>