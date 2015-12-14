@extends('layouts.default')

@section('content')
<div class="center ags_backgraund">
  <div class="login">
  <div class="top">
  
   <h2>Notaría 55 Publica</h2>
   <h4 class="tiny">Lic. Adrián Ventura Dávila</h4>
   
  </div>

  <div class="middle">
     @if($errors->has())
    <div>
      <ul>
        @foreach($errors->all() as $error)
         <li class="error">{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif  
    <form action="{{ route('auth_store_path') }}" method='post'> 
      {{csrf_field()}}
      <label for="username">Username</label> 
      <input class="input login-input" id="username" name="user_name" type="text" autocomplete="off" /> 
      <label for="password">Password</label> 
      <input class="input login-input" id="password" name="password" type="password" /> 
      <input type="submit" class="input login-button" value="Log-In">
    </form>
  </div>
  <div class="bottom">
    <span>Lion Systems Solutions</span>
  </div>
  </div>
</div>
@stop