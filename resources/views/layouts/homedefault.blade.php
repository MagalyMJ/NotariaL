<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Mobile Specific Metas
 ================================================== --> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- CSS
  ================================================== -->

  <link rel="stylesheet" href="{{ asset('css/all.css')}}">

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

<!-- Favicons
  ================================================== -->
	<title>Notaria</title>
</head>
<body>
  <div id="detection">
        
    </div>
    <ul id="menu_services"  class = "menu_services">
        <il class="menu_service">
            <a class="menu_service_link" href="{{route('home') }}">
                <span class=" icon icon-home"></span>  
                <p>HOME</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/1')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Testamento</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/2')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Contrato Compra Venta</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/3')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Donaciones</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/4')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Acta Constitutiva</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/5')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Contrato mutuo con Interés y Garantía Hipotecaria</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/6')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Cancelacion de Hipoteca</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/7')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Poder general</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/8')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Sucesiónes Intestamentaría</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/9')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Sucesiónes Testamentaria</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/10')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Capitulaciones Matrimoniales</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/11')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Fe de Hechos</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/12')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Revocación de Poder</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/13')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Adjudicación Testamentaria</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/14')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Reconocimiento y Aceptación de Herencia</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/15')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Cotejo y Certificación</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/16')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Protocolización de Acta de Asamblea</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/17')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Protocolización de Subdivisión</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/18')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Dacion en Pago</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/19')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Permutas</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/20')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Adjudicación Judicial</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/21')}}">
                <span class=" icon icon-file-text"></span>  
                <p>Cotejo y Ratificacion</p>
            </a>
        </il>
    </ul>
  <section id="mainsection" class = "mainsection main_left">
   

	 @yield('content')

 </section>
     
 
</body>
<script>
    document.getElementById("detection").onmouseover =function(){
      document.getElementById("mainsection").classList.remove("main_left")
      document.getElementById("mainsection").classList.add("main_left2")
    };
    document.getElementById("mainsection").onmouseover =function(){
      document.getElementById("mainsection").classList.remove("main_left2")
      document.getElementById("mainsection").classList.add("main_left")
    };
  </script>
</html>