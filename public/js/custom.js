
$(document).ready(function () {
    $('#sidemenutoggle').click(function (e) {
        e.preventDefault();
        $('#sidebar').toggleClass('w-52','w-64');
        $('#toggleIcon').toggleClass('rotate-180');
        $('#siteLogo').toggleClass('hidden', 'flex');
        $('.sidelinktext').toggleClass('hidden');
        $('.sidenav a').toggleClass('justify-start','justify-center');
    });

});

$('.togglebtn').click(function (e) {
    e.preventDefault();
    $('.settingsubmenu').toggleClass('hidden');
});

// Register modal
$('.registerformopen').click(function (e) {
    e.preventDefault();
    $('.popup.register').toggleClass('hidden');
});

$('#registerpopupclose').click(function (e) {
    e.preventDefault();
    $('.popup.register').toggleClass('hidden');
    $('.settingsubmenu').toggleClass('hidden');
});

// Sign in modal
$('.loginformopen').click(function (e) {
    e.preventDefault();
    $('.popup.login').toggleClass('hidden');
});

$('#loginpopupclose').click(function (e) {
    e.preventDefault();
    $('.popup.login').toggleClass('hidden');
    $('.settingsubmenu').toggleClass('hidden');
});

// Already registerd
$('.loginformopen.exist').click(function (e) {
    e.preventDefault();
    $('.popup.register').toggleClass('hidden');
    $('.popup.login').removeClass('hidden');
});


$('#imagepoppopupclose').click(function (e) {
    e.preventDefault();
    $('.popup.imagepop').toggleClass('hidden');
    $('.popup.imagepop #thispopimage').attr('src', '');
});

function popthisImage (url) {
    // e.preventDefault();
    $('.popup.imagepop').toggleClass('hidden');
    $('.popup.imagepop #thispopimage').attr('src', url);
}





$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(window).scroll(function(){
    var clientnav = $('.clientnav'),
        scroll = $(window).scrollTop();
    if (scroll >= 100) clientnav.css('background-color','rgb(36, 39, 46, 1)');
    else clientnav.css('background-color','rgb(36, 39, 46, 0.1)');
});



// Subscribing In Frontend
$('form#subscriptionForm').submit(function (e) {
    e.preventDefault();
    var email = $('form#subscriptionForm #email').val();
    var site = $('form#subscriptionForm #site').val();
    $.ajax({
        method: 'POST',
        url: BASE_URL + 'subscribers',
        data: {
            email: email,
            site: site,
        },
        success: function(response) {
            if (response.status == "success") {
                $('#subscribemsg').html(response.message);
                setTimeout(function(){
                    $('#subscribemsg').html('');
                }, 5000);
            } else if (response.status == "error") {
                $('#subscribemsg').html(response.message);
                setTimeout(function(){
                    $('#subscribemsg').html('');
                }, 5000);
            }
        },
        fail: function(response){
            $('#subscribemsg').html(response.message);
                setTimeout(function(){
                    $('#subscribemsg').html('');
            }, 5000);
        }
    });
});

// Only number in text
$('input.onlynumber').keyup(function(e){
  if (/\D/g.test(this.value)){
    this.value = this.value.replace(/\D/g, '');
  }
});

// Contuctus
$('form#contactusfrom').submit(function (e) {
    e.preventDefault();
    var name = $('#conname').val();
    var email = $('#conemail').val();
    var phone = $('#conphone').val();
    var message = $('#conmessage').val();

    $.ajax({
        method: 'POST',
        url: BASE_URL + 'contactUs/send',
        data: {
            name: name,
            phone: phone,
            email: email,
            message: message,
        },
        success: function(response) {
            if (response.status == "success") {
                $('#contmsg').html(response.message);
                $('form#contactusfrom').trigger("reset");
                setTimeout(function(){
                    $('#contmsg').html('');
                }, 5000);
            } else if (response.status == "error") {
                $('#contmsg').html(response.message);
                setTimeout(function(){
                    $('#contmsg').html('');
                }, 5000);
            }
        }
    });
});
