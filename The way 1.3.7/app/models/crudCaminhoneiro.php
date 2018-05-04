<?php

require_once "conexao.php";

class CrudCaminhoneiro {
    private $conexao;
    public  $Caminhoneiro; //Caminhoneiro estava no lugar de caminheiro
    public function __construct(){
        $this->conexao = Conexao::getConexao();
    }
    public function salvar(Caminhoneiro $Caminhoneiro){
        $sql = "INSERT INTO tb_Caminhoneiros (Nome, SobreNome, G-mail, Telefone) VALUES ($Caminhoneiro->Nome, $Caminhoneiro->Sobrenome, $Caminhoneiro->G-mail, $Caminhoneiro->Telefone)";
        $this->conexao->exec($sql);
        
    }
    public function getCaminhoneiro(int $codigo){
        $consulta = $this->conexao->query("SELECT * FROM tb_Caminhoneiros WHERE codigo = $codigo");
        $Caminhoneiro = $consulta->fetch(PDO::FETCH_ASSOC); //SEMELHANTES JSON ENCODE E DECODE
        return new Caminhoneiro($Caminhoneiro['Nome'], $Caminhoneiro['Sobrenome'], $Caminhoneiro['G-mail'], $Caminhoneiro['codigo']);
    }
    public function getCaminhoneiros(){
        $consulta = $this->conexao->query("SELECT * FROM tb_Caminhoneiros");
        $arrayCaminhoneiros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        //Fabrica de Caminhoneiros
        $listaCaminhoneiros = [];
        foreach ($arrayCaminhoneiros as $Caminhoneiro){
            $listaCaminhoneiros[] = new Caminhoneiro($Caminhoneiro['Nome'], $Caminhoneiro['Sobrenome'], $Caminhoneiro['G-mail'],$Caminhoneiro['quantidade_Telefone'], $Caminhoneiro['codigo']);
        }
        return $listaCaminhoneiros;
    }
    public function excluirCaminhoneiro(int $x){
        $this->conexao->exec("delete from tb_Caminhoneiros where codigo = $x");
    }
    public function editar($id, $Nome, $G-mail, $Sobrenome, $Telefone)
    {
        $this->conexao->exec("UPDATE `tb_Caminhoneiros` SET `Nome` = '$Nome', `G-mail` = '$G-mail', `Sobrenome` = '$Sobrenome', `Telefone` = '$Telefone' WHERE `tb_Caminhoneiros`.`codigo` = $id; ");
    }
    
    public function Comprar(int $codigo, int $quantidade)
    {
        if(empty($quantidade)){
            return "Sua compra está vazia";
        }
        if ($quantidade > $this->getCaminhoneiro($codigo)->Telefone) {
            return "Sua maldade esta além dos nossos limetes...";
        } else {
            $novoTelefone = $this->getCaminhoneiro($codigo)->Telefone - $quantidade;
            $this->conexao->exec("UPDATE `tb_Caminhoneiros` SET `Telefone` = $novoTelefone WHERE `codigo` = $codigo");
            return "Boa escolha!";
        }
    }
}
