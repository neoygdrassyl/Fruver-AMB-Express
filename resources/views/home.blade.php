@extends('layouts.app')

@section('content')
<div class="container">
    <br><br><br>
    <div class="jumbotron">
        <h1 class="display-4">MODULO DE ADMINISTRACION</h1>
        <p class="lead"></p>
        <hr class="my-4">
        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <img src="assets\fruver-img\LOGO.png" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Administrar Productos</h5>
                      <hr>
                      <p class="card-text">Ver los productos en venta, añadir nuevos productos, modificar sus caracteristicas o eliminarlos de la base de datos.</p>
                      <p class="card-text"><small class="text-muted">ACCESO: <i class="fas fa-users"></i> Administrador, Vendedor</small></p>
                      <a href="admin/productos" class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i> Continuar</a>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="card">
                    <img src="assets\fruver-img\LOGO.png" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Resgistro de Ordenes de Venta</h5>
                      <hr>
                      <p class="card-text">Ver las ordenes de venta generadas por los clientes de forma diaria, semanal, mensual o anual.</p>
                      <p class="card-text"><small class="text-muted">ACCESO: <i class="fas fa-users"></i> Administrador, Vendedor</small></p>
                      <a href="/admin/ordenes" class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i> Continuar</a>
                    </div>
                  </div>
            </div>
          </div>
          @if( Auth::user()->rol == 1 )
            <div class="row">
            <div class="col-6">
                <div class="card  mb-2">
                    <img src="assets\fruver-img\LOGO.png" class="" alt="..." >
                    <div class="card-body">
                      <h5 class="card-title">Aministrar Usuarios</h5>
                      <hr>
                      <p class="card-text">Ver los usuarios creados para la tienda, cambiar sus caracteristicas o eliminar el usuario. </p>
                      <p class="card-text"><small class="text-muted">ACCESO: <i class="fas fa-users"></i> Administrador</small></p>
                      <a href="/admin/users" class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i> Continuar</a>
                    </div>
                  </div>
                </div>
                  <div class="col-6">
                  <div class="card">
                    <img src="assets\fruver-img\LOGO.png" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Auditoria</h5>
                      <hr>
                      <p class="card-text">Ver todos los cambios y acciones realizadas por lo usuaios en la tienda.</p>
                      <p class="card-text"><small class="text-muted">ACCESO: <i class="fas fa-users"></i> Administrador</small></p>
                      <a href="/admin/audit" class="btn btn-primary"><i class="fas fa-chevron-circle-right"></i> Continuar</a>
                    </div>
                  </div>
            </div>
        </div>
        @endif
      </div>
</div>
@endsection
