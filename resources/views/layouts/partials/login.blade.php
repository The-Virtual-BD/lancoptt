<div class="popup hidden login">

    <div class="popupform">
        <div class="popupclose" id="loginpopupclose">
            <span class="iconify popupclose login" data-icon="maki:cross" ></span>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Login</h2>

            <!-- Email Address -->
            <div>
                <input type="email" name="email" placeholder="Email" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input type="password" required placeholder="Password" name="password" id="password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4 check" >
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form_btn">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button type="submit">Log in</button>
            </div>
        </form>
    </div>
</div>
