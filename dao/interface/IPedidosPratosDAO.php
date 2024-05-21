<?php
namespace dao\interface;
interface IPedidosPratosDAO{
    public function index();
    public function store($usuario_id, $restaurante_id, $data_hora);
}