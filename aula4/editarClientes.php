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

    $enviou = @$_POST['botao'];
    

    if( $enviou != "" )  {
            echo "FORMULÁRIO POSTADO";
            $cliente->setCodigo($codigo);
            $cliente->setNome( @$_POST['nome']);
            $cliente->setCpf(@$_POST['cpf']);
            $cliente->setDataNascimento( formataDMYtoTime( @$_POST['dtnasc']) );
            $cliente->setEstado(@$_POST['cmb_estado']);
            $cliente->setCidade(@$_POST['txt_cidade']);

            if( ! $cliente->ValidarDados()) {
                echo "Dados incompletos !";
            }
            else {
                $resposta = $cliente->Alterar();
                if( $resposta ) {
                    ?>
                   <meta http-equiv="refresh" content="2; URL='listarClientes.php'"/> 
                    <?php
                }

            }

    }
    else
            echo "DADOS DO CLIENTE";

if( ! $resposta ) {
?>

<form action="./editarClientes.php?codigo=<?php echo $codigo; ?>" method="post" enctype="multipart/form-data" name="form1">
    <table width="590" border="0" align="center" cellpadding="7" cellspacing="0" bgcolor="#F3F3F3" style="border:1px solid #221d77;">


        <tr height="22">
            <td><label for="user">Nome*:</label></td>
            <td colspan="3"><input type="text" name="nome" value="<?php echo $cliente->getNome(); ?>" size="35" maxlength="50" /><br />
              <?php echo $cliente->GetValidationError("NOME"); ?></td>
            <td></td>
            <td></td>
        </tr>

        <tr height="22">
            <td><label for="user">Nascimento:</label></td>
            <td colspan="3"><input type="text" name="dtnasc" id="dtnasc" value="<?php echo date( "d/m/Y", $cliente->getDataNascimento() ); /*if ($cliente->getDtnasc() != '') echo Convertedata($cliente->getDtnasc());*/ ?>" size="12" maxlength="10" onBlur="VerificaData(this.value);" /><br /><?php //echo $cliente->getMsgerro2("DTNASC"); ?>

            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>

            <td><label for="cpf">CPF*: </label></td>
            <td colspan="3"><input type="text" name="cpf" id="cpf" value="<?php echo $cliente->getCpf(); ?>" size="20" maxlength="14" /><br /><?php echo $cliente->GetValidationError("CPF"); ?></td>
            <td></td>
            <td></td>
        </tr>


        <tr>
            <td><label for="ready">Estado*:</label></td>
            <td colspan="3">
                <select name="cmb_estado" id="cmb_estado" class="caixa">
                <option value="">Selecione</option>
                <option value="SP" <?php if( $cliente->GetEstado()=="SP") echo "selected"; ?> >São Paulo</option>
                <option value="RJ" <?php if( $cliente->GetEstado()=="RJ") echo "selected"; ?> >Rio de Janeiro</option>
                </select>
                <br /><?php //echo $cliente->getMsgerro2("ESTADO"); ?></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td><label for="ready">Cidade*:</label></td>
            <td colspan="3">
                <input name="txt_cidade" type="text" value="<?php echo $cliente->getCidade(); ?>" />
                <br />
                <?php //echo $cliente->getMsgerro2("CIDADE"); ?></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td colspan="2">
                <input type="submit" value="Enviar" name="botao" /></td>
            <td>
            </td>
            <td></td>
            <td></td>
        </tr>
    </table>

</form>
<?php
}
?>