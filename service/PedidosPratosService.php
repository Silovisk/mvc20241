<?php

namespace service;

use dao\mysql\PedidosPratosDAO;

class PedidosPratosService extends PedidosPratosDAO
{
    public function index()
    {
        return parent::index();
    }

    public function store($pedido_id, $prato_id, $quantidade)
    {
        return parent::store($pedido_id, $prato_id, $quantidade);
    }

    public function show($id)
    {
        return parent::show($id);
    }

    public function update($id, $pedido_id, $prato_id, $quantidade)
    {
        return parent::update($id, $pedido_id, $prato_id, $quantidade);
    }

    public function destroy($id)
    {
        return parent::destroy($id);
    }
}
