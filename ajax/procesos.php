<?php
$sugerencia='';
$datosRecibidos= $_POST['datos'];
$bancoResultados=array(
	'Angel',
	'Anabel',
	'Antonio',
	'Americo',
	'Amador',
	'Adela',
	'Adolfo',
	'Adriana',
	'Adrian',
	'Aura',
	'Aurelio',
	'Auxiliadora',
	'Aurora'
	);

if(strlen($datosRecibidos)>0){
	for($i=0; $i<count($bancoResultados); $i++) {
		$pedazo=strtolower(substr($bancoResultados[$i],0, strlen($datosRecibidos)));
		//echo strlen($datosRecibidos);
		if(strtolower($datosRecibidos) == $pedazo){
			if ($sugerencia==''){
				$sugerencia=$bancoResultados[$i];
			} else {
				$sugerencia = $sugerencia .', '.$bancoResultados[$i];
			}
		}
	}
}
//Si no hay resultados, debe de salir un mensaje de no coincidencias.
if($sugerencia ==''){
	echo 'No se encontraron coincidencias, lo sentimos.';
} else {
	//Mandar el resultado
	echo $sugerencia;	
}


?>