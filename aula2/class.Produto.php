<?php

class Produto {

    private $Codigo, $Descricao, $UnidadeDeMedida, $ValorDeCusto, $MargemDeLucro;

    private $validationErrors;

    public function getCodigo()             { return $this->Codigo;   }
    public function getDescricao()          { return $this->Descricao; }
	public function getUnidadeDeMedida()    { return $this->UnidadeDeMedida; }
    public function getValorDeCusto()       { return $this->ValorDeCusto; }
    public function getMargemDeLucro()      { return $this->MargemDeLucro; }

    public function setCodigo( $valor )     { $this->Codigo = $valor; }
    public function setDescricao($descri )  { $this->Descricao = $descri; }
    public function setUnidadeDeMedida( $unid ) { $this->UnidadeDeMedida = $unid; }
    public function setValorDeCusto($vlr )  { $this->ValorDeCusto = $vlr; }
    public function setMargemDeLucro( $mg ) { $this->MargemDeLucro = $mg; }

    public function GetValidationError( $nome )
	{
		return @$this->validationErrors[ $nome] ;
	}

    public function ValidarDados()
    {
        $retorno = true;
        // Zera as mensagens anterior à última validação
        $this->validationErrors = [];

        if( $this->Descricao == "" ) {
            $this->validationErrors["DESCRICAO"] = "Descrição não pode ser vazia !";
            $retorno = false;
        }

        if( $this->UnidadeDeMedida == "" ) {
            $this->validationErrors["UNIDADEDEMEDIDA"] = "Unidade de Medida não pode ser vazio !";
            $retorno = false;
        }

        if( ! is_numeric( $this->ValorDeCusto ) ) {
            $this->validationErrors["VALORDECUSTO"] = "O valor de custo não é numérico !";
            $retorno = false;
        }

        return $retorno;
    }

    public function getValorDeVenda() {
        return $this->ValorDeCusto + ( $this->ValorDeCusto * $this->MargemDeLucro / 100 );
    }

}