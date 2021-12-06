<?php

namespace App\controllers;
use App\controllers\BaseController;


class AlumnosController extends BaseController {

	public function getName()
    {
        $alumnos = ['Fernando', 'Fiorella','Federico','Marcos','Ismael'];
        $fecha=explode(',',date('d,m,Y'));

        return $this->renderHTML('alumnos.twig', ['nombres' => $alumnos,"fecha"=>$fecha]);
    }
}

?>