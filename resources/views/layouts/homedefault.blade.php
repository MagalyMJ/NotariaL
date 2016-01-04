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
                <img class="menu_service_img" src="{{ asset('img/icons/system/home.ico') }}" alt="">
                <p>HOME</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/1')}}">
                <img class="menu_service_img" src="{{ asset('img/icons/services/testamento.ico') }}" alt="">
                <p>Testamento</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/2')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/compra_Venta.ico') }}" alt="">
                <p>Contrato Compra Venta</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/3')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/donaciones.ico') }}" alt="">
                <p>Donaciones</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/4')}}">
                <img class="menu_service_img" src="{{ asset('img/icons/services/acta_Constitutiva.ico') }}" alt="">
                <p>Acta Constitutiva</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/5')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/contrato_Mutuo.ico') }}" alt=""> 
                <p>Contrato mutuo con Interés y Garantía Hipotecaria</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/6')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/cancelacion_Hipoteca.ico') }}" alt=""> 
                <p>Cancelacion de Hipoteca</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/7')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/poder_General.ico') }}" alt="">  
                <p>Poder general</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/8')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/sucesion_Intestamentaria.ico') }}" alt="">  
                <p>Sucesiónes Intestamentaría</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/9')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/sucesion_Testamentaria.ico') }}" alt="">   
                <p>Sucesiónes Testamentaria</p>
            </a>
        </il>
        <il class="menu_service">
             <a class="menu_service_link" href="{{url('servicio/10')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/capitulaciones_Matrimoniales.ico') }}" alt="">     
                <p>Capitulaciones Matrimoniales</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/11')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/fe_de_Hechos.ico') }}" alt="">       
                <p>Fe de Hechos</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/12')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/rebocacion_de_Poder.ico') }}" alt="">        
                <p>Revocación de Poder</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/13')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/adjudicacion_Testamentaria.ico') }}" alt="">         
                <p>Adjudicación Testamentaria</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/14')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/reconocimiento_Herencia.ico') }}" alt="">         
                <p>Reconocimiento y Aceptación de Herencia</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/15')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/cotejo_y_Certificacion.ico') }}" alt="">         
                <p>Cotejo y Certificación</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/16')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/protocolizacion_Asamblea.ico') }}" alt="">         
                <p>Protocolización de Acta de Asamblea</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/17')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/protocolizacion_Subdivision.ico') }}" alt="">         
                <p>Protocolización de Subdivisión</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/18')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/dacion_en_Pago.ico') }}" alt="">         
                <p>Dacion en Pago</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/19')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/permutas.ico') }}" alt="">         
                <p>Permutas</p>
            </a>
        </il>
        <il class="menu_service">
            <a class="menu_service_link" href="{{url('servicio/20')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/adjudicacion_Judicial.ico') }}" alt="">          
                <p>Adjudicación Judicial</p>
            </a>
        </il>
        <il class="menu_service">
           <a class="menu_service_link" href="{{url('servicio/21')}}">
                <img class="menu_service_img"  src="{{ asset('img/icons/services/cotejo_y_Ratificacion.ico') }}" alt="">           
                <p>Cotejo y Ratificacion</p>
            </a>
        </il>
    </ul>
  <section id="mainsection" class = "mainsection main_left background">
    
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