<div class="popup hidden register">

    <div class="popupform">
        <div class="popupclose" id="registerpopupclose">
            <span class="iconify popupclose register" data-icon="maki:cross" ></span>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h2>Register</h2>
            <!-- Name -->
            <div>
                <input id="name" class="" type="text" name="name" placeholder="Name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <input type="email" name="email" placeholder="Email/Phone" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="">
                <input type="password" required placeholder="Password" name="password" id="password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="">
                <input id="password_confirmation" class=""
                                type="password"
                                name="password_confirmation" required placeholder="Confirm Password"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="check" >
                <label for="remember_me" class="">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form_btn">
                <a href="#" class="loginformopen exist">Already registered?</a>
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</div>
