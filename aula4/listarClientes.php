<!doctype html>
<html>
  <head>
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/03a46de5f2.js" crossorigin="anonymous"></script>
  </head>

  <body>

<a href="formClientes.php"><i class="far fa-plus-square"></i></a>

<table border="1">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>


<?php
    include "config.php";
    include "funcoes.php";
    include "class.Clientes.php";

    $cliente = new Cliente();

    $lista = $cliente->Listar();

    foreach($lista as $obj ) {

        echo "<tr><td>".$obj->getCodigo()."</td><td>". $obj->getNome()."</td><td>".$obj->getCidade()."</td><td>".$obj->getEstado()."</td>
        <td><a href='editarClientes.php?codigo=".$obj->getCodigo()."' alt='Editar'><i class='far fa-edit'></i>
        </a><a href='excluirCliente.php?codigo=".$obj->getCodigo()."' alt='Deletar'><i class='far fa-trash-alt'></i></a> </tr>";

        


    }
?>

</table>

</body>
</html>