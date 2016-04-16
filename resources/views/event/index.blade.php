@extends('layouts.homedefault')

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

	 <div class="block_container">
		<section class="title_continer">
			<img class="title_icon" src="{{ asset('img/icons/system/agenda.ico') }}" alt=""> 
			<h1>Agenda</h1>
		</section>
		<section class = "action_buttons">
			
			<a class="button button_normal" href="{{route('new_event') }}">
				<img class="title_icon" src="{{ asset('img/icons/system/nuevotramite.ico') }}" alt="Nuevo Tramite">
				<p>Nuevo Evento</p>
				
		    </a>
		    <a class="button button_normal" href="{{route('events_list') }}">
				<img class="title_icon" src="{{ asset('img/icons/system/generales_Presupuesto.ico') }}" alt="Nuevo Tramite">
				<p>Listado</p>

		    </a>
				  
		</section>

	 	{!! $calendar->calendar() !!}
    	{!! $calendar->script() !!}
	 
	 </div>
@stop