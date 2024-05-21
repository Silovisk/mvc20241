<?php

namespace dao\mysql;

use dao\interface\IPratoDAO;
use generic\MysqlFactory;
use Exception;

class PratoDAO extends MysqlFactory implements IPratoDAO
{
    public function index()
    {
        $sql = "SELECT nome, descricao, preco, restaurante_id FROM Pratos";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function store($nome, $descricao, $preco, $restaurante_id)
    {
        $restauranteDAO = new RestauranteDAO();
        $restaurante = $restauranteDAO->findRestaurante($restaurante_id);

        if (empty($restaurante)) {
            return "Restaurante não encontrado";
        }

        $sql = "INSERT INTO Pratos 
        (
            nome
            ,descricao
            ,preco
            ,restaurante_id
        ) VALUES 
        (
            :nome
            ,:descricao
            ,:preco
            ,:restaurante_id 
        )";
        $retorno = $this->banco->executar(
            $sql,
            [
                "nome" => $nome,
                "descricao" => $descricao,
                "preco" => $preco,
                "restaurante_id" => $restaurante_id
            ]
        );
        return $retorno;
    }
    
    public function show($id)
    {
        $prato = $this->findPrato($id);
        if (empty($prato)) {
            return "Prato não encontrado";
        }
        $sqlPrato = "SELECT * FROM Pratos where id = $id";
        // $sql = "SELECT p.*, r.* FROM Pratos p INNER JOIN restaurantes r ON r.id = p.restaurante_id where p.id = $id";
        $retornoPrato = $this->banco->executar($sqlPrato);

        $restaurante_id = $retornoPrato[0]['restaurante_id'];
        $sqlRestaurante = "SELECT * FROM Restaurantes where id = $restaurante_id";
        $retornoRestaurante = $this->banco->executar($sqlRestaurante);

        $data = [
            "prato" => $retornoPrato,
            "restaurante" => $retornoRestaurante
        ];
        return $data;
    }

    public function update($id, $nome, $descricao, $preco, $restaurante_id)
    {
        try {
            $prato = $this->findPrato($id);
            $restauranteDAO = new RestauranteDAO();
            $restaurante = $restauranteDAO->findRestaurante($restaurante_id);

            if (empty($prato)) {
                return "Prato não encontrado";
            }

            if (empty($restaurante)) {
                return "Restaurante não encontrado";
            }

            $sql ="UPDATE Pratos SET 
                    nome = :nome
                    ,descricao = :descricao
                    ,preco = :preco
                    ,restaurante_id = :restaurante_id 
                    WHERE id = :id
                ";
            $retorno = $this->banco->executar(
                $sql,
                [
                    "nome" => $nome,
                    "descricao" => $descricao,
                    "preco" => $preco,
                    "restaurante_id" => $restaurante_id,
                    "id" => $id
                ]
            );
            return $retorno;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $prato = $this->findPrato($id);
            if (empty($prato)) {
                return "Prato não encontrado";
            }
            $sql = "DELETE FROM Pratos WHERE id = :id";
            $retorno = $this->banco->executar($sql, ["id" => $id]);
            return $retorno;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function findPrato($id)
    {
        $sql = "SELECT id FROM Pratos WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        return $retorno;
    }

    public function findAllPrato($id)
    {
        $sql = "SELECT * FROM Pratos WHERE id = :id";
        $retorno = $this->banco->executar($sql, ["id" => $id]);
        
        return $retorno;
    }
}
