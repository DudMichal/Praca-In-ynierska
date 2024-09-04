@include('partials.head')
@include('partials.navi')

<div class="container vh-90 ">
    <div class="row h-100 align-items-center justify-content-center m-4">
        <div class="col-auto">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <div class="conteiner bg-secondary rounded p-4 ">

                <form class="text-center" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <img class="mh-80 mb-3 " style="height: 100px" src="{{ URL::asset('images/carwash.png') }}"
                            alt="Route icons created by Freepik - Flaticon ">
                    </div>
                    <!-- Email Address -->
                    <div class="text-white m-s-5">
                        <x-input-label for="email" />
                        <x-text-input id="email" class="block mt-1 w-full rounded bg-secondary border"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder="Email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-2 text-white">
                        <x-input-label for="password" />

                        <x-text-input id="password" placeholder="Hasło"
                            class="block mt-1 w-full rounded bg-secondary border" type="password" name="password"
                            required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="" name="remember">
                            <span class="ms-2 text-white">{{ __('Zapemiętaj mnie') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Zaloguj') }}
                        </x-primary-button>

                        @if (Route::has('password.request'))
                            <p class="pt-3">

                                <a class="text-white" href="{{ route('password.request') }}">
                                    {{ __('Przypomnij hasło') }}
                                </a>
                            </p>
                        @endif

                        <!-- Przycisk do rejestracji -->

                        <x-primary-button class="btn btn-primary ">
                            <a class="text-dark" href="{{ route('register') }}">
                                {{ __('Zarejestruj się') }}
                            </a>
                        </x-primary-button>

                    </div>

                    <div class="col-md-12">
                        <ul class="social-network social-circle">
                            <li><a href="" class="icoFacebook" title="Facebook"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
</div>

@include('partials.footer')
