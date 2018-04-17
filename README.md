# SOLUCION DEL PROBLEMA
	
A través de la carga de un archivo de texto plano al servidor, se empezará a procesar el resultado. Todos los casos deben ser colocados de la misma forma como esta presentado en el ejercicio.

Se creó una clase Nodo con la siguiente informacion: posicion i, posicion j, y la letra que este poseía en el tablero. Se creo una matriz de nodos que contendría toda la sopa de letras completa, y una cola de i’S ; ya que la i siendo la letra del centro era más rapido ver si en los extremos de arriba, a los lados y diagonales habia exactamente una ‘e’ y una ‘o’.
	
Entonces una vez guardados los datos  en la estructuras se tendría una cola con cada I y su posición por lo que no es necesario recorrer toda la matriz sino solo ir desencolando cada I y luego revisando si al concatenar su vecinas posibles se producía la palabra “OIE” o “EIO” ya que si se quería el sentido contrario era igual a voltear la palabra buscada. Cada vez que se halla una concidencia se cuenta y se guarda en un arreglo de repuestas que es enviado al servidor.

## CLASES USADAS:

	RUTA App\Clases\Nodo.php;

	class Nodo {
  		public $letra;
		public $i, $j;
	
		function __construct($letra, $i, $j) {
      			$this->letra= $letra;
	  		$this->i= $i;
	  		$this->j=$j;
  	 	}
	}

- CONTROLADOR EjercicioController (RUTA: app\Http\Controllers\ EjercicioController.php)
- create_word($matriz, $i, $j, $i2, $j2): función usada para crear la palabra con las letras vecinas
- verificar_word: función usada para verificar que una palabra conicide.
- Procesar: función que crea la estructura de datos, y cuenta el resultado

## COMO TESTEAR

- Se debe crear un archivo con los casos de prueba. He dejado uno (ejemplo.txt) en la raiz

- Luego se abre la ruta principal del proyecto donde dice examinar se selecciona el archivo creado y se presiona el boton subir.

- Los datos empezaran a procesarse de acuerdo a lo anteriormente explicado y obtendrá una repuesta.



