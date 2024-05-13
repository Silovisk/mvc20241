<?php 

namespace service;

use dao\mysql\PedidoDAO;

class PedidoService extends PedidoDAO{
    public function listar(){
       return parent::listar();
    }

    public function inserir($usuario_id, $restaurante_id, $data_hora){
        if($usuario_id == '' || $restaurante_id == '' || $data_hora == ''){
            return false;
        }
        parent::inserir($usuario_id, $restaurante_id, $data_hora);
        return true;
    }

    public function atualizar($id, $usuario_id, $restaurante_id, $data_hora){
        if($id == '' || $usuario_id == '' || $restaurante_id == '' || $data_hora == ''){
            return false;
        }
        parent::atualizar($id, $usuario_id, $restaurante_id, $data_hora);
        return true;
    }

    public function deletar($id){
        if($id == ''){
            return false;
        }
        parent::deletar($id);
        return true;
    }
}