<?php

namespace dao\interface;

interface IPedidoDAO
{
    public function index();
    public function store(
        $pedido_id,
        $prato_id,
        $quantidade
    );
}
