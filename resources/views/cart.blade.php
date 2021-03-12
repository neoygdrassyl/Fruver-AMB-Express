@extends('layouts.app')

@section('content')
<br>
<div class="fluid" id="title">
  <div class="card text-white bg-primary mb-1">
    <img class="card-img-top" src="\assets\fruver-img\LOGO.png" alt="Card image cap" width="600" height="420">
    <br>
  </div>
</div>
<div class="container" id="carrito">
  <cart-component></cart-component>
</div>

@endsection