@extends('layouts.app')

@section('content')
<br><br>
<div class="container">
  <div class="card mb-3">
    <img class="card-img-top" src="\assets\fruver-img\LOGO.png" alt="Card image cap">
    <div class="card-body">
      <hr>
      <h2 class="card-title">ADMINISTRACION DE PRODUCTOS</h2>
      <hr>
      <p class="card-text">Listado de productos a ofrecer al publico.</p>
      <p class="card-text">ACCIONES: <i class="fas fa-plus-square"></i> Añadir producto, <i class="fas fa-edit"></i> Actualizar Producto, <i class="fas fa-trash-alt"></i> Eliminar Producto, <i class="fas fa-eye"></i> / <i class="fas fa-eye-slash"></i> Mostrar/Ocultar Producto de la vista publica. </p>
      <p class="card-text"><small class="text-muted">Es recomendado no eliminar productos como primera alternativa, se recomienda la opcion de Mostrar/Ocultar. Si se elimina un producto este a su vez afectara las Ordenes de Envio. Cuando se actualiza un producto, si no se elije una nueva imagen, esta no cambiara.</small></p>
    </div>
  </div>
</div>
<div class="container">
    <admin-component user_rol={{ Auth::user()->rol}}></admin-component>
</div>
@endsection