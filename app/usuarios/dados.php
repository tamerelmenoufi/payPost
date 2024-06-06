<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['idUnico']){
        $_SESSION['idUnico'] = $_POST['idUnico'];
    }

    if($_POST['codUsr']){
        $_SESSION['codUsr'] = $_POST['codUsr'];
        $where = " where codigo = '{$_SESSION['codUsr']}'";
    }

    if($_POST['acao'] == 'atualizar'){
        mysqli_query($con, "update usuarios set {$_POST['campo']} = '".addslashes($_POST['valor'])."' where codigo = '{$_POST['codigo']}'");
        $retorno = [
            'status' => 'success',
            'idUnico' => $_SESSION['idUnico'],
            'codUsr' => $_SESSION['codUsr'],
        ];
        echo json_encode($retorno);
        exit();
    }

    if($_POST['telefone']){
        $telefone = str_replace(['-',' ','(',')'],false,trim($_POST['telefone']));
        if(strlen($telefone) != 11){
            $_SESSION['codUsr'] = false;
            echo 'erro';
            exit();
        }else{
            $q = "SELECT * from usuarios WHERE telefone = '{$_POST['telefone']}'";
            $c = mysqli_fetch_object(mysqli_query($con, $q));
            if($c->codigo){
                $_SESSION['codUsr'] = $c->codigo;
            }else{
                mysqli_query($con, "INSERT INTO usuarios set telefone = '{$_POST['telefone']}'");
                $_SESSION['codUsr'] = mysqli_insert_id($con);
            }
        }
    }

    $query = "select * from usuarios where codigo = '{$_SESSION['codUsr']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

    $_SESSION['codUsr'] = $d->codigo;
    ////////////////
    //98542-2529

?>
<style>
    .barra_topo{
        position:absolute;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-direction: column;
        top:0;
        width:100%;
        height:100px;
        /* background-color:#ffc63a;
        color:#670600;
        border-bottom-right-radius:40px;
        border-bottom-left-radius:40px;
        font-family:FlameBold; */
    }


    .home_corpo{
        position: absolute;
        top:100px;
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
<div class="barra_topo">
    <h2>Perfil</h2>
</div>

<div class="home_corpo">
    <div class="row g-0 p-2">
        <div class="card p-2">
            <h4 class="w-100 text-center">DADOS PESSOAIS</h4>
            <div class="mb-1">
                <label for="nome" class="form-label">Nome Completo</label>
                <div class="form-control is-valid" ><?=$d->nome?></div>
                <!-- <input type="text" class="form-control formDados" autocomplete="off" value="<?=$d->nome?>" id="nome"> -->
            </div>
            <div class="mb-1">
                <label for="cpf" class="form-label">CPF</label>
                <div class="form-control is-valid" ><?=$d->cpf?></div>
                <!-- <input type="text" class="form-control formDados" autocomplete="off" value="<?=$d->cpf?>" id="cpf"> -->
            </div>
            <div class="mb-1">
                <label class="form-label">Telefone</label>
                <div class="form-control is-valid" ><?=$d->telefone?></div>
            </div>
            <div>
                <label for="email" class="form-label">E-mail</label>
                <div class="form-control is-valid" ><?=$d->email?></div>
                <!-- <input type="email" class="form-control formDados" autocomplete="off" value="<?=$d->email?>" id="email"> -->
            </div>        
        </div>
    </div>
</div>

<div class="home_rodape"></div>

<script>
    $(function(){

        $(".desconectar").css("display","block");

        $("#cpf").mask("999.999.999-99");

        localStorage.setItem("codUsr", '<?=$_SESSION['codUsr']?>');


        idUnico = localStorage.getItem("idUnico");
        codUsr = localStorage.getItem("codUsr");

        $.ajax({
            url:"rodape/rodape.php",
            success:function(dados){
                $(".home_rodape").html(dados);
            }
        });

        $.ajax({
            url:"topo/topo.php",
            type:"POST",
            data:{
                idUnico,
                codUsr
            },  
            success:function(dados){
                $(".barra_topo").append(dados);
            }
        });


        ExecutaAtualizacao = (campo, valor)=>{
            idUnico = localStorage.getItem("idUnico");
            codUsr = localStorage.getItem("codUsr");
            $.ajax({
                url:"usuarios/dados.php",
                type:"POST",
                dataType:"JSON",
                data:{
                    idUnico,
                    codUsr,
                    campo,
                    valor,
                    codigo:'<?=$d->codigo?>',
                    acao:'atualizar'
                },
                success:function(dados){
                    console.log(dados)
                }
            })            
        }

        $(".formDados").keydown(function(){
            $(this).addClass("is-invalid")
            $(this).removeClass("is-valid")
        })

        $(".formDados").blur(function(){
            campo = $(this).attr("id");
            valor = $(this).val();
            console.log(campo)
            console.log(valor)
            if(campo == 'nome'){
                ExecutaAtualizacao(campo, valor);
                $(this).removeClass("is-invalid")
                $(this).addClass("is-valid")
            }else if(campo == 'cpf'){
                if(valor.length == 14){
                    ExecutaAtualizacao(campo, valor);
                    $(this).removeClass("is-invalid")
                    $(this).addClass("is-valid")
                }
            }else if(campo == 'email'){
                ExecutaAtualizacao(campo, valor);
                $(this).removeClass("is-invalid")
                $(this).addClass("is-valid")
            }
        })


    })
</script>