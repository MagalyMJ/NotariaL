@extends('layouts.homedefault')

@section('content')
    <div class="block_container">
        <div class = "block shadow aling_block">    
            <a href="{{ route('show_all_case_by_progres') }}">
                <div class="module_icon">
                    <img style="width: 150px; margin-left: 50px; height: 150px;" src="{{ asset('img/icons/system/avance.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Avances 
                </h3>
            </a>
        </div>
        <div class = "block shadow aling_block">    
            <a href="{{ route('show_all_case_by_notice') }}">
                <div class="module_icon">
                    <img style="width: 150px;height: 150px;" src="{{ asset('img/icons/system/avisos.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Avisos
                </h3>
            </a>
        </div>
        <div class = "block shadow aling_block">    
            <a href="{{route('Out_Standing_Payments') }}">
                <div class="module_icon">
                    <img style="width: 150px;height:150px;" src="{{ asset('img/icons/system/pendientesdepago.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Pendientes de Pago
                </h3>
            </a>
        </div>
        <div class = "block shadow aling_block"> 
            <a href="{{route('calendar') }}">   
                <div class="module_icon">
                    <img style="width: 150px;height:150px;" src="{{ asset('img/icons/system/agenda.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Agenda
                </h3>
            </a>
        </div>
        <div class = "block disabled  aling_block">    
            <div class="module_icon">
                <img style="width: 150px;height:150px;" src="{{ asset('img/icons/system/comiciones.ico') }}" alt="">
            </div>  
            <h3 class="title_module">
                Comisiones
            </h3>
        </div>
        <div class = "block shadow aling_block">    
           <a href="{{ route('Customer_List') }}">
                <div class="module_icon">
                    <img style="width: 150px;height:150px;" src="{{ asset('img/icons/system/clientes.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Clientes
                </h3>
            </a>
        </div>
    </div>
   
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
@stop