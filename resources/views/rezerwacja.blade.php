@include('partials.head')
@include('partials.navi')

<div class="conteiner m-5 animate__animated animate__fadeInDown">
    <h2>Wybierz usługe</h2>
    <form action="{{ url('/rezerwacja') }}" method="POST" class="mb-4">
        @csrf

        <div class="row" id="uslugiContainer">
            @foreach ($services as $usluga)
                <div class="col-md-4 mb-3 usluga-card" data-usluga-id="{{ $usluga->id }}">
                    <div class="card ">
                        <div class="card-body">
                            <h5 class="card-title">{{ $usluga->servicename }}</h5>
                            <p class="card-text">{{ $usluga->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class=" d-md-flex justify-content-md-end">
            <input type="hidden" name="usluga_id" id="selectedUslugaId" value="">
            <button type="submit" class="btn btn-primary btn-next-step">Następny krok</button>
        </div>
    </form>
</div>
@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.usluga-card').click(function() {
            $('.usluga-card').removeClass('selected');
            $(this).addClass('selected');
            $('#selectedUslugaId').val($(this).data('usluga-id'));
            checkIfServiceSelected(); // Dodane sprawdzenie po każdym kliknięciu usługi
        });

        // Dodane funkcji sprawdzającej, czy jakaś usługa została wybrana
        function checkIfServiceSelected() {
            var selectedUslugaId = $('#selectedUslugaId').val();
            if (selectedUslugaId) {
                // Jeśli usługa została wybrana, odblokuj przycisk "Następny krok"
                $('.btn-next-step').prop('disabled', false);
            } else {
                // Jeśli żadna usługa nie została wybrana, zablokuj przycisk "Następny krok"
                $('.btn-next-step').prop('disabled', true);
            }
        }

        // Wywołaj funkcję sprawdzającą przy załadowaniu strony
        checkIfServiceSelected();
    });
</script>
