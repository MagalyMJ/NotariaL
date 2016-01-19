@extends('layouts.homedefault')

@section('content')
	<div class="block_container">
			
        <section class="title_continer">
            <img class="title_icon" src="{{ asset('img/icons/system/agenda.ico') }}" alt=""> 
        <h1> Listado de Eventos</h1>    
        </section>
		<table id="event_table" class="table-fill">
        <thead>
          <tr>

            <th class="text-center">#</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Titulo</th>
            <th class="text-center" style="padding-left: 100px;padding-right: 100px;">Fecha</th>
            <th class="text-center ">Observaciones</th>
            <th class="text-center "> Actions </th>
          </tr>
        </thead>
        <tbody id="body_table" class="table-hover">
        
         {{csrf_field()}}

          @foreach ($events as $event)
              <tr>
                <td class="text-center"> {{ $event->id  }} </td>
                <td class="text-center"> {{ $event->name  }} </td>
                <td class="text-center"> {{ $event->title }} </td>
                <td class="text-center"> {{ $event->start }} </td>
                <td class="text-center"> {{ $event->observations}} </td>
			
                <td class="text-center"> 
                  <a class="budget-button button_normal" href="{{route('edit_event',$event->id) }}" >
                    <img class="title_icon" src="{{ asset('img/icons/system/edit.ico') }}" alt="Editar">
                    <p>Editar</p>
                  </a>
                   <a class="budget-button button_normal" href="{{route('destroy_event',$event->id) }}"  >
                    <img class="title_icon" src="{{ asset('img/icons/system/cancel.ico') }}" alt="Eliminar">
                    <p>Eliminar</p>
                  </a>
                </td>

              </tr>
          @endforeach
	</div>
@stop