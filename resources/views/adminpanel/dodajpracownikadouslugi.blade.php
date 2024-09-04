@include('partials.head')
@include('partials.navi')

<div id="zawartosc" class="container mt-5">
    <h2 class="text-center mb-4">Pracownicy powiązani z usługami</h2>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id usługi</th>
                        <th>Usługa</th>
                        <th>Id pracownika</th>
                        <th>Pracownik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($powiazania as $el)
                        <tr>
                            <td>{{ $el->service_id }}</td>
                            <td>{{ $el->service->servicename }}</td>
                            <td>{{ $el->employee_id }}</td>
                            <td>{{ $el->employee->firstname }}</td>
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
            <h2>Dodaj Powiązanie</h2>
        </div>
        <div class="card-body">
            <form class="form" action="<?= config('app.url') ?>/adminpanel/savePowiazanie" method="post">
                @csrf
                <div class="form-group">
                    <label for="service_id">Usługa</label>
                    <select class="form-control" id="service_id" name="service_id">
                        @foreach ($uslugi as $usluga)
                            <option value="{{ $usluga->id }}">{{ $usluga->servicename }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="employee_id">Pracownik</label>
                    <select class="form-control" id="employee_id" name="employee_id">
                        @foreach ($pracownicy as $pracownik)
                            <option value="{{ $pracownik->id }}">
                                {{ $pracownik->firstname }} - {{ $pracownik->jobtitle }}
                            </option>
                        @endforeach
                    </select>
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
@include('partials.footer')
