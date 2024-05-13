<?php

namespace Traits;

use generic\Acao;

class Commom
{
    
    //constants
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const DELETE = "DELETE";

    public $resource = [];

    public function apiResource($resourceName)
    {
        $serviceClass = "service\\" . ucfirst($resourceName) . "Service";
        $methodsResource = [
            'index' => self::GET,
            'store' => self::POST,
            'show' => self::GET,
            'update' => self::PUT,
            'destroy' => self::DELETE
        ];
    
        foreach ($methodsResource as $method => $verb) {
            $this->resource["$resourceName/$method"] = new Acao($serviceClass, $method, [$verb]);
        }
    
        return $this->resource;
    }
}
