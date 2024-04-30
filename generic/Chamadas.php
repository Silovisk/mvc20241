<?php

namespace generic;

class Chamadas
{
    private $arrChamadas = [];
    public function __construct()
    {
        $this->arrChamadas = [
            "professores/lista" => new Acao("service\ProfessorService", "listar"),
            "professores/soma" => new Acao("service\ProfessorService", "professor",[Acao::GET,Acao::POST]),
            "professores/inserir" => new Acao("service\ProfessorService", "inserir",[Acao::POST]),
           
        ];
    }

    public function buscarRotas($endpoint)
    {
       
        if (isset($this->arrChamadas[$endpoint])) {

            return   $this->arrChamadas[$endpoint];
        }

        return null;
    }
}
