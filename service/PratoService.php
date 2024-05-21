<?php 

namespace service;

use dao\mysql\PratoDAO;
use Exception;

class PratoService extends PratoDAO{
    
    public function index(){
       return parent::index();
    }

    public function store($nome, $descricao, $preco, $restaurante_id){
        return parent::store($nome, $descricao, $preco, $restaurante_id);
    }

    public function show($id){
        return parent::show($id);
    }

    public function update($id, $nome, $descricao, $preco, $restaurante_id){
        return parent::update($id, $nome, $descricao, $preco, $restaurante_id);
    }

    public function destroy($id){
        return parent::destroy($id);
    }
}