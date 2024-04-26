<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')

    <style>
        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .main-content {
            padding-left: 15px;
            padding-right: 15px;
        }

        @media (min-width: 992px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                height: 100%;
                background-color: #343a40; /* Couleur de fond */
                padding-top: 20px;
                z-index: 1030;
                overflow-y: auto;
            }

            .sidebar-sticky {
                padding-left: 15px; /* Espacement à gauche */
                padding-right: 15px; /* Espacement à droite */
            }

            .sidebar .nav-link {
                color: #ffffff; /* Couleur du texte */
            }

            .sidebar .nav-link:hover {
                background-color: #495057; /* Couleur de fond au survol */
            }

            .sidebar .nav-link.active {
                background-color: #007bff; /* Couleur de fond de l'élément actif */
            }
        }

        /* Logo style */
        .navbar-brand img {
            height: 30px; /* Customize the height as needed */
            margin-right: 10px;
        }

        .pagination-container ul {
            display: flex; /* Utilisation de flexbox */
            list-style: none;
            padding-left: 0;
            margin: 0;
            justify-content: center; /* Centrer les éléments sur l'axe principal */
        }

        .pagination-container ul li {
            display: inline;
            margin-right: 5px; /* Espacement entre les éléments de pagination si nécessaire */
        }

        .pagination-container ul li .active {
            pointer-events: none;
            cursor: default;
        }

        .pagination-container ul li a {
            display: inline-block;
            padding: 6px 12px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #007bff;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .pagination-container ul li a:hover {
            background-color: #e9ecef;
        }

        .pagination-container ul li.active a {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 bg-dark sidebar" id="sidebar">
                    <div class="sidebar-header">
                        <h3 class="text-white">Intervention</h3>
                        <!-- Ajoutez votre logo ici si vous le souhaitez -->
                    </div>
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('activity-logs/login/logout') }}">
                                    <i class="fas fa-user-plus mr-2" aria-hidden="true"></i>
                                    <span class="icon-text">Activity Log</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('systemCalendar') }}">
                                    <i class="fas fa-calendar mr-2" aria-hidden="true"></i>
                                    <span class="icon-text">Calendar</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('interventions.index') }}">
                                    <i class="fas fa-list mr-2" aria-hidden="true"></i>
                                    <span class="icon-text">List of Interventions</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-link mr-2" aria-hidden="true"></i>
                                    <span class="icon-text">Link 4</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <main role="main" class="main-content col-lg-9 ml-sm-auto col-md-10 pt-3 px-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const navLinks = sidebar.querySelectorAll('.nav-link');

            navLinks.forEach(function (link) {
                link.addEventListener('mouseenter', function () {
                    sidebar.classList.add('expanded');
                });
            });

            sidebar.addEventListener('mouseleave', function () {
                sidebar.classList.remove('expanded');
            });
        });
    </script>
</body>
</html>
