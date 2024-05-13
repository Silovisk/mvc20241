<?php

namespace service;

use dao\mysql\PedidoDAO;

class PedidoService extends PedidoDAO
{
    public function index()
    {
        return parent::index();
    }

    public function store($usuario_id, $restaurante_id, $data_hora)
    {
        return parent::store($usuario_id, $restaurante_id, $data_hora);
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function update($id, $usuario_id, $restaurante_id, $data_hora)
    {
        return parent::update($id, $usuario_id, $restaurante_id, $data_hora);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
