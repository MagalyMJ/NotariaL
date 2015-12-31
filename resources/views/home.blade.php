@extends('layouts.homedefault')

@section('content')
    <section id="mainsection" class = "mainsection main_left">
        <div class="block_container">
        <div class = "block shadow aling_block">    
            <a href="{{ route('show_all_case_by_progres') }}">
                <div class="module_icon">
                    <img style="width: 150px; margin-left: 50px; height: 150px;" src="{{ asset('img/icons/avance.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Avances 
                </h3>
            </a>
        </div>
        <div class = "block shadow aling_block">    
            <a href="{{ route('show_all_case_by_notice') }}">
                <div class="module_icon">
                    <img style="width: 150px;height: 150px;" src="{{ asset('img/icons/avisos.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Avisos
                </h3>
            </a>
        </div>
        <div class = "block shadow aling_block">    
            <a href="{{route('Out_Standing_Payments') }}">
                <div class="module_icon">
                    <img style="width: 150px;height:150px;" src="{{ asset('img/icons/pendientesdepago.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Pendientes de Pago
                </h3>
            </a>
        </div>
        <div class = "block disabled aling_block">    
            <div class="module_icon">
                <img style="width: 150px;height:150px;" src="{{ asset('img/icons/agenda.ico') }}" alt="">
            </div>  
            <h3 class="title_module">
                Agenda
            </h3>
        </div>
        <div class = "block disabled  aling_block">    
            <div class="module_icon">
                <img style="width: 150px;height:150px;" src="{{ asset('img/icons/comiciones.ico') }}" alt="">
            </div>  
            <h3 class="title_module">
                Comisiones
            </h3>
        </div>
        <div class = "block shadow aling_block">    
           <a href="{{ route('Customer_List') }}">
                <div class="module_icon">
                    <img style="width: 150px;height:150px;" src="{{ asset('img/icons/clientes.ico') }}" alt="">
                </div>  
                <h3 class="title_module">
                    Clientes
                </h3>
            </a>
        </div>
        </div>
    </section>
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