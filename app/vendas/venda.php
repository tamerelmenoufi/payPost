<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");


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
    <h2>Venda</h2>
</div>

<div class="home_corpo">
    <div class="row g-0 p-2">
        <div class="card p-2">
            <h4 class="w-100 text-center">Registro da Venda</h4>
            <div class="mb-1">
                <label for="nome" class="form-label">Combustível</label>
                <select name="combustivel" id="combustivel" class="form-select">
                    <?php
                    $q = "select * from combustiveis where situacao = '1' order by ordem asc";
                    $r = mysqli_query($con, $q);
                    while($s = mysqli_fetch_object($r)){
                    ?>
                    <option value="<?=$s->codigo?>"><?=$s->combustivel?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-1">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="text" inputmode="numeric" class="form-control formDados" autocomplete="off" id="quantidade">
            </div>
            <div class="mb-1">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" inputmode="numeric" class="form-control formDados" autocomplete="off" id="valor">
            </div>
            <div class="mb-2">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" class="form-control formDados" autocomplete="off" id="cliente">
            </div>
            <button type="button" class="btn btn-warning w-100 registrar">Registrar</button>  
        </div>
    </div>
</div>

<div class="home_rodape"></div>

<script>
    $(function(){


        idUnico = localStorage.getItem("idUnico");
        codUsr = localStorage.getItem("codUsr");

        $("#quantidade").maskMoney({
                                    prefix:'',
                                    allowNegative: false,
                                    thousands:'', 
                                    decimal:',', 
                                    affixesStay: '',
                                    precision:3
                                });

        $("#valor").maskMoney({
                                    prefix:'',
                                    allowNegative: false,
                                    thousands:'', 
                                    decimal:',', 
                                    affixesStay: ''
                                });

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


        $(".registrar").click(function(){

            combustivel = $("#combustivel").val();
            quantidade = $("#quantidade").val();
            valor = $("#valor").val();
            cliente = $("#cliente").val();



            if(!combustivel || !quantidade || !valor){
                $.alert({
                    title:"Erro",
                    content:"Preencha os campos obrigatórios!",
                    type:"red"
                });
                return false;
            }

            $.confirm({
                title:"Confirmação da Venda",
                content:`Sua venda está definida com os seguintes dados:
                        <br>Combustível: <b>${combustivel}</b>
                        <br>Litros: <b>${quantidade}</b>
                        <br>Valor: <b>${valor}</b>
                        <br>Cliente: <b>${cliente}</b>`,
                type:"blue",
                buttons:{
                    'Sim':function(){

                    },
                    'Não':function(){

                    }
                }
            })

        })



    })



</script>