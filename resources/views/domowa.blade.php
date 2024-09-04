@include('partials.head')
@include('partials.navi')

<div class="container mt-5 animate__animated animate__fadeInUp">
    <div class="text-center">
        <h3 class="mb-4">Witamy w Naszej Myjni!</h3>
        <p class="lead">Oferujemy profesjonalne usługi czyszczenia i pielęgnacji samochodów. Zaufaj nam, a Twój pojazd będzie lśnił jak nowy!</p>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <h4>Nasze Zalety:</h4>
            <ul>
                <li>Profesjonalna obsługa z wieloletnim doświadczeniem.</li>
                <li>Wykorzystujemy nowoczesne metody i środki czyszczące.</li>
                <li>Szybki i skuteczny proces mycia i detailing'u.</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Unikalne Cechy:</h4>
            <ul>
                <li>Ochrona lakieru samochodu za pomocą powłoki ceramicznej.</li>
                <li>Detailing wnętrza z dbałością o każdy detal.</li>
                <li>Elastyczne pakiety usług dostosowane do Twoich potrzeb.</li>
            </ul>
        </div>
    </div>
</div>
<div class="container animate__animated animate__fadeInUp"> 

    <div class="text-center mt-5 " >
        <h3 class="mb-4 ">Opinie Klientów</h3>
    </div>
    <div class="row " >
        <div class="col-md-4"> 
            <div class="card h-100">
                <div class="card-img-top mx-auto mt-3 rounded-circle bg-secondary" style="width: 100px; height: 100px; overflow: hidden;">
                    <img src="{{ asset('images/img1.png') }}" alt="Zdjęcie Klienta" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="card-body">
                    <p class="card-text">"Bardzo polecam tę myjnię! Mój samochód nigdy nie wyglądał lepiej."</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-img-top mx-auto mt-3 rounded-circle bg-secondary" style="width: 100px; height: 100px; overflow: hidden;">
                    <img src="{{ asset('images/img2.png') }}" alt="Zdjęcie Klienta" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="card-body">
                    <p class="card-text">"Profesjonalna obsługa i świetna jakość usług."</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-img-top mx-auto mt-3 rounded-circle bg-secondary" style="width: 100px; height: 100px; overflow: hidden;">
                    <img src="{{ asset('images/img3.png') }}" alt="Zdjęcie Klienta" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="card-body">
                    <p class="card-text">"Profesjonalna obsługa i świetna jakość usług."</p>
                </div>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')

