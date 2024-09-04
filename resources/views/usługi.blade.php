@include('partials.head')
@include('partials.navi')

<div class="container">
    <h2 class="animate__animated animate__fadeInDown">Usługi</h2>
    <div class="row">
        @foreach ($services as $el)
            <div class="card border-primary col-md-4 m-4 animate__animated animate__fadeInUp" style="max-width: 20rem;">
                <div class="card-header">
                    <h5>{{ $el->servicename }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $el->description }}</p>
                    <p class="card-text">Cena: {{ $el->price }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('partials.footer')
