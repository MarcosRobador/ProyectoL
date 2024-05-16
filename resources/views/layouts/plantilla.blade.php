<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @vite('resources/scss/app.scss', 'resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
                </a>
            </div>
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <section id="inicio">
        <div class="hero">
            <h1>Bienvenido a Mi Página Web</h1>
            <p>Ofrecemos soluciones profesionales para tu negocio.</p>
            <a href="#servicios" class="btn">Nuestros Servicios</a>
        </div>
    </section>

    <section id="servicios">
        <h2>Nuestros Servicios</h2>
        <div class="service-container">
            <div class="service-item">
                <h3>Servicio 1</h3>
                <p>Descripción del servicio 1.</p>
            </div>
            <div class="service-item">
                <h3>Servicio 2</h3>
                <p>Descripción del servicio 2.</p>
            </div>
            <div class="service-item">
                <h3>Servicio 3</h3>
                <p>Descripción del servicio 3.</p>
            </div>
        </div>
    </section>

    </section>

    <footer>
        <p>&copy; 2024 Mi Empresa. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
