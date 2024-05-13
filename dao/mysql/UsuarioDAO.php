<?php
namespace dao\mysql;

use dao\interface\IUsuarioDAO;
use generic\MysqlFactory;
use Exception;

class UsuarioDAO extends MysqlFactory implements IUsuarioDAO{

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
        $usuarioExiste = $this->find($id);
        if (empty($usuarioExiste)) {
            return "Usuário não encontrado";
        }
        $sql = "SELECT * FROM Usuarios where id = $id";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function update($id, $nome, $email)
    {
        $usuarioExiste = $this->find($id);
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
            $usuarioExiste = $this->find($id);
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

    public function find($id)
    {
        $sql = "SELECT id FROM Usuarios WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        return $retorno;
    }
}