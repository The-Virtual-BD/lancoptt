@extends('layouts.client')
@section('headstyle')
<link rel="stylesheet" href="{{asset('css/contactUs.css')}}">
@endsection
@section('content')
    <section class="blanksection"></section>
    <section>
        <div class="contact_area">
            <h2>CONTACT</h2>
        </div>
        <div class="get-in-touch-area contact_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact_info">
                            <h2>CONTACT<span> INFORMATION</span></h2>
                            <div class="conatct_way">
                                <div class="contact_icon">
                                    <p>
                                        <span class="iconify" data-icon="carbon:location-filled"></span>
                                    </p>
                                </div>
                                <div class="conatct_text">
                                    <p>Majid Sarani, KDA Avenue, Shibbari Circle, <br> Khulna, Bangladesh</p>
                                </div>
                            </div>
                            <div class="conatct_way">
                                <div class="contact_icon">
                                    <p>
                                        <span class="iconify" data-icon="fluent:call-24-filled"></span>
                                    </p>
                                </div>
                                <div class="conatct_text">
                                    <p>+880 1716 859955 <br>+880 1716 859955</p>
                                </div>
                            </div>
                            <div class="conatct_way">
                                <div class="contact_icon">
                                    <p>
                                        <span class="iconify" data-icon="eva:email-fill"></span>
                                    </p>
                                </div>
                                <div class="conatct_text">
                                    <p>example@mail.com <br>example@mail.com</p>
                                </div>
                            </div>
                            <div class="conatct_way">
                                <div class="contact_icon">

                                </div>
                                <div class="conatct_text">
                                    <div class="social-media">

                                        <li><a href="#"><span class="iconify"
                                                    data-icon="entypo-social:facebook-with-circle"></span></a>
                                        </li>
                                        <li><a href="#"><span class="iconify"
                                                    data-icon="entypo-social:twitter-with-circle"></span></a></li>
                                        <li><a href="#"><span class="iconify"
                                                    data-icon="entypo-social:linkedin-with-circle"></span></a>
                                        </li>
                                        <li><a href="#"><span class="iconify"
                                                    data-icon="entypo-social:youtube-with-circle"></span></a></li>
                                        <li><a href="#"><span class="iconify"
                                                    data-icon="entypo-social:instagram-with-circle"></span></a>
                                        </li>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="contact-form ">
                            <form id="contactusfrom">
                                <div class="contact-us">
                                    <div class="input_conatct">
                                        <input type="text" placeholder="Name" name="conname" id="conname" required>
                                    </div>
                                    <div class="input_conatct">
                                        <input type="email" placeholder="Email Address" name="conemail" id="conemail" required>
                                    </div>
                                    <div class="input_conatct tell">
                                        <input type="text" class="onlynumber" placeholder="Phone Number" name="conphone" id="conphone" maxlength="11" required>
                                    </div>
                                    <div class="text-area_conatct">
                                        <textarea rows="6" placeholder="Message" name="conmessage" id="conmessage" required></textarea>
                                    </div>
                                    <div class="form_btn">
                                        <button id="contactusbtn">SUBMIT NOW</button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-g" id="contmsg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- =========Get-in-a-touch-end=========== -->
    <!-- =================Subscribe-Start============== -->
    <section>
        <div class="subdcribe_area subs_bg">
            <div class="container">
                <div class="row align-items-center flex-wrap">
                    <div class="col-lg-4 col-sm-12">
                        <div class="subscribe_contact">
                            <h2>NEWS LETTER<br><span>SUBSCRIBE</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-8  col-sm-12">
                        <form action="" id="subscriptionForm">
                            <div class="subscribe_form">
                                <div class="subcribe_input">
                                    <input type="email" id="email" name="email" placeholder="Enter your email">
                                    <input type="hidden" id="site" name="site" value="client">
                                </div>
                                <div class="subscribe_btn_contact">
                                    <button type="submit" id="subscribe">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-g" id="subscribemsg"></div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>

@endsection
