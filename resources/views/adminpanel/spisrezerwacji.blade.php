@include('partials.head')
@include('partials.navi')

<div class="container">
    <h2>Lista Rezerwacji</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pracownik</th>
                <th>Usługa</th>
                <th>Imię i Nazwisko Klienta</th>
                <th>Data Rezerwacji</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rezervation as $reservation)
                <tr>
                    <td>{{ $reservation->employee->firstname }} {{ $reservation->employee->lastname }}</td>
                    <td>{{ $reservation->service->servicename }}</td>
                    <td>{{ $reservation->customername }}</td>
                    <td>{{ $reservation->hour->hours }}</td>
                    <td>
                        @if (!$reservation->is_completed)
                            <form action="{{ route('completeReservation', $reservation->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">Zakończ</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h2>Zarchiwizowane Rezerwacje</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Pracownik</th>
                <th>Usługa</th>
                <th>Imię i Nazwisko Klienta</th>
                <th>Data Rezerwacji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($archivedReservations as $archivedReservation)
                <tr>
                    <td>{{ $archivedReservation->firstname }} {{ $archivedReservation->lastname }}</td>
                    <td>{{ $archivedReservation->service }}</td>
                    <td>{{ $archivedReservation->customername }}</td>
                    <td>{{ $archivedReservation->reservationdate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edycja rezerwacji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Imie i Nazwisko:</label>
                        <select class="form-select" id="employee_id" name="employee_id">
                            @foreach ($pracownicy as $pracownik)
                                <option value="{{ $pracownik->id }}">
                                    {{ $pracownik->firstname }} {{ $pracownik->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Usługa:</label>
                        <select class="form-select" id="service_id" name="service_id">
                            @foreach ($services as $usluga)
                                <option value="{{ $usluga->id }}">
                                    {{ $usluga->servicename }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="id " id="id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var id = button.getAttribute('data-bs-reservationid')
        var modalreservationid = exampleModal.querySelector('.id')

        modalreservationid.value = id
    })
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('#exampleModal form');
        var reservationId = document.querySelector('.id');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Zapobiega domyślnej akcji przesłania formularza

            // Pobiera wartość z pola carIdEditInput
            var idvalue = reservationId.value;

            // Aktualizuje atrybut action formularza
            form.action = './edit-reservation/' + idvalue;

            // Wysyła formularz
            form.submit();
        });
    });
</script>


@include('partials.footer')
