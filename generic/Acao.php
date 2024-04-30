<?php

namespace generic;

use Exception;
use ReflectionMethod;

class Acao
{
    //constants
    const POST = "POST";
    const GET = "GET";
    const PUT = "PUT";
    const DELETE = "DELETE";

    private $classe;
    private $metodo;
    //post, get, delete, patch, put
    private $action;

    public function __construct($classe, $metodo, $action = Acao::GET)
    {
        $this->classe = $classe;
        $this->metodo = $metodo;
        $this->action = $action;
    }

    public function executar()
    {
        try {
            $return = null;
            $obj = new $this->classe();

            $reflectM = new ReflectionMethod($obj::class, $this->metodo);
           $param= $this->verificaParametros($reflectM,$this->getInput());

           if($param){
                if($param === true){
                  $return=  $reflectM->invoke($obj);
                }else{
                  $return=  $reflectM->invokeArgs($obj,$param);
                }

                header("Content-Type: application/json");
                $r = new Retorno();
                $r->retorno= $return;
                echo json_encode($r);

           }
        } catch (Exception $e) {
            http_response_code(500);
            return "error";
        }
    }
    // só recebe json
    private function getInput()
    {
        $input = file_get_contents("php://input");
        if ($input) {
            return json_decode($input, true, 512, JSON_THROW_ON_ERROR);
        }
        
        return null;
    }
    private function verificaParametros(ReflectionMethod $reflectM, $parametros){

        $param=[];
        $reflecP= $reflectM->getParameters();
        if(sizeof($reflecP)){
            foreach($reflecP as $v){
                $name= $v->getName();
               
                if(!isset($parametros[$name])){
                    http_response_code(406);
                    return false;
                }
                $param[$name] = $parametros[$name];
            }

           
            return $param;

        }

        return true;
    }
}
