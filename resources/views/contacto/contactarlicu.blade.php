<!DOCTYPE html>
<html>
<head>
    <h1>Mensaje recibido desde el Portal Escolar CUH</h1>
</head>
<body>
    <p><strong>LICENCIATURA</strong></p>
    <p><strong>Recibiste un mensaje de: </strong> {{ $msg['name']}} </p>
    <p><strong>Relacionado a: </strong> {{ $msg['subject']}} </p>
    <p><strong>Con el siguiente Mensaje: </strong>{{ $msg['message']}}</p>
    <p><strong>Deja como medio de contacto el Correo: </strong>{{ $msg['email']}}</p>
    <br>
    <p><i>Mensaje enviado a través del usuario con matricula </i><strong>{{ Auth::user()->cuenta }}</strong>
</body>
</html>