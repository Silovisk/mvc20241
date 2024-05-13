<?php
namespace dao\interface;
interface IUsuarioDAO{
    public function index();
    public function store($nome, $email);
}