<?php
namespace dao\interface;
interface IPedidoDAO{
    public function index();
    public function store($usuario_id, $restaurante_id, $data_hora);
}