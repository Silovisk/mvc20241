<?php 

namespace service;

use dao\mysql\RestauranteDAO;
use Exception;

class RestauranteService extends RestauranteDAO{
    
    public function index(){
       return parent::index();
    }

    public function store($nome, $endereco){
        return parent::store($nome, $endereco);
    }

    public function show($id){
        return parent::show($id);
    }

    public function update($id, $nome, $endereco){
        return parent::update($id, $nome, $endereco);
    }

    public function destroy($id){
        return parent::destroy($id);
    }
}