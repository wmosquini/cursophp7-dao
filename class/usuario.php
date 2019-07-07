<?php

class Usuario {
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario (){
        return $this->idusuario;
    }
    public function setIdusuario ($idusuario){
        $this->idusuario = $idusuario;
    }
    public function getDeslogin (){
        return $this->deslogin;
    }
    public function setDeslogin ($deslogin){
        $this->deslogin = $deslogin;
    }
    public function getDessenha (){
        return $this->dessenha;
    }
    public function setDessenha ($dessenha){
        $this->dessenha = $dessenha;
    }
    public function getDtcadastro (){
        return $this->dtcadastro;
    }
    public function setDtcadastro ($dtcadastro){
        $this->dtcadastro = $dtcadastro;
    }

    public function loadById ($id){
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuario where idusuario = :ID", array(
            ":ID"=>$id
        ));

        if (isset($results[0])){
            $row = $results[0];
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['dessenha']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime ($row['dtcadastro']));
        }
    }

    //como não temos referencia ($this), podemos deixar como static
    public static function getList(){
        $sql = new Sql();
        return $sql->select("select * from tb_usuario");
    }
    public static function search($login){
        $sql = new Sql();
        return $sql->select("select * from tb_usuario where deslogin like :SEARCH", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }
    public function login ($login, $senha) {
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuario where deslogin = :LOGIN and dessenha = :SENHA", array(
            ":LOGIN"=>$login,
            ":SENHA" =>$senha
        ));

        if (isset($results[0])){
            $row = $results[0];
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['dessenha']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime ($row['dtcadastro']));
        } else {
            throw new Exception("Login e/ou senha inválidos");
        }
    }

    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "dessenha"=>$this->getDessenha(),
            "deslogin"=>$this->getDeslogin(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }
}

?>