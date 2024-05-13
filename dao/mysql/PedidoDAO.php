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
    }

}
