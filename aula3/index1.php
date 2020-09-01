<?php


    include "class.Clientes.php";

    // instanciando a classe
    $cli = new Cliente();

    // passando valores por métodos set´s
    $cli->setCodigo(1000);
    $cli->setNome("MARCIO NIZZOLA");
    $cli->setCpf("111.222.444-33");

    if( $cli->ValidarDados() )
        echo "DADOS VALIDOS";
    else
        echo "ERRO NO PREENCHIMENTO, FALTAM CAMPOS OBRIGATÓRIOS!";

?>



