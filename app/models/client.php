<?php

namespace App\models;

use illuminate\Database\Eloquent\Model;

class client extends Model {

	protected $table = 'client';

	public function nombre_apellido()
	{return $this->name." ".$this->last_name;}

	public function adeuda($ventas)
	{
		echo("<br>".$ventas[0]->owes."<br>");
		foreach($ventas as $v)
		{
			echo("<br>".$v->owes."<br>");
			die;
			if($v->owes>0)
			return true;
		}
	

		return false;

	}
	
}

?>