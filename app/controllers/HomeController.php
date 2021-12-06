<?php

namespace App\controllers;
use App\controllers\BaseController;


class HomeController extends BaseController {

	public function getHome()
    {
        $fecha=explode(',',date('d,m,Y'));
        //$alumnos = ['Fernando', 'Fiorella', 'Ismael', 'Federico', 'Marcos'];
        return $this->renderHTML('home.twig',['saludo'=>"Hola San Juan","fecha"=>$fecha]);
    }

    public function getInfo()
    {
        $nosotros = "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusantium, possimus. Dolores accusamus, tempora quam odit, ex praesentium ad at omnis nobis sit debitis officia similique, placeat blanditiis aspernatur modi ab!";
        $fecha=explode(',',date('d,m,Y'));
        return $this->renderHTML('nosotros.twig',['nosotros'=>$nosotros,"fecha"=>$fecha]);
    }

}

?>