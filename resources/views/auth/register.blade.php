@include('partials.head')
@include('partials.navi')

<div class="container vh-90">
    <div class="row h-100 align-items-center justify-content-center m-4">
        <div class="col-auto">
            <div class="conteiner bg-secondary rounded p-4 ">

                <form class="text-center" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <img class="mh-80 mb-3 " style="height: 100px" src="{{ URL::asset('images/carwash.png') }}"
                            alt="Route icons created by Freepik - Flaticon ">
                    </div>
                    <!-- Name -->
                    <div class="text-white m-s-5">
                        <x-input-label for="name" />
                        <x-text-input id="name" class="block mt-1 w-full rounded bg-secondary border center-placeholder"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Imie"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="text-white m-s-5">
                        <x-input-label for="email"  />
                        <x-text-input id="email" class="block mt-1 w-full rounded bg-secondary border center-placeholder" type="email" name="email"
                            :value="old('email')" required autocomplete="username" placeholder="Email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="text-white m-s-5">
                        <x-input-label for="password" />
                        <x-text-input id="password" class="block mt-1 w-full rounded bg-secondary border center-placeholder" type="password" name="password" required
                            autocomplete="new-password" placeholder="Hasło"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="text-white m-s-5">
                        <x-input-label for="password_confirmation"  />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full rounded bg-secondary border center-placeholder" type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Powtórz hasło"/>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <x-primary-button class="btn btn-primary">
                            {{ 'Zaraejestruj' }}
                        </x-primary-button>

                        <p>
                            <a class="" href="{{ route('login') }}">
                                {{ __('Masz już konto?') }}
                            </a>
                        </p>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
