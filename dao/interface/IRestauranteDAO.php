<?php
namespace dao\interface;
interface IRestauranteDAO{
    public function index();
    public function store($nome, $endereco);
}