<?php
namespace dao\mysql;

use dao\interface\IRestauranteDAO;
use generic\MysqlFactory;
use Exception;

class RestauranteDAO extends MysqlFactory implements IRestauranteDAO{

    public function index(){
        $sql="SELECT id, nome, endereco FROM Restaurantes";
        $retorno= $this->banco->executar($sql);
        return $retorno;
    }

    public function store($nome, $endereco){
        $sql="INSERT INTO Restaurantes (nome, endereco) VALUES (:nome, :endereco)";
        $retorno = $this->banco->executar($sql,["nome"=>$nome, "endereco"=>$endereco]);
        return $retorno;
    }

    public function show($id){
        $restauranteExiste = $this->findRestaurante($id);
        if (empty($restauranteExiste)) {
            return "Restaurante não encontrado";
        }
        $sql = "SELECT * FROM Restaurantes where id = $id";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function update($id, $nome, $endereco)
    {
        $restauranteExiste = $this->findRestaurante($id);
        if (empty($restauranteExiste)) {
            return "Restaurante não encontrado";
        }
        $sql = "UPDATE Restaurantes SET nome = :nome, endereco = :endereco WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["nome" => $nome, "endereco" => $endereco, "id" => $id]);
        return $retorno;
    }

    public function destroy($id)
    {
        try {
            $restauranteExiste = $this->findRestaurante($id);
            if (empty($restauranteExiste)) {
                return "Restaurante não encontrado";
            }
            $sql = "DELETE FROM Restaurantes WHERE id = :id";
            $retorno = $this->banco->executar($sql, ["id" => $id]);
            return $retorno;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findRestaurante($id)
    {
        $sql = "SELECT id FROM Restaurantes WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        return $retorno;
    }

    public function findAllRestaurante($id)
    {
        $sql = "SELECT * FROM Restaurantes WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        return $retorno;
    }
}