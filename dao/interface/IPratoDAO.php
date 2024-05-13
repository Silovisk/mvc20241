<?php
namespace dao\interface;
interface IPratoDAO{
    public function index();
    public function store($nome, $descricao, $preco, $restaurante_id);
}