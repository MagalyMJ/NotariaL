@extends('layouts.homedefault')

@section('content')

<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script type="text/javascript">
$(function () {
    $('input[name="time"]').daterangepicker({
        // "minDate": moment('<?php echo date('Y-m-d G')?>'),
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 15,
        "autoApply": true,
         "singleDatePicker":true,
        "locale": {
            "format": "YYYY-MM-DD HH:mm:ss",
            "separator": " - ",
        }
    });
});
</script>

     <div class="block_container">

        <section class="title_continer">
            <img class="title_icon" src="{{ asset('img/icons/system/agenda.ico') }}" alt=""> 
        <h1> Nuevo evento</h1>    
        </section>
            <form id="new_event_form" action="{{route('store_event') }}" method='post' class="form_data">  
                {{csrf_field()}}
                <div class="formborder form_data_general">
                    <div>
                        <label for="name">Nombre</label> 
                        <input name="name" class="input long" id="name" type="text" autocomplete="off" value="" />
                
                        <label for="title">Titulo</label> 
                        <input name="title" class="input long" id="title" type="text" autocomplete="off" value="" />
                        
                        <label for="id_time">Tiempo</label> 
                        <input name="time" id="id_time" class="input long" >
                    </div>
                    <section class = "action_buttons">  
                        <button type="submit"  class="budget-button button_normal" style="margin: 0px;"> 
                          <img class="title_icon" src="{{ asset('img/icons/system/check.ico') }}" alt="Guardar">
                          <p>Guardar</p>
                        </button>

                        <a class="budget-button button_normal" href="{{route('calendar') }}" style=" margin-top: 0px;"> 
                          <img class="title_icon" src="{{ asset('img/icons/system/cancel.ico') }}" alt="Cancelar">
                          <p> Cancelar </p>
                       </a>
                    </section>
                </div>
        </form>
        
     </div>
@stop