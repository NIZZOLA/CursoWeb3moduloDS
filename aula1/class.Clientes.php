<?php

class Cliente {

    private $codigo, $nome, $dtnasc, $cpf, $cidade, $estado;
    // Propriedade PRIVADA utilizada para salvar as mensagens de validação da classe
    private $validationErrors;
    
    public function getCodigo()     {   return $this->codigo;      }
    public function getNome()       {   return $this->nome;        }
    public function getDataNascimento()     {    return $this->dtnasc; }
    public function getCpf()        {   return $this->cpf;    }
    public function GetCidade()     {   return $this->cidade; }
    public function GetEstado()     {   return $this->estado; }
    public function GetValidationErrors() { return $this->validationErrors; }
    
    public function GetValidationError( $nome )
	{
		return @$this->validationErrors[ $nome] ;
	}

    public function setCodigo($valor)  {    $this->codigo = $valor;  }
    public function setNome($nome)      {   $this->nome = $nome;    }
    public function setDataNascimento($data ) { $this->dtnasc = $data; }
    public function setCpf( $cpf) { $this->cpf = $cpf;}
    public function setCidade($cidade) { $this->cidade = $cidade; }
    public function setEstado($estado) { $this->estado = $estado; }
    
    // métodos
    public function ValidarDados()    {
        // Zera as mensagens anterios à última validação
        $this->validationErrors = [];
        $retorno = true;
        // valida-se o campo nome
        if( $this->nome == "" ) {
            $retorno = false;
            $this->validationErrors["NOME"] = "O campo nome não pode ser vazio";
        }
        else
        {
            if( strlen ( $this->nome ) > 50 ) {
                $retorno = false;
                $this->validationErrors["NOME"] = "O campo nome só pode ter 50 caracteres !";
            }
        }

        // validando campo cpf
        if( $this->cpf == "" ) {
            $retorno = false;
            $this->validationErrors["CPF"] = "O campo CPF não pode ser vazio";
        }

        return $retorno;
    }

    public function Incluir()    {
        if( $this->ValidarDados()) {

        }

    }

    public function Alterar()    {
        if( $this->ValidarDados()) {

        }

    }

    public function Excluir()    {

    }

    public function Consultar( $codigo ) {

    }

    public function Listar() {

    }

}

?>