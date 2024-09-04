@include('partials.head')
@include('partials.navi')
<div class="container mt-5 animate__animated animate__fadeInDown">
    <h2>Wybierz pracownika</h2>
    <form action="{{ url('/rezerwacjagodzina') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group" id="pracownicyContainer">
            @foreach ($employees as $pracownik)
                <div class="m-3 pracownik-card" data-pracownik-id="{{ $pracownik->id }}">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pracownik->firstname }}</h5>
                            <!-- Dodaj inne informacje dotyczące pracownika, jeśli są dostępne -->
                            <p class="card-text">{{ $pracownik->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class=" d-md-flex justify-content-md-end">
            <input type="hidden" name="pracownik_id" id="selectedPracownikId" value="">
            <input type="hidden" value="{{ $services }}" name="uslugaid">
            <button type="submit" class="btn btn-primary btn-next-step">Następny krok</button>
        </div>
    </form>

</div>
@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.pracownik-card').click(function() {
            $('.pracownik-card').removeClass('selected');
            $(this).addClass('selected');
            $('#selectedPracownikId').val($(this).data('pracownik-id'));
            checkIfEmployeeSelected(); // Dodane sprawdzenie po każdym kliknięciu pracownika
        });

        // Dodane funkcji sprawdzającej, czy jakiś pracownik został wybrany
        function checkIfEmployeeSelected() {
            var selectedPracownikId = $('#selectedPracownikId').val();
            if (selectedPracownikId) {
                // Jeśli pracownik został wybrany, odblokuj przycisk "Następny krok"
                $('.btn-next-step').prop('disabled', false);
            } else {
                // Jeśli żaden pracownik nie został wybrany, zablokuj przycisk "Następny krok"
                $('.btn-next-step').prop('disabled', true);
            }
        }

        // Wywołaj funkcję sprawdzającą przy załadowaniu strony
        checkIfEmployeeSelected();
    });
</script>

