@include('partials.head')
@include('partials.navi')

<div class="container-fluid">
    <div class="row justify-content-center align-items-center mt-5">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar border rounded p-4 animate__animated animate__fadeInRight">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active animate__animated animate__fadeInRight" href="{{ url('/adminpanel/dodajpracownika') }}">
                            <i class="fas fa-user-plus mr-2"></i> Zarządzaj pracownikiem
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInRight" href="{{ url('/adminpanel/dodajusluge') }}">
                            <i class="fas fa-cogs mr-2"></i> Zarządzaj usługą
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInRight" href="{{ url('/adminpanel/dodajpracownikadosulugi') }}">
                            <i class="fas fa-users-cog mr-2"></i> Dodaj pracownika do usługi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInRight" href="{{ url('/adminpanel/dodajtermin') }}">
                            <i class="far fa-calendar-plus mr-2"></i> Zarządzaj terminem
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeInRight" href="{{ url('/adminpanel/spisrezerwacji') }}">
                            <i class="fas fa-list-alt mr-2"></i> Rezerwacje
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

@include('partials.footer')
