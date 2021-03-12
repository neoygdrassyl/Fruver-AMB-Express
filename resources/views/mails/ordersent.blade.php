<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Orden de envio</title>
</head>
<body>
    <p>Hola! </p>
    <p>Este es un mensaje de Fruver Express AMB de confirmacion de tu pedido.</p>
    <p>Estos son los datos del usuario que ha realizado el pedido:</p>
    <ul>
        <li>Nombre: {{$order['client']->nombre}} {{$order['client']->apellido}}</li>
        <li>Telefono de contacto: {{$order['client']->telefono }}</li>
        <li>Direccion de envio: {{$order['client']->direccion}}, {{$order['client']->ciudad}}</li>
    </ul>
    <p>Este es el pedido solicitado:</p>
    <ul>
        @foreach ($order['content'] as $item)
            <li>
                {{$item->nombre}} x{{$item->cantidad}} {{$item->unidad}} {{$item->precio * $item->cantidad}}
            </li>
        @endforeach 
        <br>
        <li>
            Subtotal: {{$order['subtotal']}}
         </li>
        <li>
           Costo de Envio: {{$order['sendCost']}}
        </li>
        <li>
            Total: {{ (int)$order['subtotal'] + (int)$order['sendCost'] }}
         </li>
          
    </ul>

    @if ($order['client']->anotaciones != '')
        <p>Adicionalmente usted ha enviado unas anotaciones y detalles con el pedido:</p>
    <ul>
        <li>{{$order['client']->anotaciones}}</li>
    </ul>
    @endif
    <p>En estos momentos su pedido esta siendo procesado para su envio, este atento a nuevas indicaciones.</p>
</body>
</html>