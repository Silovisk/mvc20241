<?php
namespace dao\interface;
interface IBebidaDAO{
    public function index();
    public function store($nome, $descricao, $preco, $restaurante_id);
}