<?php 

?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Registro de asistencias</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="css/icofont.css">
</head>
<body>
<style>
body{ background-color: #ddbfe3;
   background-image:url('images/fondo.png');
   background-repeat: no-repeat;
   background-size: cover;
  
}

.contIzquierda{
   background-color: #492B51; color: #9D7BA0; border-radius: 10px;
   background-image: linear-gradient(to bottom, #492B51, #563153);
   background-image:url('images/waves.png');
   background-repeat: no-repeat;
   background-size: contain;
  background-position: bottom; }
.contDerecha{
   border-radius: 10px;
   background-color: #e7ecf0;
}
#txtDni{ 
   background-color: transparent;
   border: none; color: #fff;
   border-bottom: 2px solid #ffffff8c;
   border-radius: 0;}
#txtDni:focus{box-shadow:none;}
#txtDni::placeholder{color:#9D7BA0}
#btnRegistrar{color: #543052;}
small{font-size: 74%;}
.pPie, .pTiempo{margin-bottom: 0; color: #d0bad2;}
.div1{
   background-color: #492b51; color: #9D7BA0; border-radius: 10px 10px 0 0;
}
.divCabeza, #separador2{background-color: #fff;     border-radius: 10px 10px 0 0; }
#icono{
   color: #d8388a;
}
</style>
<section class="container mt-5">
   <div class="row w-75 mt-5 mx-5 mx-auto d-flex justify-content-around " >
      <div class="col-sm-5 elementoInt p-3 contIzquierda shadow">
         <div class=" w-75 mx-auto ">
            <img src="images/logoBlanco.png" alt="" class="img-fluid py-5 px-2">
            <h4 class="text-center py-3">Control de asistencias</h4>
            <input type="text" class="form-control mx-auto text-center" placeholder="Ingrese su D.N.I." id="txtDni">
            <button class="my-5 btn btn-light btn-block rounded-pill" id="btnRegistrar">Registrar</button>
            <p class="pPie text-center pt-5"><small>Desarrollado por: <a href="https://infocatsoluciones.com" style="color: inherit;">Infocat Soluciones S.A.C. ®</a></small></p>
            <p class=' text-center pTiempo'><small>Versión: 1.0 ~ <?= date('Y');?></small></p>
         </div>
      </div>
      <div class="col-sm-5 p-0 contDerecha shadow">
         <div class="divCabeza">
            <div class="div1">
               <p class="p-3 mb-0"> <i class="icofont-clock-time"></i> <span id="spanFecha"></span></p>
            </div>
            <div class="div2"> <img src="images/path4584.png" class="img-fluid" alt=""></div>
            <div class="d-flex justify-content-center mt-n5 ">
                  <img src="images/infocat.png?v1.1" alt="" class="rounded-circle" >
            </div>
            <h5 class="text-center d-none">Luna Romir</h5>
            <div id="separador2"><img src="images/separador2.png?v=3" class="img-fluid" alt=""></div>
         </div>
         <div class="divCuerpo py-2 text-center">
            <h2 class="display-2 mt-n2 d-none" id="icono"><i class="icofont-check-circled"></i></h2>
           <h5 class="text-muted d-none" id="h5Resultado"></h5>
           <h5 class="text-muted d-none">6:00 p.m.</h5>
         </div>
         
         
      </div>
   </div>
   
</section>
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/moment.js"></script>
<script>
moment.locale('es');
$('#spanFecha').text(moment().format('dddd D/MM/YYYY - h:mm a'));
$("#txtDni").attr('maxlength','12');
setInterval( function(){
   $('#spanFecha').text(moment().format('dddd D/MM/YYYY - h:mm a'));
}, 3000);
$(document).ready(function() {
   moment.locale('es');
   
});
function mifuncion(){ console.log('d')
   //
}
$('#txtDni').keyup(function(e) {
	if($('#txtDni').val().length == 12){ console.log( 'aca' );
		e.preventDefault();  
      e.returnValue = false;
      e.cancelBubble = true;
      return false;
		
	}else{
		if( $('#txtDni').val().length>=8){
			console.log( 5 );
		}
	}
   
});
$('#btnRegistrar').click(function() {
   $.ajax({url: 'php/insertarAsistencia.php', type: 'POST', data: {codigo: $('#txtDni').val() }}).done(function(resp) {
      console.log(resp)
      switch ($.trim(resp)) {
         case 'Revise su DNI':
            $('#h5Resultado').html('<span class="text-danger">'+resp+'</span>').removeClass('d-none');
            break;
         case 'Horario actualizado':
         case 'Ya registraste tu horario':
         case 'Horario registrado':
            $('#icono').removeClass('d-none');
            $('#h5Resultado').html(resp).removeClass('d-none');
            break;
         default:
            break;
      }
   });
});
</script>
</body>
</html>