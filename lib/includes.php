<?php
    session_start();
    include("/inc/connect.php");
    include("fn.php");
    $con = AppConnect('app');
    $conApi = AppConnect('information_schema');
    $md5 = md5(date("YmdHis"));
    // $_SESSION = [];

    $urlPainel = 'https://paypostpainel.mohatron.com/';
    $urlApp = 'https://paypost.mohatron.com/';

    if($_POST['historico']){
        $pagina = str_replace("/app/", false, $_SERVER["PHP_SELF"]);
        $destino = $_POST['historico'];
        $i = ((count($_SESSION['historico']))?(count($_SESSION['historico']) -1):0);
        if($_SESSION['historico'][$i]['local'] != $pagina){
            $j = (($_SESSION['historico'][$i]['local'])?($i+1):0);
            $_SESSION['historico'][$j]['local'] = $pagina;
            $_SESSION['historico'][$j]['destino'] = $_POST['historico'];
            unset($_POST['historico']);
            $_SESSION['historico'][$j]['dados'] = json_encode($_POST);
        }else{
            unset($_POST['historico']);
        }
    }