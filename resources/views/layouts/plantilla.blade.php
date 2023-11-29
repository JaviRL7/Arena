<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')
    <main>
        @yield('content')
    </main>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        // Aquí puedes añadir tu código JavaScript
        document.addEventListener('DOMContentLoaded', (event) => {
            // Obtén el botón de inicio de sesión y el menú desplegable
            var loginBtn = document.querySelector('.dropbtn');
            var dropdownMenu = document.querySelector('.dropdown-content');

            // Añade un controlador de eventos al botón de inicio de sesión
            loginBtn.addEventListener('click', (event) => {
                // Evita que el botón realice su acción predeterminada
                event.preventDefault();

                // Muestra u oculta el menú desplegable
                dropdownMenu.classList.toggle('show');
            });
        });
        </script>
</body>
</html>
