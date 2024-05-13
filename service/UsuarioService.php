<?php 

namespace service;

use dao\mysql\UsuarioDAO;
use generic\JWTAuth;
use Exception;

class UsuarioService extends UsuarioDAO{

    public function autenticar(){
        $jwt = new JWTAuth();
        return $jwt->criarChave("CHAMITIN_BALAHALLSSS_DE_HAHA_DE_RAIO_LAIZER_ULALAU");
    }
    
    public function index(){
       return parent::index();
    }

    public function store($nome, $email){
        return parent::store($nome, $email);
    }

    public function show($id){
        return parent::show($id);
    }

    public function update($id, $nome, $email){
        return parent::update($id, $nome, $email);
    }

    public function destroy($id){
        return parent::destroy($id);
    }
}