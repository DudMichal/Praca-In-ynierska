@include('partials.head')
@include('partials.navi')

<div class="container">
    <h2 class="animate__animated animate__fadeInDown">Lista pracowników</h2>
    <div class="row">
        @foreach ($eployees as $el)
            <div class="card border-primary m-4 animate__animated animate__fadeInUp" style="max-width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title">{{ $el->firstname }} {{ $el->lastname }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Stanowisko: {{ $el->jobtitle }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('partials.footer')

