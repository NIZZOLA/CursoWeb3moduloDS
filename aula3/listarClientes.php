<?php
    include "config.php";
    include "funcoes.php";
    include "class.Clientes.php";

    $cliente = new Cliente();


    $lista = $cliente->Listar();

    foreach($lista as $obj ) {

        echo "<br>". $obj->getNome();

    }


    ?>
