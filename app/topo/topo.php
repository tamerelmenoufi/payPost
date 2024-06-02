<?php
include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

if($_POST['idUnico']){
    $_SESSION['idUnico'] = $_POST['idUnico'];
}

if($_POST['codUsr']){
    $_SESSION['codUsr'] = $_POST['codUsr'];
}

$query = "select * from clientes where codigo = '{$_SESSION['codUsr']}'";
$result = mysqli_query($con, $query);
$c = mysqli_fetch_object($result);

?>

<style>
    .topo{
        position:absolute;
        top:0;
        width:100%;
        background:transparent;
        height:100px;
        z-index:2;
    }
    .topo > .voltar{
        position:absolute;
        bottom:10px;
        left:15px;
        font-size:30px;
        color:#670600;
        cursor:pointer;
    }
    .topo > .dados{
        position:absolute;
        top:5px;
        left:10px;
        right:10px;
        font-size:14px;
        font-family:verdana;
        color:#670600;
        cursor:pointer;
        text-align:center;
    }

    .bg_topo{
            position:absolute;
            left:0;
            right:0;
            top:0;
            height:90px;
            background-position: center top;
            background-size:cover;
            background-image:url("img/bg_topo.png");
            z-index:-1;
        }
    .barra_topo h2{
        z-index:2;
    }
</style>
<div class="topo">
    <div class="bg_topo"></div>
    <p class="dados">
        <?php
        if($c->nome){
            echo $c->nome;
        }
        ?>
    </p>
    <i class="voltar fa-solid fa-arrow-left"></i>
</div>
<script>
    $(function(){

        $(".voltar").click(function(){
            Carregando();
            $.ajax({
                url:"lib/voltar.php",
                dataType:"JSON",
                success:function(dados){
                    var data = $.parseJSON(dados.dt);
                    $.ajax({
                        url:dados.pg,
                        type:"POST",
                        data,
                        success:function(retorno){
                            $(`${dados.tg}`).html(retorno);
                            Carregando('none');
                        }
                    })
                }
              })
        })
        
    })
</script>