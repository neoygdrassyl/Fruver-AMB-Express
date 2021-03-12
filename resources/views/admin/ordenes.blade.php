@extends('layouts.app')

@section('content')    
<br><br>
<div class="container">
    <div class="card mb-3">
      <img class="card-img-top" src="\assets\fruver-img\LOGO.png" alt="Card image cap">
      <div class="card-body">
        <hr>
        <h2 class="card-title">ORDENES DE ENVIO</h2>
        <hr>
        <p class="card-text">Lisado de las ordenes de envio generadas por los clientes.</p>
        <p class="card-text">ACCIONES: <i class="fas fa-eye"></i> Ver Orden, <i class="fas fa-search"></i> Buscar Orden </p>
        <p class="card-text"><small class="text-muted">Para buscar las ordenes de venta de forma 
          anual o mensual, se debe escribir el rango de la fecha en formato YYYY-MM. Si se desea buscar 
          solo por año se debe user YYYY- y si es solo por mes se debe user -MM-.
          Se puede añadir el dia igualmnte de forma YYYY-MM-DD.</small> </p>
      </div>
    </div>
</div>
<div class="container">
    <orders-component></orders-component>
</div>
@endsection