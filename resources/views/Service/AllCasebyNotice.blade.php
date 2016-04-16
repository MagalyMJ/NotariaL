@extends('layouts.homedefault')

@section('content')
<!-- Mostrara Todos los Casos Activos 
	Parametros: Objeto Service encotrado por id, Array CaseService filtrado por atributo service_id,
-->
	<div class="block_container">
		
		<section class="title_continer">
			<img class="title_icon" src="{{ asset('img/icons/system/avisos.ico') }}" alt=""> 
			<h1>Avisos</h1>
		</section>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="text-center"> Nº Trámite
						<!-- Buscador por Folio -->
						{!! Form::open(array('route' =>'show_all_case_by_notice','method' => 'Get','class' => 'form_search')) !!}
							
							{!! Form::number('id',null,['class' => 'form_input_search small' ,'placeholder' => 'Id' ]) !!}
							
						{!! Form::close() !!}
						</th>
						<th class="text-center th_medium">  Nº Escritura
						<!-- Buscador por Numero de Escritura -->
						{!! Form::open(array('route' =>'show_all_case_by_notice','method' => 'Get','class' => 'form_search')) !!}
							
							{!! Form::number('N_write',null,['class' => 'form_input_search small' ,'placeholder' => 'Nº Escritura' ]) !!}
							
						{!! Form::close() !!}
						</th>
						<th class="text-center"> Avance
							<!-- Buscador por Avance Registrado -->
						{!! Form::open(array('route' =>'show_all_case_by_notice','method' => 'Get','class' => 'form_search')) !!}
							{!! Form::number('progress_Select',null,['class' => 'form_input_search small' ,'placeholder' => 'Avance' ]) !!}
							<!-- {!! Form::select('progress_Select', array('' => null, 1=>'0', 2=>'10', 3=>'25', 4=>'33', 5=>'50', 6=>'66', 7=>'75', 8=>'99', 9=>'100'), '', ['class' => 'form_input_search small']) !!} -->
						{!! Form::close() !!}

						</th>
						<th class="text-center th_big"> Cliente
							<!-- Buscador por Nombre o apellidos -->
						{!! Form::open(array('route' =>'show_all_case_by_notice','method' => 'Get','class' => 'form_search')) !!}
							
							{!! Form::text('FullName_write',null,['class' => 'form_input_search th_medium' ,'placeholder' => 'Nombre o Apellido' ]) !!}
							
						{!! Form::close() !!}
						</th>
						<th class="text-center">Trámite</th>
						<th class="text-center">Avisos</th>
						<th class="text-center">Detalles</th>


					</tr>
				</thead>
				<tbody class="table-hover">
					
					@foreach ($cases_services as $case_service)
    					<tr>
    						<td class="text-center"> {{ $case_service->id }} </td>
                			<td class="text-center"> {{ $case_service->N_write}} </td>
    						<td class="text-center"> {{ $case_service->progress }} %</td>
							<td class="text-center"> 
								@foreach($case_service->customer->all() as $customerCase )
    								{{ $customerCase->name." ".$customerCase->fathers_last_name." ".$customerCase->mothers_last_name }} 
    								<br>
								@endforeach
							</td>
    						<td class="text-center"> {{ $case_service->service->name }} </td>
    						<td class="text-center"> {{ $case_service->notices }} aviso</td>
    						<td class="text-center"> 
    							<a class="budget-button button_normal" href="{{route('Show_Case_path',$case_service->id) }}">
    								<img class="title_icon" src="{{ asset('img/icons/system/detalle_de_Tramite.ico') }}" alt="Detalles">
        							<p>Detalles</p>
    							</a>
    						</td>
    					</tr>
    				</a>
					@endforeach
				</tbody>
				</table>
			</div>
@stop