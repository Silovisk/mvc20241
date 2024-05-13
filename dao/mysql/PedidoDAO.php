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
}
