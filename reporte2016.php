<?php
header('Content-Type: text/html; charset=utf8');
require_once("conexion.php"); 

	$sql="CALL empleados_pormes ('".$_GET['ano']."', '".$_GET['mes']."', '".$_GET['empresa']."')";
	//$sql="CALL empleados_pormes ('2014', '12','3')";
	//$sql="CALL proce1('dasdas')";
	if(!$result = mysqli_query($conexion, $sql)) die();
	
	$rawdata = array(); //creamos un array
 
    //guardamos en un array multidimensional todos los datos de la consulta
    $i=0;
    $idtabla="";

    while($row = mysqli_fetch_array($result))
    {
        $rawdata[$i] = $row;
        //echo $rawdata[$i]['Nombre'] . '</br>';
        echo '<li class="liempleado" id="'.$rawdata[$i]['idusuario'].'">
      <div class="collapsible-header" ><i class="material-icons">whatshot</i>'. ($i+1) . '. '.utf8_encode($rawdata[$i]['Nombre']).'<span id="idusuario" class="hide"></span></div>
      <div class="collapsible-body">
      	<!--Inicio de la tabla-->
		      <div class="row"><div class="col s12 m10 push-m1">
		      <table class="highlight">
		        <thead>
		          <tr>
		              <th data-field="id">Día</th>
		              <th data-field="name">Mañanas</th>
		              <th data-field="price">Tardes</th>
		              <th data-field="price">Tardanzas</th>
		          </tr>
		        </thead>

		        <tbody  id="tablita'.$rawdata[$i]['idusuario'].'">
		          
		        </tbody>
		      </table></div></div><!--Fin de la tabla-->
      <div class="container center-align"><a class="waves-effect waves-light indigo btn botin" id="'.$rawdata[$i]['idusuario'].'"><i class="material-icons right">play_arrow</i>Exportar</a></div></br>
      </div>      
    </li>';
        $i++;
		
	}
	mysqli_close($conexion); //desconectamos la base de datos
	 
	//llamada por fila y encabezado:
	//echo $rawdata[0]['Nombre'];
	 
	//mostrar todo:
	
	//echo json_encode($rawdata);

?>