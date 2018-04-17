<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clases\Nodo;



/*
Controlador que ejecutará el paso de la vista
*/
class EjercicioController extends Controller {


	/*
		Pagina Para cargar Archivo
	*/
    static public function index() {
        return view('welcome', ['resp'=> []]);
    }
	
	/*
		Procesar ARCHIVO
		Se cargará un archivo desde la pagina pricipal y luego este se procesará para asi obtener 
		las cantidad de veces que e repite la palabra "OIE";
	*/
	 public function procesar(Request $r) {
		 if (!$r->hasfile('Archivito')){
			  return view('welcome', ['resp'=> ["Coloque un archivo"]]);
		 }
		//Abriendo Archivo
		$file = fopen($r->file('Archivito'), "r");
		//Comenzado Lectura
		$respuestas=[];
        while (!feof($file)) {
            $linea = fgets($file);
			$cant= explode(" ", $linea, 2);
			
			//LIMITES DE LA MATRIZ
			$cant[0]= intval($cant[0]);
			$cant[1]= intval($cant[1]);
			
			//CREANDO MATRIZ
			$matriz  = []; //VARIABLE QUE ALMACENARA LA SOPA DE LETRAS
			$cola_is = []; //COLA DE I'S, Ya que la I es el punto medio de la palabra.
			$cant_i=0;     //Cantidad de I'S encontradas
			
			for	($i=0; $i < $cant[0]; $i++){
				$linea2 = fgets($file);
				$letras= $linea2;
				$matriz  [$i] = [];
				for	($j=0; $j < $cant[1]; $j++){
					//SE CREA CADA NODO DE LA MATRIZ (VER APP\Clases\Nodo).
					$nodo = new Nodo($letras[$j],$i, $j);
					$matriz  [$i][$j] = $nodo;
					//Si el nodo es de un i este se encola
					if ($letras[$j] == "I"){
						$cola_is[]= $nodo;
						$cant_i++;
					}
				}
			}
			//PROCESAR MATRIZ PARA HAYAR OIE
			
			$resp = 0;
			while($cant_i > 0){
				//SE DESENCOLA LA PRIMERA I HALLADA Y SE OBTIEN EN $i Y $j SU UBICACION EN LA MATRIZ
				$nodo= array_pop($cola_is);
				$j = $nodo->j;
				$i = $nodo->i;
				$resp+= $this->verificar_word($matriz, $i, $j+1, $i, $j-1);	    //HORIZONTAL
				$resp+=$this->verificar_word($matriz, $i+1, $j, $i-1, $j);      //VERTICAL
				$resp+=$this->verificar_word($matriz, $i+1, $j+1, $i-1, $j-1);  //DIAGONAL
				$resp+=$this->verificar_word($matriz, $i+1, $j-1, $i-1, $j+1);  //DIAGONAL INVERTIDO
				$cant_i--;
			}
			
			
			$respuestas[]=$resp;
        }
		//dd($respuestas);
		 return view('welcome', ['resp'=> $respuestas]);
    }
    
	//FUNCION QUE CREA UNA PALABRA USANDO DOS LETRAS DE CADA EXTREMO SITUADONSE SIEMPRE EN UN I
	//RETORNA CADENA CON LA UNION DE TRES LETRAS o NNN EN CASO DE ERROR
	public function create_word($matriz, $i, $j, $i2, $j2){
		try{
			return $matriz  [$i][$j]->letra.'I'.$matriz  [$i2][$j2]->letra;
		
		}catch(\ErrorException $e){
			//SI ESTA FUERA DEL LIMITE DE LA MATRIZ ESTA NO SERÁ VALIDA
			return "NNN";
		}	
	}
	
	//FUNCION QUE VERIFICA QUE UNA PALABRA USANDO DOS LETRAS DE CADA EXTREMO SITUADONSE SIEMPRE EN UN I DE 'EIO'
	//RETORNA 1: SI, 0: NO
	public function verificar_word($matriz, $i, $j, $i2, $j2){
		$word= $this->create_word($matriz, $i, $j, $i2, $j2);
		
		if ($word == "OIE" || $word == "EIO"){ //YA QUE ESTÁ BIEN ALDERECHO O AL REVES
			return 1;
		}else{
			return 0;
		}
	}

	

}
