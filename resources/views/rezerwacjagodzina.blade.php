@include('partials.head')
@include('partials.navi')

<div class="container mt-5 animate__animated animate__fadeInDown">
    <h2>Wybierz godzinę</h2>
    <form action="{{ url('/zarezerwuj') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group" id="godzinyContainer">
            @foreach ($hours as $godzina)
                @if (!$godzina->is_reserved)
                    <div class="mb-3 godzina-card" data-godzina-id="{{ $godzina->id }}">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $godzina->hours }}</h5>
                                <!-- Dodaj inne informacje dotyczące godziny, jeśli są dostępne -->
                                <p class="card-text">{{ $godzina->description }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class=" d-md-flex justify-content-md-end">
            <input type="hidden" name="godzina_id" id="selectedGodzinaId" value="">
            <input type="hidden" value="{{ $employee }}" name="pracownikid">
            <input type="hidden" value="{{ $services }}" name="uslugaid">
            <button type="submit" class="btn btn-primary btn-rezerwuj">Rezerwuj</button>
        </div>
    </form>
</div>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.godzina-card').click(function() {
            $('.godzina-card').removeClass('selected');
            $(this).addClass('selected');
            $('#selectedGodzinaId').val($(this).data('godzina-id'));
            checkIfHourSelected(); // Dodane sprawdzenie po każdym kliknięciu godziny
        });

        // Dodane funkcji sprawdzającej, czy jakaś godzina została wybrana
        function checkIfHourSelected() {
            var selectedGodzinaId = $('#selectedGodzinaId').val();
            if (selectedGodzinaId) {
                // Jeśli godzina została wybrana, odblokuj przycisk "Rezerwuj"
                $('.btn-rezerwuj').prop('disabled', false);
            } else {
                // Jeśli żadna godzina nie została wybrana, zablokuj przycisk "Rezerwuj"
                $('.btn-rezerwuj').prop('disabled', true);
            }
        }

        // Wywołaj funkcję sprawdzającą przy załadowaniu strony
        checkIfHourSelected();
    });
</script>

