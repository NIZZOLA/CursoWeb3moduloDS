<?php

  include "class.Produto.php";

  $prod = new Produto();

  if( @$_POST['botao'] != "" )
     {
         echo "formulario postado !";
         
         //$prod->setCodigo( $_POST['codigo'] );
         $prod->setDescricao( $_POST['descricao'] );
         $prod->setUnidadeDeMedida( $_POST['unidade']);
         $prod->setValorDeCusto( $_POST['custo']);
         $prod->setMargemDeLucro( $_POST['margem']);

         if( $prod->ValidarDados() ) {
             
            echo "Pronto para incluir de fato";
         
        } else
         {
             echo "Erro na validação";
         }

         //echo "DADOS POSTADOS: Codigo= ".$prod->getCodigo()." Descricao=". $prod->getDescricao()." Valor de venda:".$prod->getValorDeVenda();

     }
  


?>
<style>
.vermelho {
    color:red;
}
</style>
<h1>Formulário de inclusão</h1>
<form method="post">
    <table>

        <!--
        <tr>
            <td>Codigo</td>
            <td>
                <input type="text" name="codigo" value="<?php echo $prod->getCodigo(); ?>">
            </td>
        </tr>
        -->
    
        <tr>
            <td>Descrição</td>
            <td>
                <input type="text" name="descricao" value="<?php echo $prod->getDescricao(); ?>">
                <span class="vermelho"><?php echo $prod->GetValidationError("DESCRICAO"); ?></span>
            </td>
        </tr>
    
        <tr>
            <td>Unidade De Medida</td>
            <td>
                <select name="unidade">
                    <option value="">Selecione</option>
                    <option value="PC" <?php if( $prod->getUnidadeDeMedida() == "PC") echo "selected"; ?> >Peça</option>
                    <option value="KG" <?php if( $prod->getUnidadeDeMedida() == "KG") echo "selected"; ?>>Quilos</option>
                    <option value="DZ" <?php if( $prod->getUnidadeDeMedida() == "DZ") echo "selected"; ?>>Dúzia</option>
                    <option value="M" <?php if( $prod->getUnidadeDeMedida() == "M") echo "selected"; ?>>Metro linear</option>
                    <option value="M2" <?php if( $prod->getUnidadeDeMedida() == "M2") echo "selected"; ?>>Metro Quadrado</option>
                    <option value="SC" <?php if( $prod->getUnidadeDeMedida() == "SC") echo "selected"; ?>>Saco</option>
                </select>
            </td>
        </tr>
    
        <tr>
            <td>Valor de Custo</td>
            <td>
                <input type="text" name="custo" value="<?php echo $prod->getValorDeCusto(); ?>">
            </td>
        </tr>
        
        <tr>
            <td>margem de lucro</td>
            <td>
                <input type="text" name="margem"  value="<?php echo $prod->getMargemDeLucro(); ?>">
            </td>
        </tr>
    
        <tr>
            <td colspan="2">
                <input type="submit" value="Enviar" name="botao">
            </td>
        </tr>
    
    </table>




</form>