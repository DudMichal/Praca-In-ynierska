@include('partials.head')
@include('partials.navi')


<div id="zawartosc" class="container mt-5">
    <h2 class="text-center mb-4">Pracownicy</h2>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Pracownik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pracownicy as $el)
                        <tr>
                            <td>{{ $el->firstname }} {{ $el->lastname }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Dodaj termin</h2>
        </div>
        <div class="card-body">
            <form class="form" action="<?= config('app.url') ?>/adminpanel/saveHours" method="post">
                @csrf
                <div class="form-group">
                    <label for="employee_id">Imię pracownika</label>
                    <select class="form-control" id="employee_id" name="employee_id">
                        @foreach ($pracownicy as $el)
                            <option value="{{ $el->id }}">{{ $el->firstname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="hours">Data</label>
                    <input type="text" class="form-control" id="hours" name="hours"
                        pattern="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}"
                        title="Proszę podać datę i godzinę w formacie RRRR-MM-DD GG:MM:SS">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Dodaj</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Godziny Pracy</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Imię pracownika</th>
                        <th>Data</th>
                        <th class="text-center" colspan="3">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hours as $termin)
                        <tr>
                            <td>{{ $termin->employee->firstname }}</td>
                            <td>{{ $termin->hours }}</td>
                            <td>
                                <form id="form-usun" action="{{ route('usunGodzine', $termin->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                            <td><button type="button" class="btn btn-danger" onclick="potwierdzUsuniecie()">Usuń
                                    rekord</button></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-bs-hourid="{{ $termin->id }}"
                                    data-bs-firstname="{{ $termin->employee->firstname }}"
                                    data-bs-lastname="{{ $termin->employee->lastname }}"
                                    data-bs-hour="{{ $termin->hours }}">Edytuj</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edycja Terminu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('edytujGodzine') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="datetime" class="col-form-label">Data i godzina:</label>
                        <!-- Wyświetl imię i nazwisko pracownika oraz datę jako pola tylko do odczytu -->
                        <input type="text" class="form-control" id="employee_name" name="employee_name" readonly>
                        <input type="text" class="form-control" id="datetime" name="datetime">
                    </div>
                    <input type="hidden" class="id" id="id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>


<script>
    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-bs-hourid');
        var firstname = button.getAttribute('data-bs-firstname');
        var lastname = button.getAttribute('data-bs-lastname');
        var hour = button.getAttribute('data-bs-hour');

        var modalId = exampleModal.querySelector('.id');
        var modalEmployeeName = exampleModal.querySelector('#employee_name');
        var modalDatetime = exampleModal.querySelector('#datetime');

        modalId.value = id;
        modalEmployeeName.value = firstname + ' ' + lastname;
        modalDatetime.value = hour;
    });

    function potwierdzUsuniecie() {
        if (confirm('Czy na pewno chcesz usunąć ten rekord?')) {
            document.getElementById('form-usun').submit();
        }
    }
</script>


@include('partials.footer')
