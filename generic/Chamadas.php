<?php

namespace generic;

use Traits\Commom;

class Chamadas
{
    private $arrChamadas = [];

    public function __construct()
    {
        $this->arrChamadas = [
            "usuario/autenticar" => new Acao("service\UsuarioService", "autenticar", [Acao::POST]),
            "pedido/retornaRestauranteEUsuario" => new Acao("service\PedidoService", "retornaRestauranteEUsuario", [Acao::GET]),
            "pedidosPratos/retornaPedidosPratos" => new Acao("service\PedidosPratosService", "retornaPedidosPratos", [Acao::GET]),
        ];

        $commom = new Commom();

        $this->arrChamadas = array_merge($this->arrChamadas, $commom->apiResource("usuario"));
        $this->arrChamadas = array_merge($this->arrChamadas, $commom->apiResource("restaurante"));
        $this->arrChamadas = array_merge($this->arrChamadas, $commom->apiResource("prato"));
        $this->arrChamadas = array_merge($this->arrChamadas, $commom->apiResource("pedido"));
        $this->arrChamadas = array_merge($this->arrChamadas, $commom->apiResource("pedidosPratos"));

    }

    public function buscarRotas($endpoint)
    {
        if (isset($this->arrChamadas[$endpoint])) {
            return $this->arrChamadas[$endpoint];
        }
        return null;
    }
}
