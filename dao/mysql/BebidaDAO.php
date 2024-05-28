<?php

namespace dao\mysql;

use dao\interface\IBebidaDAO;
use generic\MysqlFactory;
use Exception;

class BebidaDAO extends MysqlFactory implements IBebidaDAO
{
    public function index()
    {
        return $this->findAllBebida();
    }

    public function show($id)
    {
        if (empty($id)){
            return "Bebida não encontrada";
        }

        $bebida = $this->findBebida($id);
        
        if(empty($bebida)){
            return "Bebida não encotrada";
        }

        $data = [
            "bebida" => $bebida
        ];

        return $data;
    }

    public function store($nome, $descricao, $preco, $restaurante_id)
    {
        $restauranteDAO = new RestauranteDAO();
        $restaurante = $restauranteDAO->findRestaurante($restaurante_id);

        if(empty($restaurante))
        {
            return "Restaurante não encontrado";
        }

        // INSERT INTO Pratos (nome, descricao, preco, restaurante_id) VALUES
        // ('Prato 5', 'Descrição do Prato 5', 30.00, 3),
        // ('Prato 6', 'Descrição do Prato 6', 35.00, 3),
        // ('Prato 7', 'Descrição do Prato 7', 40.00, 4),
        // ('Prato 8', 'Descrição do Prato 8', 45.00, 4);
        
        $sql = "INSERT INTO Bebidas (nome, descricao, preco, restaurante_id) VALUES 
        (
            :nome,
            :descricao,
            :preco,
            :restaurante_id
        )";

        $data = [
            "nome" => $nome,
            "descricao" => $descricao,
            "preco" => $preco,
            "restaurante_id" => $restaurante_id,
        ];
        $retorno = $this->banco->executar($sql, $data);
    }
    public function findAllBebida()
    {
        $sql = "SELECT * from Bebidas";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function findBebida($id)
    {
        $sql = "SELECT * FROM Bebidas";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }
}
