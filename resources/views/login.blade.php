@extends('layouts.default')

@section('content')
<div class="center">
  <div class="login">
  <div class="top">
  
   <h2>Notaría 55 Publica</h2>
   <h4 class="tiny">Lic. Adrián Ventura Dávila</h4>
   
  </div>
  <div class="middle">
    <form action="{{ route('auth_store_path') }}" method='post'> 
      {{csrf_field()}}
      <label for="username">Username</label> 
      <input class="input login-input" id="username" name="username" type="text" autocomplete="off" /> 
      <label for="password">Password</label> 
      <input class="input login-input" id="password" name="password" type="password" /> 
      <input type="submit" class="input login-button" value="Log-In">
    </form>
  </div>
  <div class="bottom">
    <span>Copyright &copy; All Rights Reserved.</span>
  </div>
  </div>
</div>
@stop