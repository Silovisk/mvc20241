<?php

namespace generic;

class Chamadas
{
    private $arrChamadas = [];
    public function __construct()
    {
        $this->arrChamadas = [
            "professores/lista" => new Acao("service\ProfessorService", "listar"),
            "professores/soma" => new Acao("service\ProfessorService", "professor"),
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
