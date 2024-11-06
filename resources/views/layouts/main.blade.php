<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('CSS/site.css') }}">

</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="container d1">

        <header class="p-3 text-bg-black">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="{{ route('home#index') }}" class="nav-link px-2 text-secondary">Home</a></li>

                        <li><a href="{{route('companies.index')}}" class="nav-link px-2 text-danger">Company</a></li>

                        <li><a href="{{route('employees.index')}}" class="nav-link px-2 text-success">Employee</a></li>

                        <li><a href="{{route('home#contact')}}" class="nav-link px-2 text-blue">Contact</a></li>

                        <li><a href="{{route('home#about')}}" class="nav-link px-2 text-primary">About</a></li>
                    </ul>

                    {{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input type="search" class="form-control form-control-dark text-bg-" placeholder="Search..."
                            aria-label="Search">
                    </form> --}}

                    <div class="text-end">
                        @guest
                            <a href="{{route('auth.login')}}"><button type="button" class="btn btn-outline-success me-2">Login</button></a>
                            <a href="{{route('auth.registration')}}"><button type="button" class="btn btn-primary">Sign-up</button></a>
                        @else
                            <a href="{{route('auth.logout')}}"><button type="button" class="btn btn-danger">Logout</button></a>
                        @endguest
                    </div>
                </div>
            </div>
        </header>

        @yield('content')


        <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Copy &copy; 2024
        </footer>
    </div>
    </div>
    </div>
    </div>
</body>

</html>
