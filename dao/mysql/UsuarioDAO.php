<?php
namespace dao\mysql;

use dao\interface\IUsuarioDAO;
use generic\MysqlFactory;
use Exception;

class UsuarioDAO extends MysqlFactory implements IUsuarioDAO{


    public function autenticar($nome, $email)
    {
        $sql = "SELECT nome, email FROM Usuarios where nome=:nome and email=:email";
        $retorno = $this->banco->executar($sql, ["nome" => $nome, "email" => $email]);
        
        return $retorno;
    }

    public function index(){
        $sql="SELECT id, nome, email FROM Usuarios";
        $retorno= $this->banco->executar($sql);
        return $retorno;
    }

    public function store($nome, $email){
        $sql="INSERT INTO Usuarios (nome, email) VALUES (:nome, :email)";
        $retorno = $this->banco->executar($sql,["nome"=>$nome, "email"=>$email]);
        return $retorno;
    }

    public function show($id){
        $usuarioExiste = $this->findUsuario($id);
        if (empty($usuarioExiste)) {
            return "Usuário não encontrado";
        }
        $sql = "SELECT * FROM Usuarios where id = $id";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function update($id, $nome, $email)
    {
        $usuarioExiste = $this->findUsuario($id);
        if (empty($usuarioExiste)) {
            return "Usuário não encontrado";
        }
        $sql = "UPDATE Usuarios SET nome = :nome, email = :email WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["nome" => $nome, "email" => $email, "id" => $id]);
        return $retorno;
    }

    public function destroy($id)
    {
        try {
            $usuarioExiste = $this->findUsuario($id);
            if (empty($usuarioExiste)) {
                return "Usuário não encontrado";
            }
            $sql = "DELETE FROM Usuarios WHERE id = :id";
            $retorno = $this->banco->executar($sql, ["id" => $id]);
            return $retorno;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findUsuario($id)
    {
        $sql = "SELECT id FROM Usuarios WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        return $retorno;
    }

    public function findAllUsuario($id)
    {
        $sql = "SELECT * FROM Usuarios WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        return $retorno;
    }
}