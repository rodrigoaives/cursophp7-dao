<?php

class Usuario {

    private $id;
    private $deslogin;
    private $dessenha;

    public function getId() {
        return $this->id;         
    }

    public function setId($value) {
        $this->id = $value; 
    }

    public function getDeslogin() {
        return $this->deslogin;         
    }

    public function setDeslogin($value) {
        $this->deslogin = $value; 
    }
    public function getDessenha() {
        return $this->dessenha;         
    }

    public function setDessenha($value) {
        $this->dessenha = $value; 
    }

    public function loadById($id) {

        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM desenvolvedor WHERE id = :ID", array(
            ":ID"=>$id
        ));

        if (count($results) > 0) { 

            $row = $results[0];
            
            $this->setData([0]);
        
        }

    }

    public static function getList(){
        
        $sql = new Sql();

        return $sql->select("SELECT * FROM desenvolvedor ORDER BY id ASC");

    }

    public static function search($login){
        
        $sql = new Sql();

        return $sql->select("SELECT * FROM desenvolvedor WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH'=>"%" . $login . "%"
        ));

    }

    public function login($login, $password) {

        $sql = new Sql();
        
        $results = $sql->select("SELECT * FROM desenvolvedor WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        if (count($results) > 0) { 

            $row = $results[0];

            $this->setData([0]);
        
        } else {

            throw new Exception("Login e/ou senha inválidos.");

        }

    }

    public function setData($data) { 

        $this->setId($data['id']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);

    }

    public function insert() { 

        $sql = new Sql();

        $results = $sql->select("CALL sp_desenvolvedor_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

    public function update($id, $login, $password) {

        $this->setId($id);
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE desenvolvedor SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE id = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getId()
        ));

    }

    public function __construct($login = "", $password = "") { 
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }


    public function __toString() { 

        return json_encode(array(
            "id"=>$this->getId(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha()
        ));

    }

}

?>