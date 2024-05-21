<?php

namespace dao\mysql;

use dao\interface\IPedidosPratosDAO;
use generic\MysqlFactory;
use Exception;

class PedidosPratosDAO extends MysqlFactory implements IPedidosPratosDAO
{

    public function index()
    {
        $sql = "SELECT * FROM pedidospratos";
        $retorno = $this->banco->executar($sql);

        return $retorno;
    }

    public function store($pedido_id, $prato_id, $quantidade)
    {
        $pedidoDAO = new PedidoDAO();
        $pedido = $pedidoDAO->findPedido($pedido_id);

        $pratoDAO = new PratoDAO();
        $prato = $pratoDAO->findPrato($prato_id);

        if (empty($pedido)) {
            return "Pedido não encontrado";
        }

        if (empty($prato)) {
            return "Prato não encontrado";
        }

        $sql = "INSERT INTO pedidospratos 
        (
            pedido_id
            ,prato_id
            ,quantidade
        ) VALUES
        (
            :pedido_id
            ,:prato_id
            ,:quantidade
        )";

        $retorno = $this->banco->executar(
            $sql,
            [
                "pedido_id" => $pedido_id,
                "prato_id" => $prato_id,
                "quantidade" => $quantidade,
            ]
        );

        return $retorno;
    }

    public function show($id)
    {
        $pedidosPratos = $this->findAllPedidosPratos($id);

        if (empty($pedidosPratos)) {
            return "PedidosPratos não encontrado";
        }

        return $pedidosPratos;
    }

    public function update($id, $pedido_id, $prato_id, $quantidade)
    {
        try {

            $pedidosPratos = $this->findPedidosPratos($id);

            if (empty($pedidosPratos)) {
                return "PedidosPratos não encontrado";
            }

            $pedidoDAO = new PedidoDAO();
            $pedido = $pedidoDAO->findPedido($pedido_id);

            if (empty($pedido)) {
                return "Pedido não encontrado";
            }

            $pratoDAO = new PratoDAO();
            $prato = $pratoDAO->findPrato($prato_id);


            if (empty($prato)) {
                return "Prato não encontrado";
            }

            $sql = "UPDATE pedidospratos SET 
                    pedido_id = :pedido_id
                    ,prato_id = :prato_id
                    ,quantidade = :quantidade
                    WHERE id = :id
                ";
            $retorno = $this->banco->executar(
                $sql,
                [
                    "pedido_id" =>  $pedido_id,
                    "prato_id" => $prato_id,
                    "quantidade" => $quantidade,
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
            $pedidosPratos = $this->findPedidosPratos($id);

            if (empty($pedidosPratos)) {
                return "PedidosPratos não encotrado";
            }

            $sql = "DELETE FROM pedidospratos WHERE id = :id";
            $retorno = $this->banco->executar($sql, ["id" => $id]);

            return $retorno;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function retornaPedidosPratos($id)
    {
        $pedidosPratos = $this->findAllPedidosPratos($id);
        
        if (empty($pedidosPratos)) {
            return "PedidosPratos não encontrado";
        }
        $pedidosPratos = $pedidosPratos[0];
        
        $pedido_id = $pedidosPratos['pedido_id'];
        $prato_id = $pedidosPratos['prato_id'];

        $pedidoDAO = new PedidoDAO();
        $pedido = $pedidoDAO->findAllPedido($pedido_id);

        if (empty($pedido)) {
            return "Pedido não encontrado";
        }

        $retornaRestauranteEUsuario = $pedidoDAO->retornaRestauranteEUsuario($pedido_id);

        $pratoDAo = new PratoDAO();
        $prato = $pratoDAo->findAllPrato($prato_id);

        if (empty($prato)) {
            return "Prato não encontrado";
        }


        $data =
            [
                "pedido" => $pedido,
                "retorno" => $retornaRestauranteEUsuario,
                "prato" => $prato
            ];

        return $data;
    }

    public function findPedidosPratos($id)
    {
        $sql = "SELECT id FROM pedidospratos WHERE id = $id";
        $retorno = $this->banco->executar($sql);

        return $retorno;
    }

    public function findAllPedidosPratos($id)
    {
        $sql = "SELECT * FROM pedidospratos WHERE id = $id";
        $retorno = $this->banco->executar($sql);

        return $retorno;
    }
}
