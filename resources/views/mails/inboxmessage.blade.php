<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Mensaje de Inbox</title>
</head>
<body>
    <p>Un Mensaje ha sido enviado al Inbox con la siguiente informacion:</p>
    <ul>
        <li>Nombre: {{ $inbox['name'] }}</li>
        <li>Telefono de contacto: {{ $inbox['phone'] }}</li>
        <li>Correo de contacto: {{ $inbox['email'] }}</li>
    </ul>
    <p>Mensaje enviado:</p>
    <p> {{ $inbox['message'] }}</p>
</body>
</html>