<?php
    $resposta = false;
    include "config.php";
    include "funcoes.php";
    include "class.Clientes.php";
    $cliente = new Cliente();

    $codigo = @$_GET['codigo'];
    if( $codigo != "" )
    {
        if( ! $cliente->Consultar($codigo) ) {
            echo "Aviso, o código $codigo não foi encontrado !";
        }
    }

    $botao = @$_POST['botao'];
    if($botao != '') 
    {
        if( $cliente->Excluir($codigo) ) {
            echo "Sucesso na exclusão";
            ?>
                   <meta http-equiv="refresh" content="2; URL='listarClientes.php'"/> 
                    <?php
        }
        else
            echo "Erro na exclusao !";
    }


?>

<form action="./excluirCliente.php?codigo=<?php echo $codigo; ?>" method="post" enctype="multipart/form-data" name="form1">
    <table width="590" border="0" align="center" cellpadding="7" cellspacing="0" bgcolor="#F3F3F3" style="border:1px solid #221d77;">


        <tr height="22">
            <td><label for="user">Nome*:</label></td>
            <td colspan="3">
               <?php echo $cliente->getNome(); ?>
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr height="22">
            <td><label for="user">Nascimento:</label></td>
            <td colspan="3">
                <?php echo date( "d/m/Y", $cliente->getDataNascimento() ); ?>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>

            <td><label for="cpf">CPF*: </label></td>
            <td colspan="3">
                <?php echo $cliente->getCpf(); ?>
            </td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <td><label for="ready">Estado*:</label></td>
            <td colspan="3">
                <?php echo $cliente->GetEstado()  ?>
            </td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td><label for="ready">Cidade*:</label></td>
            <td colspan="3">
                <?php echo $cliente->getCidade(); ?>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td colspan="2">
                <input type="submit" value="Excluir" name="botao" /></td>
            <td>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>

</form>
