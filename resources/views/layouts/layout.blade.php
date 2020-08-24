<!DOCTYPE html>
<html class="h-100" lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="{{ url('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>.bd-placeholder-img {font-size: 1.125rem;text-anchor: middle;}@media (min-width: 768px) {.bd-placeholder-img-lg {font-size: 3.5rem;}}main > .container {padding: 60px 15px 0;}.footer {background-color: #f5f5f5;}.footer > .container {padding-right: 15px;padding-left: 15px;}code {font-size: 80%;}
    </style>
    <script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
</head>
<body class="d-flex flex-column h-100">
<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand ml-5" href="{{ url('/') }}" title="В начало">Главная</a>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex mr-0 mr-md-5">
                @if (!Auth::guest())
                <li class="nav-item dropdown">
                    <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        {{ Auth::user()->login }}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                        <a class="dropdown-item " href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выход</a>
                    </div>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endif
            </ul>
        </div>
    </nav>
</header>
<main role="main" class="flex-shrink-0">
    <div class="container">
        @yield('content')
    </div>
</main>
<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Нашли ошибку? Напишите на email: toni.neczvetaev.06@bk.ru</span>
    </div>
</footer>
<script src="{{ url('/bootstrap/js/bootstrap.bundle.min.js') }}" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
</body>
</html>