<script>
    var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?5946';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled": true,
        "chatButtonSetting": {
            "backgroundColor": "#4dc247",
            "ctaText": "",
            "borderRadius": "25",
            "marginLeft": "0",
            "marginBottom": "20",
            "marginRight": "20",
            "position": "right"
        },
        "brandSetting": {
            "brandName": "Lancoptt",
            "brandSubTitle": "Typically replies within a hour",
            "brandImg": "https://lancoptt.com/img/logo-white.png",
            "welcomeText": "Hi there!\nHow can I help you?",
            "messageText": "Hello, I have a question about Lancoptt",
            "backgroundColor": "#24272e",
            "ctaText": "Start Chat",
            "borderRadius": "25",
            "autoShow": false,
            "phoneNumber": "8801956113999"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
