<?php
namespace App\Clases;


class Nodo 
{
    public $letra;
	public $i, $j;
	
	function __construct($letra, $i, $j) {
      $this->letra= $letra;
	  $this->i= $i;
	  $this->j=$j;
   }

}
