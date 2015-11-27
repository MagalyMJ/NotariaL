@extends('layouts.homedefault')

@section('content')
    <section id="mainsection" class = "mainsection main_left">
        <div class="block_container">
        <div class = "block shadow aling_block">    
            <div class="module_icon">
                <span class="icon-file-play"></span>
            </div>  
            <h3 class="title_module">
                Avances 
            </h3>
        </div>
        <div class = "block shadow aling_block">    
            <div class="module_icon">
                <span class="icon-bubbles2"></span>
            </div>  
            <h3 class="title_module">
                Avisos
            </h3>
        </div>
        <div class = "block shadow aling_block">    
            <a href="{{route('Out_Standing_Payments') }}">
                <div class="module_icon">
                    <span class="icon-drawer"></span>
                </div>  
                <h3 class="title_module">
                    Pendientes de Pago
                </h3>
            </a>
        </div>
        <div class = "block shadow aling_block">    
            <div class="module_icon">
                <span class="icon-address-book"></span>
            </div>  
            <h3 class="title_module">
                Agenda
            </h3>
        </div>
        <div class = "block shadow aling_block">    
            <div class="module_icon">
                <span class="icon-address-book"></span>
            </div>  
            <h3 class="title_module">
                Comisiónes
            </h3>
        </div>
        <div class = "block shadow aling_block">    
            <div class="module_icon">
                <span class="icon-folder-open"></span>
            </div>  
            <h3 class="title_module">
                Terceros
            </h3>
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