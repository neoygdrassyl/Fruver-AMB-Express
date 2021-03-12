@extends('layouts.app')

@section('content')
<br><br>
<div class="container">
  <div class="card mb-3">
    <img class="card-img-top" src="\assets\fruver-img\LOGO.png" alt="Card image cap">
    <div class="card-body">
      <hr>
      <h2 class="card-title">AUDITORIAS</h2>
      <hr>
      <p class="card-text">Lisado de los movimientos realizados por los usuarios en la aplicacion.</p>
      <p class="card-text">ACCIONES: <i class="fas fa-search"></i> Buscar Auditoria </p>
      <p class="card-text"><small class="text-muted">La auditorias se generan de forma automatica cuando alguna 
        accion es realizada. Las auditorias no pueden ser eliminadas por ningun usuario. Para buscar 
        auditorias de forma anual o mensual, se debe escribir el rango de la fecha en formato YYYY-MM. 
        Si se desea buscar solo por año se debe user YYYY- y si es solo por mes se debe user -MM-. 
        Se puede añadir el dia igualmnte de forma YYYY-MM-DD.</small></p>
    </div>
  </div>
</div>
<div class="container">
    <audit-component></audit-component>
</div>
@endsection