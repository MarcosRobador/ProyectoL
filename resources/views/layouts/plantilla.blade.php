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
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 60px; height: auto;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (auth()->check())
                            @if (!auth()->user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.zapatillas.index') }}">
                                    <i class="fas fa-home"></i> Inicio
                                </a>
                            </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-shopping-cart"></i> Carrito
                                        <span class="badge bg-success">{{ auth()->user()->cart ? auth()->user()->cart->items->count() : 0 }}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cartDropdown">
                                        @if(auth()->user()->cart && auth()->user()->cart->items->count() > 0)
                                            @foreach(auth()->user()->cart->items as $item)
                                                <li class="dropdown-item">
                                                    <img src="{{ asset('storage/' . $item->zapatilla->image) }}" width="30" height="30" alt="{{ $item->zapatilla->nombre }}">
                                                    {{ $item->zapatilla->nombre }} - {{ $item->quantity }} x ${{ $item->zapatilla->precio }}
                                                </li>
                                            @endforeach
                                            <li><hr class="dropdown-divider"></li>
                                            <li class="dropdown-item text-end">
                                                <a href="{{ route('cart.index') }}" class="btn btn-success btn-sm fw-bold">Ver Carrito</a>
                                            </li>
                                        @else
                                            <li class="dropdown-item text-center">El carrito está vacío.</li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Zapatillini. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('.add-to-cart-button').on('click', function() {
            var zapatillaId = $(this).data('id');
            var form = $('#add-to-cart-form-' + zapatillaId);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    alert('Producto añadido al carrito correctamente.');

                    // Actualiza el contador de artículos en el carrito
                    var cartCount = response.cartItems.length;
                    $('.badge.bg-success').text(cartCount);

                    // Actualiza el contenido del carrito en el dropdown
                    var cartDropdown = $('#cartDropdown').next('.dropdown-menu');
                    cartDropdown.empty();

                    if (cartCount > 0) {
                        $.each(response.cartItems, function(index, item) {
                            var cartItemHtml = `
                                <li class="dropdown-item">
                                    <img src="{{ asset('storage/') }}/` + item.zapatilla.image + `" width="30" height="30" alt="` + item.zapatilla.nombre + `">
                                    ` + item.zapatilla.nombre + ` - ` + item.quantity + ` x $` + item.zapatilla.precio + `
                                </li>`;
                            cartDropdown.append(cartItemHtml);
                        });

                        cartDropdown.append('<li><hr class="dropdown-divider"></li>');
                        cartDropdown.append('<li class="dropdown-item text-end"><a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm">Ver Carrito</a></li>');
                    } else {
                        cartDropdown.append('<li class="dropdown-item text-center">El carrito está vacío.</li>');
                    }
                },
                error: function(xhr) {
                    alert('Hubo un problema al añadir el producto al carrito.');
                }
            });
        });
    });
</script>



</html>
