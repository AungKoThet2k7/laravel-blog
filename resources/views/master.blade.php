<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Blog</title>
    @vite(['resources/sass/theme.scss', 'resources/js/theme.js'])
</head>

<body>
    @if (request()->route()->getName() !== 'page.detail')
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm position-sticky top-0 z-1">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        {{-- Search Box --}}
                        <form class="me-3" method="get">
                            <div class="input-group">
                                @if (request()->has('s'))
                                    <a href="{{ route('page.index') }}" class="btn btn-outline-danger mb-0 ">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @endif
                                <input type="text" class="form-control" required name="s" value="{{ request('s') }}"
                                    placeholder="Search ...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Authentication Links -->
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>
    @endif

    @yield('content')

</body>

</html>
