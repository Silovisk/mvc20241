<?php
namespace dao\mysql;

use dao\interface\IProfessorDAO;
use generic\MysqlFactory;

class ProfessorDAO extends MysqlFactory implements IProfessorDAO{

    public function listar(){
       
        $sql="select idprofessor, nome from professores";
       $retorno= $this->banco->executar($sql);
       return $retorno;
    }
}

?>