<?php 

namespace service;

use dao\mysql\UsuarioDAO;
use generic\JWTAuth;
use Exception;
use stdClass;

class UsuarioService extends UsuarioDAO{
    public function autenticar($nome, $email)
    {
        $rows = parent::autenticar($nome, $email);
        if ($rows) {
            $jwt = new JWTAuth();
            $objeto=new stdClass();

            $rows = $rows[0];

            $objeto->nome=$rows["nome"];
            $objeto->email=$rows["email"];

            return $jwt->criarChave(json_encode($objeto));
        }

        http_response_code(401);
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