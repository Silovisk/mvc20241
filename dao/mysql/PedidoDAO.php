<?php

namespace dao\mysql;

use dao\interface\IPedidoDAO;
use generic\MysqlFactory;
use Exception;

class PedidoDAO extends MysqlFactory implements IPedidoDAO
{
    public function index()
    {
        $sql = "SELECT * FROM Pedidos";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function store($usuario_id, $restaurante_id, $data_hora)
    {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->findUsuario($usuario_id);

        if (empty($usuario)) {
            return "Usuário não encontrado";
        }

        $restauranteDAO = new RestauranteDAO();
        $restaurante = $restauranteDAO->findRestaurante($restaurante_id);

        if (empty($restaurante)) {
            return "Restaurante não encontrado";
        }

        $sql = "INSERT INTO Pedidos 
        (
            usuario_id
            ,restaurante_id
            ,data_hora
        ) VALUES 
        (
            :usuario_id
            ,:restaurante_id
            ,:data_hora
        )";
        $retorno = $this->banco->executar(
            $sql,
            [
                "usuario_id" => $usuario_id,
                "restaurante_id" => $restaurante_id,
                "data_hora" => $data_hora
            ]
        );
        return $retorno;
    }

    public function show($id)
    {
        $pedido = $this->findPedido($id);
        if (empty($pedido)) {
            return "Pedido não encontrado";
        }
        $sqlPedido = "SELECT * FROM Pedidos where id = $id";
        $retornoPedido = $this->banco->executar($sqlPedido);

        $data = [
            "pedido" => $retornoPedido
        ];
        return $data;
    }

    
    public function update($id, $usuario_id, $restaurante_id, $data_hora)
    {
        try {
            $pedido = $this->findPedido($id);
            $restauranteDAO = new RestauranteDAO();
            $restaurante = $restauranteDAO->findRestaurante($restaurante_id);

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->findUsuario($usuario_id);

            if (empty($pedido)) {
                return "Pedido não encontrado";
            }

            if(empty($usuario)){
                return "Usuario não encontrado";
            }

            if (empty($restaurante)) {
                return "Restaurante não encontrado";
            }

            $sql ="UPDATE Pedidos SET 
                    usuario_id = :usuario_id
                    ,restaurante_id = :restaurante_id
                    ,data_hora = :data_hora
                    WHERE id = :id
                ";
            $retorno = $this->banco->executar(
                $sql,
                [
                    "usuario_id" => $usuario_id,
                    "restaurante_id" => $restaurante_id,
                    "data_hora" => $data_hora,
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
            $pedido = $this->findPedido($id);
            if (empty($pedido)) {
                return "pedido não encontrado";
            }
            $sql = "DELETE FROM Pedidos WHERE id = :id";
            $retorno = $this->banco->executar($sql, ["id" => $id]);
            return $retorno;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function retornaRestauranteEUsuario($id)
    {

        $pedido = $this->findAllPedido($id);
        
        if (empty($pedido)) {
            return "Pedido não encontrado";
        }

        $pedido = $pedido[0];
        
        $usuario_id = $pedido['usuario_id'];
        $restaurante_id = $pedido['restaurante_id'];
        
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->findAllUsuario($usuario_id);
        
        if (empty($usuario)) {
            return "Usuario não encontrado";
        }

        $restauranteDAO = new RestauranteDAO();
        $restaurante = $restauranteDAO->findAllRestaurante($restaurante_id);

        if (empty($restaurante)) {
            return "Restaurante não encontrado";
        }

        $data = [
            'usuario_id' => $usuario_id,
            [
                'usuario' => $usuario
            ],
            'restaurante_id' => $restaurante_id,
            [
                'restaurante' => $restaurante
            ]            
        ];

        return $data;
    }


    public function findPedido($id)
    {
        $sql = "SELECT p.id from Pedidos p where id = $id";
        $retorno = $this->banco->executar($sql);

        return $retorno;
    }

    public function findAllPedido($id)
    {
        $sql = "SELECT * from Pedidos p where id = $id";
        $retorno = $this->banco->executar($sql);

        return $retorno;
    }
}
