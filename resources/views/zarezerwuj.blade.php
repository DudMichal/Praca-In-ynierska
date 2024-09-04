@include('partials.head')
@include('partials.navi')

<div class="container mt-5 animate__animated animate__fadeInDown">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Podsumowanie rezerwacji</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p class="card-text">Wybrany pracownik: {{ $podsumowanie->employee->firstname }}</p>
                <p class="card-text">Wybrane usługi: {{ $podsumowanie->service->servicename }}</p>
                <p class="card-text">Wybrana godzina: {{ $podsumowanie->hour->hours }}</p>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
