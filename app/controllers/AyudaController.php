<?php

namespace App\controllers;
use App\controllers\BaseController;


class AyudaController  extends BaseController {

	public function getHelp()
    {
        $fecha = explode(',',date('d,m,Y'));
        return $this->renderHTML('ayuda.twig',["fecha"=>$fecha, 'ayuda'=>"Hola, ¿cómo podemos ayudarte?"]);
    }
}

?>