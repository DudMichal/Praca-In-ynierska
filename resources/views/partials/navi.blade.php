<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">KlinexCarDetailing</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/usługi') }}">Usługi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/pracownik') }}">Pracownicy</a>
                    </li>
                </ul>
            </div>
            <div class="ml-auto">
                @if (Auth::check())
                    @if (request()->is('usługi', 'pracownik', '/'))
                        <a href="./rezerwacja"><button type="button" class="btn btn-secondary">Rezerwuj</button></a>
                    @endif
                    @if (request()->is('usługi', 'pracownik', '/') && Auth::user()->name == 'admin')
                        <a href="./adminpanel"><button type="button" class="btn btn-secondary">Admin Panel</button></a>
                    @endif
                @endif
            </div>
            <div class="ml-auto">
                @if (Auth::check())
                    <a href="./wyloguj"><button type="button" class="btn btn-secondary">Wyloguj</button></a>
                @else
                    <a href="{{ url('/login') }}"><button type="button" class="btn btn-secondary">Zaloguj</button></a>
                @endif
            </div>
        </div>
    </nav>
