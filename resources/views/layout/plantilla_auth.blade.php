<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autenticación</title>
    @vite(['resources/css/general.css','resources/css/plantilla_auth.css'])
</head>
<body>
    <div class="contenedor">
        <div class="logo">
            <img src="https://construyendosonrisascr.com/wp-content/uploads/2020/08/logocs.png" alt="">
        </div>
        @yield('formulario')
    </div>
    
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
</body>
</html>