<header>
    <nav id="nav" class="clientnav">
        <div class="container">
            <div class="menu-area">
                <div class="menu-logo">
                    <div class="logo-img">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/logo-white.png') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="nav_left">
                    <div class="main_menu hide_menu">
                        <ul class="">
                            <li><a href="{{ route('home') }}">HOME</a></li>
                            <li><a href="{{ route('gallery') }}">Tour Gallery</a></li>
                            <li><a href="{{ route('allCruises') }}">ALL VESSELS</a> </li>
                            <li> <a href="{{ route('retailService') }}">OUR TRADES</a></li>
                            <li><a href="{{ route('contactUs') }}">CONTACT US</a></li>

                        </ul>
                    </div>
                    {{-- Social Media Icons --}}
                    <div class="social_media hide_menu">
                        <li><a href="#"><span class="iconify"
                                    data-icon="entypo-social:facebook-with-circle"></span></a>
                        </li>
                        <li><a href="#"><span class="iconify"
                                    data-icon="entypo-social:twitter-with-circle"></span></a>
                        </li>
                        <li><a href="#"><span class="iconify"
                                    data-icon="entypo-social:linkedin-with-circle"></span></a>
                        </li>
                        <li><a href="#"><span class="iconify"
                                    data-icon="entypo-social:youtube-with-circle"></span></a>
                        </li>
                        <li><a href="#"><span class="iconify"
                                    data-icon="entypo-social:instagram-with-circle"></span></a>
                        </li>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="settingdropdown">
                        <div class="togglebtn">
                            <span class="iconify" data-icon="gg:profile"></span>
                        </div>
                        <ul class="settingsubmenu hidden">
                            <span class="phoneonly">
                                <li><a href="{{ route('home') }}">HOME</a></li>
                                <li><a href="{{ route('gallery') }}">Tour Gallery</a></li>
                                <li><a href="{{ route('allCruises') }}">ALL VESSELS</a> </li>
                                <li> <a href="{{ route('retailService') }}">OUR TRADES</a></li>
                                <li><a href="{{ route('contactUs') }}">CONTACT US</a></li>
                            </span>
                            @auth
                            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                            @endauth
                            @guest
                            <li class="loginformopen"><a href="">Login</a></li>

                            <li class="registerformopen"><a href="">Register</a></li>
                            @endguest
                            {{-- <li class="phoneonly">
                                <ul class="social_media">
                                    <li><a href="#"><span class="iconify"
                                                data-icon="entypo-social:facebook-with-circle"></span></a>
                                    </li>
                                    <li><a href="#"><span class="iconify"
                                                data-icon="entypo-social:twitter-with-circle"></span></a>
                                    </li>
                                    <li><a href="#"><span class="iconify"
                                                data-icon="entypo-social:linkedin-with-circle"></span></a>
                                    </li>
                                    <li><a href="#"><span class="iconify"
                                                data-icon="entypo-social:youtube-with-circle"></span></a>
                                    </li>
                                    <li><a href="#"><span class="iconify"
                                                data-icon="entypo-social:instagram-with-circle"></span></a>
                                    </li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
