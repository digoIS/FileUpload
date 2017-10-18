<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteRestController extends Controller
{
    //
	public function getIndex(){
		echo "Página inicial.";
	}
	
	public function postTeste(){
		echo "RestFul.post";
	}
	
	public function deleteIndex(){
		echo "RestFul.delete";
	}
}
