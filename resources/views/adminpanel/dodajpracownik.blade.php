@include('partials.head')
@include('partials.navi')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Dodaj pracownika</h2>
        </div>
        <div class="card-body">
            <form class="form" action="<?= config('app.url') ?>/adminpanel/saveEmployee" method="post">
                @csrf
                <div class="form-group">
                    <label for="firstname">Imie pracownika</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Nazwisko pracownika</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
                <div class="form-group">
                    <label for="jobtitle">Stanowisko</label>
                    <input type="text" class="form-control" id="jobtitle" name="jobtitle">
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
            <h2>Lista pracowników</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Stanowisko</th>
                        <th class="text-center" colspan="3">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->lastname }}</td>
                            <td>{{ $employee->jobtitle }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="edytujPracownika({{ $employee->id }}, '{{ $employee->firstname }}', '{{ $employee->lastname }}', '{{ $employee->jobtitle }}')">Edytuj</button>
                            </td>
                            <td>
                                <form id="form-usun" action="{{ route('usunPracownika', $employee->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                            <td><button type="button" class="btn btn-danger" onclick="potwierdzUsuniecie()">Usuń
                                    rekord</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="pracownikModal" tabindex="-1" aria-labelledby="pracownikModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pracownikModalLabel">Edytuj Pracownika</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edytujPracownika') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="imie" class="col-form-label">Imię:</label>
                        <input type="text" class="form-control" id="imie" name="imie">
                    </div>
                    <div class="mb-3">
                        <label for="nazwisko" class="col-form-label">Nazwisko:</label>
                        <input type="text" class="form-control" id="nazwisko" name="nazwisko">
                    </div>
                    <div class="mb-3">
                        <label for="stanowisko" class="col-form-label">Stanowisko:</label>
                        <input type="text" class="form-control" id="stanowisko" name="stanowisko">
                    </div>
                    <input type="hidden" id="id" name="id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  
<script>
    function edytujPracownika(id, imie, nazwisko, stanowisko) {
        document.getElementById('id').value = id;
        document.getElementById('imie').value = imie;
        document.getElementById('nazwisko').value = nazwisko;
        document.getElementById('stanowisko').value = stanowisko;

        var modal = new bootstrap.Modal(document.getElementById('pracownikModal'));
        modal.show();
    }
    function potwierdzUsuniecie() {
        if (confirm('Czy na pewno chcesz usunąć ten rekord?')) {
            document.getElementById('form-usun').submit();
        }
    }
</script>

@include('partials.footer')

