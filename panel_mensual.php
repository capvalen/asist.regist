<?php 
date_default_timezone_set('America/Lima');

if (!isset($_COOKIE['ckUsuario'])){
   header("Location: index.php");
	die();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Panel de Control de asistencias</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="css/bootstrap-material-datetimepicker.css">
   <link rel="stylesheet" href="css/icofont.css">
</head>
<body>
<header>
<style>
.jumbotron{margin-bottom: 0;
background-color: #fff;}
.jumbotron-heading {
    font-weight: 300;
}
.jumbotron .container{
   max-width: 40rem;
}
.bg-dark {
    background-color: #8b3ac1!important;
}
.text-muted {
    color: #dadada!important;
}
button:focus{
	outline: 5px auto #eee;
}
</style>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
			<div class="col-md-2">
				<img src="images/infocat.png" alt="" class="img-fluid">
			</div>
        <div class="col-sm-8 col-md-5 py-4">
          <h4 class="text-white">Infocat Soluciones S.A.C.</h4>
          <p class="text-muted">Sistema creado para Perucash <br> Versión 1.0</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contacto</h4>
          <ul class="list-unstyled">
            <li><a href="https://infocatsoluciones.com" class="text-white">Página web</a></li>
            <li><a href="https://www.facebook.com/infocat.soluciones/" class="text-white">Facebook</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
   <div class="container d-flex">
      <div class="flex-grow-1">
			<a href="#" class="navbar-brand d-flex align-items-center">
				<i class="icofont-server"></i> <strong class="pl-3">Control de asitencias</strong>
			</a>
			</div>
			<button class="navbar-toggler ml-2" type="button" id="btnListarPersonal" title="Listar personal" >
     		   <span><i class="icofont-list"></i></span>
			</button>
			<button class="navbar-toggler ml-2" type="button" id="btnNuevoPersonal" title="Agregar personal" >
			<span><i class="icofont-contact-add"></i></span>
			</button>
			<a href="paneljunto.php" title="Reporte mensual"><i class="icofont-address-book"></i></a>
			<button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
				<span><i class="icofont-toy-cat"></i></span>
			</button>
   	</div>
  	</div>
	</div>
</header>
<main>
<section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Reporte mensual</h1>
      <div class="form-inline d-flex justify-content-center">
			<select name="" id="input" class="form-control" required="required" id="sltUsuarios">
				<?php include 'php/optListarUusuarios.php'; ?>
			</select>
			<input type="text" class="form-control text-center" id="txtFechaFiltro">
			<button class="btn btn-outline-primary ml-3" id="btnFiltrarReporte"><i class="icofont-search-2"></i> Filtrar</button>
		</div>
    </div>
  </section>
	<section class="container-fluid">
		<div class="table-responsive">
		<table class="table table-hover">
		<thead>
			<tr>
				<th>N°</th>
				<th>Nombres</th>
				<th>Entrada día</th>
				<th>Salida día</th>
				<th>Entrada tarde</th>
				<th>Salida noche</th>
			</tr>
		</thead>
		<tbody id="tbodyRegistros">

		</tbody>
		</table>
		</div>
	</section>
</main>




<div class="modal" id="modalNuevoPersonal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<p>D.N.I.</p>
				<input type="text" class="form-control" id="txtDniPers">
				<p>Nombres</p>
				<input type="text" class="form-control" id="txtNombrePers">
				<p>Apellidos</p>
				<input type="text" class="form-control" id="txtApellidoPers">
      </div>
      <div class="modal-footer">
				<label for="" class="text-danger d-none" id="lblError"><i class="icofont-cat-alt-3"></i> <span></span></label>
				<label for="" class="text-success d-none" id="lblExito"><i class="icofont-fish-5"></i> <span></span></label>
        <button type="button" class="btn btn-outline-primary" id="btnGuardarPersona"><i class="icofont-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modalListadoPersonal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Listado de personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>N°</th>
								<th>Apellidos y Nombres</th>
								<th>DNI</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							<?php require 'php/listarPersonal.php'; ?>
						</tbody>
					</table>
				</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" id="btnGuardarPersona"><i class="icofont-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modalBorrarPersonal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<p>¿Está seguro que desea borrar a: <strong id="strNombre"></strong>?</p>
      </div>
      <div class="modal-footer">				
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal" id="btnCancelarBorrar"><i class="icofont-save"></i> Cancelar</button>
        <button type="button" class="btn btn-outline-danger" id="btnBorrarPersona"><i class="icofont-save"></i> Borrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/moment.js"></script>
<script src="js/bootstrap-material-datetimepicker.js?version=1.3"></script>
<script>
//$('txtFechaFiltro').bootstrapMaterialDatePicker('setDate', moment());
$('#txtFechaFiltro').bootstrapMaterialDatePicker({ format : 'YYYY-MM', lang : 'es', weekStart : 1 , time: false});


//$('#txtFechaFiltro').val('<?= date('Y-m-d');?>');
$.ajax({url: 'php/listarRegistrosPorFecha.php', type: 'POST' }).done(function(resp) {
	//console.log(resp)
	$('#tbodyRegistros').html(resp);
	$.ajax({url: 'php/listarRegistrosInternos.php', type: 'POST'}).done(function(resp) {
		var data = JSON.parse(resp);
		//console.log(data)
		$.each( data, function (i, elem) {
			//console.log(elem.idUsuario)
			$(`tr[data-user=${elem.idUsuario}] td[data-reg="${elem.idHorario}"]`).text(moment(elem.regHora, 'HH:mm:ss').format('h:mm a'))
		});
	});
});
$('#btnFiltrarReporte').click(function() {
	var fecha = moment($('#txtFechaFiltro').val(), 'YYYY-MM-DD');
	if( $('#sltUsuarios').val()!=-1 ){

	}else if( fecha.isValid() ){
		$.ajax({url: 'php/listarRegistrosPorFecha.php', type: 'POST', data:{fecha: $('#txtFechaFiltro').val()} }).done(function(resp) {
	//console.log(resp)
	$('#tbodyRegistros').html(resp);
	$.ajax({url: 'php/listarRegistrosInternos.php', type: 'POST', data:{fecha: $('#txtFechaFiltro').val()} }).done(function(resp) {
		var data = JSON.parse(resp);
		//console.log(data)
		$.each( data, function (i, elem) {
			//console.log(elem.idUsuario)
			$(`tr[data-user=${elem.idUsuario}] td[data-reg="${elem.idHorario}"]`).text(moment(elem.regHora, 'HH:mm:ss').format('h:mm a'))
		});
	});
});
	}
});
$('#btnListarPersonal').click(function() {
	$('#modalListadoPersonal').modal('show');
});
$('#btnNuevoPersonal').click(function() {
	$('#modalNuevoPersonal').modal('show');
});
$('#btnGuardarPersona').click(function() {
	$('#lblExito').addClass('d-none');
	$('#lblError').addClass('d-none');

	if( $('#txtDniPers').val()=='' || $('#txtNombrePers').val()=='' || $('#txtApellidoPers').val()=='' ){
		$('#lblError').removeClass('d-none').find('span').text('Debe rellenar todos los campos obligatorio');
	}else{
		$('#lblExito').addClass('d-none');
		$('#lblError').addClass('d-none');
		$.ajax({url: 'php/crearPersonal.php', type: 'POST', data: {dni: $('#txtDniPers').val(), apellido: $('#txtApellidoPers').val(), nombre: $('#txtNombrePers').val() }}).done(function(resp) {
			console.log(resp)
			if($.trim(resp)=='todo ok'){
				//$('#modalNuevoPersonal').modal('hide');
				$('#modalNuevoPersonal input').val('');
				$('#lblExito').removeClass('d-none').find('span').text('Registro guardado con éxito');
			}else{
				$('#lblError').removeClass('d-none').find('span').text('Hubo un error interno, comunícalo a soporte informático');
			}
		});
	}
});
function removerPersonal(idEmple){
	$.idEmple = idEmple;
	var nombre = $(`td[data-id="${idEmple}"]`).text();
	$('#strNombre').text(nombre);
	$('#modalListadoPersonal').modal('hide');
	$('#modalBorrarPersonal').modal('show');
}
$('#btnBorrarPersona').click(function() {
	$.ajax({url: 'php/borrarPersonal.php', type: 'POST', data: { idUser: $.idEmple }}).done(function(resp) {
		if($.trim(resp)=='todo ok'){
			location.reload();
		}
	});
});
</script>
</body>
</html>