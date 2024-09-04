@include('partials.head')
@include('partials.navi')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>Dodaj usluge</h2>
        </div>
        <div class="card-body">
            <form class="form" action="<?= config('app.url') ?>/adminpanel/saveService" method="post">
                @csrf
                <div class="form-group">
                    <label for="servicename">Nazwa usługi</label>
                    <input type="text" class="form-control" id="servicename" name="servicename">
                </div>
                <div class="form-group">
                    <label for="description">Opis</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="price">Cena</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="price" name="price" step="0.01"
                            min="0.01">
                        <span class="input-group-text">PLN</span>
                    </div>
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
                        <th>Nazwa usługi</th>
                        <th>Opisa</th>
                        <th>Cena</th>
                        <th class="text-center" colspan="3">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            
                            <td>{{ $service->servicename }}</td>
                            <td>{{ $service->description }}</td>
                            <td>{{ $service->price }}</td>
                            <td>
                                <form id="form-usun" action="{{ route('usunUsluge', $service->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                </form>
                            </td>
                            <td><button type="button" class="btn btn-danger" onclick="potwierdzUsuniecie()">Usuń
                                rekord</button></td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="edytujUsluge({{ $service->id }}, '{{ $service->servicename }}', '{{ $service->description }}', {{ $service->price }})">Edytuj</button>
                                <!-- Dodaj przycisk usuń usługę, jeśli chcesz -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="uslugaModal" tabindex="-1" aria-labelledby="uslugaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uslugaModalLabel">Edytuj Usługę</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edytujUsluge') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nazwa" class="col-form-label">Nazwa usługi:</label>
                        <input type="text" class="form-control" id="nazwa" name="nazwa">
                    </div>
                    <div class="mb-3">
                        <label for="opis" class="col-form-label">Opis:</label>
                        <input type="text" class="form-control" id="opis" name="opis">
                    </div>
                    <div class="mb-3">
                        <label for="cena" class="col-form-label">Cena:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="cena" name="cena" step="0.01" min="0.01">
                            <span class="input-group-text">PLN</span>
                        </div>
                    </div>
                    <input type="hidden" id="usluga_id" name="usluga_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uslugaModal" tabindex="-1" aria-labelledby="uslugaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uslugaModalLabel">Edytuj Usługę</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edytujUsluge') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nazwa" class="col-form-label">Nazwa usługi:</label>
                        <input type="text" class="form-control" id="nazwa" name="nazwa">
                    </div>
                    <div class="mb-3">
                        <label for="opis" class="col-form-label">Opis:</label>
                        <input type="text" class="form-control" id="opis" name="opis">
                    </div>
                    <div class="mb-3">
                        <label for="cena" class="col-form-label">Cena:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="cena" name="cena" step="0.01" min="0.01">
                            <span class="input-group-text">PLN</span>
                        </div>
                    </div>
                    <input type="hidden" id="usluga_id" name="usluga_id">
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
    function edytujUsluge(id, nazwa, opis, cena) {
        document.getElementById('usluga_id').value = id;
        document.getElementById('nazwa').value = nazwa;
        document.getElementById('opis').value = opis;
        document.getElementById('cena').value = cena;

        var modal = new bootstrap.Modal(document.getElementById('uslugaModal'));
        modal.show();
    }
    function potwierdzUsuniecie() {
        if (confirm('Czy na pewno chcesz usunąć ten rekord?')) {
            document.getElementById('form-usun').submit();
        }
    }
</script>

@include('partials.footer')
