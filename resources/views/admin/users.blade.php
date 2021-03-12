@extends('layouts.app')

@section('content')
<br><br>
<div class="container">
  <div class="card mb-3">
    <img class="card-img-top" src="\assets\fruver-img\LOGO.png" alt="Card image cap">
    <div class="card-body">
      <hr>
      <h2 class="card-title">ADMINISTRACION DE USUARIOS</h2>
      <hr>
      <p class="card-text">Listado de usuarios con nivel de acceso a la aplicacion. </p>
      <p class="card-text">ACCIONES: <i class="fas fa-plus-square"></i> Añadir Usuario, <i class="fas fa-edit"></i> Actualizar Usuario,  <i class="fas fa-trash-alt"></i> Eliminar Usuario. </p>
      <p class="card-text"><small class="text-muted">Es recomendado que solo exista un solo administrador, 
        un administrador puede cambiar el Rol de otro administrador y de si mismo.
        Cuando se actualiza un usuario, si su contraseña no se cambia, esta permanecera sin cambios.</small></p>
    </div>
  </div>
</div>
<div class="container">
    <users-component></users-component>
</div>
@endsection
