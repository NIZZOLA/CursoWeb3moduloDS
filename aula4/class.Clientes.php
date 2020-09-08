<?php

class Cliente {

    private $codigo, $nome, $dtnasc, $cpf, $cidade, $estado;
    // Propriedade PRIVADA utilizada para salvar as mensagens de validação da classe
    private $validationErrors;

    function Cliente($cod = 0, $nom = "null" )
    {
        $this->codigo = $cod;
        $this->nome = $nom;
        
    }
    
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

    // versão 1 + simples possível
    public function Incluir()    {
        if( $this->ValidarDados()) {

            // abrir a conexão com banco de dados
            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );
            // valida a conexão
            if( $conn->connect_error) {
                echo "Erro de conexão !".$conn->connect_error;
                return false;
            }

            $sql = "INSERT INTO `clientes`( `nome`, `nascimento`, `cpf`, `cidade`, `estado`) 
                    VALUES ( '$this->nome' , '" .date( "Y-m-d" ,$this->dtnasc). "', '$this->cpf', '$this->cidade', '$this->estado' )";

            //echo $sql;
            if( $conn->query($sql) == TRUE ) {
                echo "Dados inseridos com sucesso !";
                return true;
            }
            else
            {
                echo "Erro na inclusão !".$conn->error;
                return false;
            }

        }
    }

    public function Incluir2()    {
        if( $this->ValidarDados()) {

            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );
            // valida a conexão
            if( $conn->connect_error) {
                echo "Erro de conexão !".$conn->connect_error;
                return false;
            }

            $sql = "INSERT INTO `clientes`( `nome`, `nascimento`, `cpf`, `cidade`, `estado`) 
                    VALUES (?,?,?,?,?)";

            $cmdprepared = $conn->prepare($sql);
            $dataFormatada = date( "Y-m-d", $this->dtnasc);
            $cmdprepared->bind_param( "sssss", $this->nome, $dataFormatada , $this->cpf, $this->cidade, $this->estado );

            //echo $sql;
            if( $cmdprepared->execute() ) {
                echo "Dados inseridos com sucesso !";
                return true;
            }
            else
            {
                echo "Erro na inclusão !".$conn->error;
                return false;
            }

        }
    }


    public function Alterar()    {
        if( $this->ValidarDados()) {

            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );
            // valida a conexão
            if( $conn->connect_error) {
                echo "Erro de conexão !".$conn->connect_error;
                return false;
            }

            $sql = "UPDATE clientes set nome=?, nascimento=?, cpf=?, cidade=?, estado=?
                    WHERE codigo=?";

            $cmdprepared = $conn->prepare($sql);
            $dataFormatada = date( "Y-m-d", $this->dtnasc);
            $cmdprepared->bind_param( "ssssss", $this->nome, $dataFormatada , $this->cpf, $this->cidade, $this->estado, $this->codigo);

            //echo $sql;
            if( $cmdprepared->execute() ) {
                echo "Dados alterados com sucesso !";
                return true;
            }
            else
            {
                echo "Erro na alteração !".$conn->error;
                return false;
            }


        }

    }

    public function Excluir($codigo)    {

        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );
            // valida a conexão
            if( $conn->connect_error) {
                echo "Erro de conexão !".$conn->connect_error;
                return false;
            }

        $sqlcmd = "DELETE FROM clientes where codigo=".$codigo;
        echo $sqlcmd;

        if( $conn->query($sqlcmd) == TRUE ) 
            return true;
        else
            return false;
        

    }

    public function Consultar( $codigo ) {

            $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );
            // valida a conexão
            if( $conn->connect_error) {
                echo "Erro de conexão !".$conn->connect_error;
                return false;
            }

            $sqlcmd = "SELECT * FROM `clientes` where codigo=".$codigo;
            //echo $sqlcmd;

            $resultado = $conn->query($sqlcmd);

            if( $resultado->num_rows > 0 ) {
                while( $linha = $resultado->fetch_assoc()) {
                    
                    $this->setCodigo( $linha['codigo'] );
                    $this->setNome($linha['nome']);
                    $this->setDataNascimento(  formataYMDtoTime( $linha['nascimento'])  );
                    $this->setCpf( $linha['cpf']);
                    $this->setCidade($linha['cidade']);
                    $this->setEstado($linha['estado']);

                    return true;
                }
            }
            return false;

    }

    public function Listar() {

        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME );
            // valida a conexão
            if( $conn->connect_error) {
                echo "Erro de conexão !".$conn->connect_error;
                return false;
            }

        $sqlcmd = "SELECT * FROM `clientes` order by nome";

        $resultado = $conn->query($sqlcmd);

        $lista = [];
        if( $resultado->num_rows > 0 ) {
            while( $linha = $resultado->fetch_assoc()) {
                //echo "<br>codigo:".$linha['codigo']." Nome:".$linha['nome']." Nascimento:".$linha['nascimento'];

                $cliObj = new Cliente();
                $cliObj->setCodigo( $linha['codigo'] );
                $cliObj->setNome($linha['nome']);
                $cliObj->setDataNascimento(  formataYMDtoTime( $linha['nascimento'])  );
                $cliObj->setCpf( $linha['cpf']);
                $cliObj->setCidade($linha['cidade']);
                $cliObj->setEstado($linha['estado']);

                $lista[] = $cliObj;
            }
        }
        return $lista;
    }

}

?>