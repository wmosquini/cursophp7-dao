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
            $this->setData($results[0]);
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
            $this->setData($results[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos");
        }
    }
    public function setData($data) {
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['dessenha']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime ($data['dtcadastro']));
    }
    public function insert() {
        $sql = new Sql();

        //chama a procedure no bando de dados (criada no workbench)
        $results = $sql->select("call sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));
        
        if (isset($results[0])){
            $this->setData($results[0]);
        }
    }
    public function update($login, $password) {

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("update tb_usuario set deslogin = :LOGIN, dessenha = :PASSWORD where id_usuario = :ID",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()
        ));
    }
    public function __construct($login="", $password=""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
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