<?php
namespace service;

use bean\Professor;
use dao\mysql\ProfessorDAO;

class ProfessorService extends ProfessorDAO{
    public function listar(){
       $retorno= parent::listar();
       return $retorno;
    }

    public function professor($nome,$endereco){
       // return $nome." ".$endereco;
       $p = new Professor();
       $p->nome = $nome;
       $p->endereco =$endereco;
       $p->telefone = new Professor();
        return $p;
    }
}
?>